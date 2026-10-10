<?php
namespace App\Http\Controllers;
use App\Models\DataUjiResistensi;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ImportExportController extends Controller
{
    // Daftar bulan
    private static $bulanMap = [
        'januari'=>1,'februari'=>2,'maret'=>3,'april'=>4,'mei'=>5,'juni'=>6,
        'juli'=>7,'agustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'desember'=>12,
    ];

    public function indexImport() { return view('data.import'); }
    public function indexExport() { return view('data.export'); }

    /* ── IMPORT ─────────────────────────────────────────── */
    public function import(Request $request)
    {
        $request->validate(['file'=>'required|mimes:xlsx,xls,csv|max:10240']);
        try {
            $spreadsheet = IOFactory::load($request->file('file')->getPathname());
            $sheet  = $spreadsheet->getActiveSheet();
            $rows   = $sheet->toArray(null, true, true, false);

            // Deteksi baris header secara otomatis (cari baris yang memuat "provinsi"/"propinsi")
            $headerRowIdx = null;
            foreach ($rows as $idx => $r) {
                $cells = array_map(fn($v) => strtolower(trim((string)($v ?? ''))), $r);
                foreach ($cells as $c) {
                    if (str_contains($c, 'provinsi') || str_contains($c, 'propinsi')) { $headerRowIdx = $idx; break 2; }
                }
            }
            if ($headerRowIdx === null) {
                return back()->withErrors(['file' => 'Baris header tidak ditemukan. Pastikan ada kolom "Provinsi". Gunakan template yang disediakan.']);
            }

            $header = array_map(fn($h) => strtolower(trim(preg_replace('/[^a-z0-9]/i', '', $h ?? ''))), $rows[$headerRowIdx]);
            $headerLine = $headerRowIdx + 1; // nomor baris header (1-based) untuk info error
            $rows = array_slice($rows, $headerRowIdx + 1);
            $colCount = count($header);
            $imported = 0; $errors = [];

            foreach ($rows as $ri => $row) {
                $rowNum = $headerLine + $ri + 1;
                if (empty(array_filter($row, fn($v) => $v !== null && $v !== ''))) continue;

                try {
                    // Normalisasi jumlah kolom agar array_combine selalu aman
                    $row = array_slice(array_pad($row, $colCount, null), 0, $colCount);
                    $d = array_combine($header, $row);
                    if ($d === false) { $errors[] = "Baris $rowNum: struktur kolom tidak sesuai."; continue; }

                    // Ambil nilai kolom dengan beberapa alias nama header
                    $val = function (array $keys) use ($d) {
                        foreach ($keys as $k) {
                            if (isset($d[$k]) && trim((string)$d[$k]) !== '') return $d[$k];
                        }
                        return null;
                    };

                    // Cari provinsi — fuzzy match
                    $provNama = trim((string) $val(['provinsi','propinsi','nama_provinsi','prov']));
                    $provinsi = $this->matchProvinsi($provNama);
                    if (!$provinsi) { $errors[] = "Baris $rowNum: Provinsi \"$provNama\" tidak ditemukan."; continue; }

                    // Cari kabupaten — abaikan prefiks Kab/Kota/Kabupaten, cocokkan ke master
                    $kabNama    = trim((string) $val(['kabupaten','kabupat','kabkota','kabupatenkota','kabupaten/kota','kotakabupaten','kab','kota','nama_kabupaten']));
                    $kabupaten  = $this->matchKabupaten($provinsi->id, $kabNama);
                    if (!$kabupaten) { $errors[] = "Baris $rowNum: Kabupaten \"$kabNama\" tidak ditemukan di ".$provinsi->nama_provinsi."."; continue; }

                    // Tentukan status dari kolom resisten/rentan/toleran/terduga
                    $status = 'resisten';
                    $rVal = strtolower(trim((string) $val(['resisten'])));
                    $nVal = strtolower(trim((string) $val(['rentan'])));
                    $tVal = strtolower(trim((string) $val(['toleran'])));
                    $gVal = strtolower(trim((string) $val(['terdugaresisten','terduga'])));
                    if ($nVal === 'v' || $nVal === 'ya' || $nVal === '1') $status = 'rentan';
                    elseif ($tVal === 'v' || $tVal === 'ya' || $tVal === '1') $status = 'toleran';
                    elseif ($gVal === 'v' || $gVal === 'ya' || $gVal === '1') $status = 'toleran'; // terduga resisten = toleran
                    elseif ($rVal === 'v' || $rVal === 'ya' || $rVal === '1') $status = 'resisten';
                    // Jika ada kolom status teks
                    $statusTeks = strtolower(trim((string) $val(['status','statusresisten','statusresistensi'])));
                    if (in_array($statusTeks, ['resisten','rentan','toleran'])) $status = $statusTeks;

                    // Mutasi: Ya/Tidak -> Ya=ada, Tidak=null
                    $mutasi = trim((string) $val(['mutasi']));
                    if ($mutasi === '' || strtolower($mutasi) === 'tidak') $mutasi = null;
                    elseif (strtolower($mutasi) === 'ya') $mutasi = 'Ya';

                    DataUjiResistensi::create([
                        'no'               => $imported + 1,
                        'tahun'            => intval($val(['tahun'])) ?: date('Y'),
                        'provinsi_id'      => $provinsi->id,
                        'kabupaten_id'     => $kabupaten->id,
                        'alamat'           => trim((string) $val(['alamat'])) ?: null,
                        'jenis_nyamuk'     => trim((string) $val(['jenisnyamuk','nyamuk','jenis'])),
                        'insektisida'      => trim((string) $val(['insektisida'])),
                        'metode'           => trim((string) $val(['metode','metodeuji'])),
                        'sampel_diperiksa' => intval($val(['sampeldiperiksa','sampel','jumlahsampel'])) ?: 1,
                        'bulan'            => trim((string) $val(['bulan'])) ?: null,
                        'status'           => $status,
                        'mutasi'           => $mutasi,
                        'publikasi'        => trim((string) $val(['publikasi','sumber'])) ?: null,
                    ]);
                    $imported++;
                } catch (\Throwable $rowEx) {
                    $errors[] = "Baris $rowNum: ".$rowEx->getMessage();
                }
            }
            $msg = "$imported data berhasil diimpor.";
            if ($errors) $msg .= " ".count($errors)." baris gagal.";
            return redirect()->route('import.index')->with('success',$msg)->with('errors_import',$errors);
        } catch (\Throwable $e) {
            return back()->withErrors(['file'=>'Gagal membaca file: '.$e->getMessage()]);
        }
    }

    /* ── HELPER: normalisasi & pencocokan wilayah ───────── */
    private function normalizeNama(?string $nama): string
    {
        $nama = strtolower(trim($nama ?? ''));
        // Buang prefiks Kab/Kota/Kabupaten/Adm. dan tanda baca
        $nama = preg_replace('/^(kab\.?|kota|kabupaten|adm\.?|administrasi)\s+/i', '', $nama);
        $nama = preg_replace('/[^a-z0-9]/', '', $nama);
        return $nama;
    }

    private function matchProvinsi(?string $nama)
    {
        $nama = trim($nama ?? '');
        if ($nama === '') return null;

        // 0) Singkatan umum
        $alias = [
            'jateng'=>'jawa tengah','jatim'=>'jawa timur','jabar'=>'jawa barat',
            'diy'=>'di yogyakarta','di yogyakarta'=>'di yogyakarta','yogyakarta'=>'di yogyakarta',
            'dki'=>'dki jakarta','jakarta'=>'dki jakarta',
            'ntb'=>'nusa tenggara barat','ntt'=>'nusa tenggara timur',
            'sumut'=>'sumatera utara','sumbar'=>'sumatera barat','sumsel'=>'sumatera selatan',
            'kaltim'=>'kalimantan timur','kalteng'=>'kalimantan tengah','kalbar'=>'kalimantan barat',
            'kalsel'=>'kalimantan selatan','kalut'=>'kalimantan utara',
            'sulsel'=>'sulawesi selatan','sulut'=>'sulawesi utara','sulteng'=>'sulawesi tengah',
            'sultra'=>'sulawesi tenggara','sulbar'=>'sulawesi barat',
            'papbar'=>'papua barat','papuabarat'=>'papua barat',
            'babel'=>'kepulauan bangka belitung','kepri'=>'kepulauan riau',
        ];
        $norm0 = preg_replace('/[^a-z]/', '', strtolower($nama));
        if (isset($alias[$norm0])) $nama = $alias[$norm0];

        // 1) cocok persis
        $prov = Provinsi::whereRaw('LOWER(nama_provinsi) = ?', [strtolower($nama)])->first();
        if ($prov) return $prov;

        $norm = $this->normalizeNama($nama);
        // 2) cocok setelah normalisasi
        $prov = Provinsi::all()->first(fn($p) => $this->normalizeNama($p->nama_provinsi) === $norm);
        if ($prov) return $prov;

        // 3) LIKE dua arah
        $prov = Provinsi::whereRaw('LOWER(nama_provinsi) LIKE ?', ['%'.strtolower($nama).'%'])->first();
        if ($prov) return $prov;
        $prov = Provinsi::whereRaw('LOWER(nama_provinsi) LIKE ?', [strtolower($nama).'%'])->first();
        if ($prov) return $prov;

        return Provinsi::all()->first(fn($p) =>
            str_contains($this->normalizeNama($p->nama_provinsi), $norm) ||
            str_contains($norm, $this->normalizeNama($p->nama_provinsi))
        );
    }

    private function matchKabupaten(int $provinsiId, ?string $nama)
    {
        $nama = trim($nama ?? '');
        $daftar = Kabupaten::where('provinsi_id', $provinsiId)->get();
        if ($daftar->isEmpty()) return null;

        // Tanpa nama kabupaten — hanya 1 kabupaten di provinsi tsb, pakai itu
        if ($nama === '') {
            return $daftar->count() === 1 ? $daftar->first() : null;
        }

        $norm = $this->normalizeNama($nama);

        // 1) cocok persis (nama master biasanya tanpa prefiks)
        $kab = $daftar->first(fn($k) => strtolower(trim($k->nama_kabupaten)) === strtolower($nama));
        if ($kab) return $kab;

        // 2) cocok setelah normalisasi (abaikan Kab/Kota/tanda baca)
        $kab = $daftar->first(fn($k) => $this->normalizeNama($k->nama_kabupaten) === $norm);
        if ($kab) return $kab;

        // 3) LIKE (master mengandung input atau sebaliknya) — pilih yang paling cocok
        $kandidat = $daftar->filter(fn($k) =>
            str_contains($this->normalizeNama($k->nama_kabupaten), $norm) ||
            str_contains($norm, $this->normalizeNama($k->nama_kabupaten))
        )->sortByDesc(fn($k) => strlen($this->normalizeNama($k->nama_kabupaten)));

        return $kandidat->first();
    }

    /* ── DOWNLOAD TEMPLATE ──────────────────────────────── */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Template Import');
        $sheet = $spreadsheet->getActiveSheet();

        $headers = [
            'No','Provinsi','Kabupaten','Alamat','Jenis Nyamuk','Insektisida','Metode',
            'Sampel diperiksa','Bulan','Tahun','Resisten','Rentan','Toleran','Terduga resisten',
            'Mutasi','Publikasi'
        ];
        $widths = [5,20,20,25,15,25,25,10,12,8,10,10,10,15,10,30];

        foreach ($headers as $i => $h) {
            $col = chr(65+$i);
            $sheet->setCellValue($col.'1', $h);
            $sheet->getColumnDimension($col)->setWidth($widths[$i]);
        }
        // Style header
        $sheet->getStyle('A1:P1')->applyFromArray([
            'font' => ['bold'=>true,'color'=>['rgb'=>'FFFFFF']],
            'fill' => ['fillType'=>Fill::FILL_SOLID,'color'=>['rgb'=>'2563EB']],
            'alignment' => ['horizontal'=>Alignment::HORIZONTAL_CENTER],
        ]);

        // Contoh baris 1 (Culex - Grobogan)
        $ex = ['1','Jawa Tengah','Kab Grobogan','Kab Grobogan','Culex sp','Deltamethrin 0,025%','WHO Tube Bioassay','1','Juni','2026','','v','','','','Data Simpel'];
        foreach ($ex as $i => $v) $sheet->setCellValue(chr(65+$i).'2', $v);
        // Contoh baris 2 (Aedes - Kudus)
        $ex2 = ['2','Jawa Tengah','Kab Kudus','Kab Kudus','Ae. aegypti','Cypermethrin','Sequencing','1','November','2024','v','','','','Ya','DATA RK 2024.xlsx'];
        foreach ($ex2 as $i => $v) $sheet->setCellValue(chr(65+$i).'3', $v);

        // Catatan
        $sheet->setCellValue('A5', 'CATATAN:');
        $sheet->setCellValue('A6', 'Kolom Status: isi salah satu kolom (Resisten/Rentan/Toleran/Terduga resisten) dengan huruf "v"');
        $sheet->setCellValue('A7', 'Terduga resisten akan dimasukkan sebagai Toleran');
        $sheet->setCellValue('A8', 'Mutasi: isi "Ya" jika ada mutasi, kosongkan jika tidak');
        $sheet->getStyle('A5')->getFont()->setBold(true);
        $sheet->getStyle('A6:A8')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF666666'));
        $sheet->mergeCells('A6:P6'); $sheet->mergeCells('A7:P7'); $sheet->mergeCells('A8:P8');

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template_import_resistensi.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    /* ── EXPORT ─────────────────────────────────────────── */
    public function export(Request $request)
    {
        $tahun = $request->get('tahun','semua');
        $data  = DataUjiResistensi::with(['provinsi','kabupaten'])
            ->when($tahun !== 'semua', fn($q) => $q->where('tahun',$tahun))
            ->orderBy('provinsi_id')->orderBy('kabupaten_id')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->setTitle('Data Uji Resistensi');
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ['No','Provinsi','Kabupaten','Alamat','Jenis Nyamuk','Insektisida','Metode',
            'Sampel Diperiksa','Bulan','Tahun','Resisten','Rentan','Toleran','Mutasi','Publikasi'];
        $widths  = [5,20,22,25,15,25,25,10,12,8,10,10,10,10,35];

        foreach ($headers as $i => $h) {
            $col = chr(65+$i);
            $sheet->setCellValue($col.'1', $h);
            $sheet->getColumnDimension($col)->setWidth($widths[$i]);
        }
        $sheet->getStyle('A1:O1')->applyFromArray([
            'font'=>['bold'=>true,'color'=>['rgb'=>'FFFFFF']],
            'fill'=>['fillType'=>Fill::FILL_SOLID,'color'=>['rgb'=>'2563EB']],
        ]);

        $statusColors = ['resisten'=>'FEE2E2','rentan'=>'DCFCE7','toleran'=>'FEF9C3'];

        foreach ($data as $row => $item) {
            $r = $row + 2;
            $sheet->setCellValue("A$r", $row+1);
            $sheet->setCellValue("B$r", $item->provinsi->nama_provinsi ?? '-');
            $sheet->setCellValue("C$r", $item->kabupaten->nama_kabupaten ?? '-');
            $sheet->setCellValue("D$r", $item->alamat ?? '');
            $sheet->setCellValue("E$r", $item->jenis_nyamuk);
            $sheet->setCellValue("F$r", $item->insektisida);
            $sheet->setCellValue("G$r", $item->metode);
            $sheet->setCellValue("H$r", $item->sampel_diperiksa);
            $sheet->setCellValue("I$r", $item->bulan ?? '');
            $sheet->setCellValue("J$r", $item->tahun);
            // Kolom status: centang di kolom yang sesuai
            $sheet->setCellValue("K$r", $item->status === 'resisten' ? 'v' : '');
            $sheet->setCellValue("L$r", $item->status === 'rentan'   ? 'v' : '');
            $sheet->setCellValue("M$r", $item->status === 'toleran'  ? 'v' : '');
            $sheet->setCellValue("N$r", $item->mutasi ?? '');
            $sheet->setCellValue("O$r", $item->publikasi ?? '');
            // Warna baris sesuai status
            if (isset($statusColors[$item->status])) {
                $sheet->getStyle("A$r:O$r")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB($statusColors[$item->status]);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'data_resistensi_'.($tahun === 'semua' ? 'semua' : $tahun).'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
}