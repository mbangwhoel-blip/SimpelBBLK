<?php
namespace App\Http\Controllers;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\DataUjiResistensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataUjiResistensiController extends Controller
{
    public function index(Request $request)
    {
        $provinsis = Provinsi::orderBy('nama_provinsi', 'asc')->get();
        $tahun = $request->get('tahun', 'semua');
        $bulan = $request->get('bulan');

        $query = DataUjiResistensi::with(['provinsi','kabupaten']);
        if ($tahun !== 'semua') $query->where('tahun', $tahun);
        if ($bulan) $query->where('bulan', $bulan);
        $data = $query->latest()->get();

        $bulans = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        // Tahun: semua tahun yang ada di data + tahun berjalan (untuk input baru)
        $tahunList = DataUjiResistensi::select('tahun')->distinct()
            ->whereNotNull('tahun')->orderBy('tahun','desc')->pluck('tahun');
        $tahunList->push(date('Y'));
        $tahunList = $tahunList->unique()->sortDesc()->values();

        return view('input', compact('provinsis','data','tahun','bulan','bulans','tahunList'));
    }

    public function store(Request $request)
    {
        // Dukungan input tunggal langsung (single form)
        if ($request->filled('provinsi_id')) {
            $validated = $request->validate([
                'provinsi_id'      => 'required|exists:provinsis,id',
                'kabupaten_id'     => 'required|exists:kabupatens,id',
                'jenis_nyamuk'     => 'required|string',
                'insektisida'      => 'required|string',
                'metode'           => 'required|string',
                'sampel_diperiksa' => 'required|integer|min:1',
                'status'           => 'required|in:resisten,rentan,toleran',
                'bulan'            => 'nullable|string',
                'tahun'            => 'nullable|integer',
                'alamat'           => 'nullable|string',
                'mutasi'           => 'nullable|string',
                'publikasi'        => 'nullable|string',
            ]);

            Kabupaten::where('id', $validated['kabupaten_id'])
                ->where('provinsi_id', $validated['provinsi_id'])->firstOrFail();

            $maxNo = DataUjiResistensi::max('no');
            $noBaru = is_numeric($maxNo) ? intval($maxNo) + 1 : DataUjiResistensi::count() + 1;

            DataUjiResistensi::create([
                'no'               => $noBaru,
                'tahun'            => $validated['tahun'] ?? date('Y'),
                'provinsi_id'      => $validated['provinsi_id'],
                'kabupaten_id'     => $validated['kabupaten_id'],
                'alamat'           => $validated['alamat'] ?? null,
                'jenis_nyamuk'     => $validated['jenis_nyamuk'],
                'insektisida'      => $validated['insektisida'],
                'metode'           => $validated['metode'],
                'sampel_diperiksa' => $validated['sampel_diperiksa'],
                'bulan'            => $validated['bulan'] ?? null,
                'status'           => $validated['status'],
                'mutasi'           => $validated['mutasi'] ?? null,
                'publikasi'        => $validated['publikasi'] ?? null,
            ]);

            return redirect()->route('input')->with('success','Data pengujian berhasil ditambahkan.');
        }

        // Dukungan jika dikirim dalam array rows
        $request->validate([
            'rows'                    => 'required|array|min:1',
            'rows.*.provinsi_id'      => 'required|exists:provinsis,id',
            'rows.*.kabupaten_id'     => 'required|exists:kabupatens,id',
            'rows.*.jenis_nyamuk'     => 'required|string',
            'rows.*.insektisida'      => 'required|string',
            'rows.*.metode'           => 'required|string',
            'rows.*.sampel_diperiksa' => 'required|integer|min:1',
            'rows.*.status'           => 'required|in:resisten,rentan,toleran',
            'rows.*.bulan'            => 'nullable|string',
            'rows.*.alamat'           => 'nullable|string',
            'rows.*.mutasi'           => 'nullable|string',
            'rows.*.publikasi'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->rows as $i => $row) {
                Kabupaten::where('id', $row['kabupaten_id'])
                    ->where('provinsi_id', $row['provinsi_id'])->firstOrFail();
                DataUjiResistensi::create([
                    'no'               => $i + 1,
                    'tahun'            => $row['tahun'] ?? date('Y'),
                    'provinsi_id'      => $row['provinsi_id'],
                    'kabupaten_id'     => $row['kabupaten_id'],
                    'alamat'           => $row['alamat'] ?? null,
                    'jenis_nyamuk'     => $row['jenis_nyamuk'],
                    'insektisida'      => $row['insektisida'],
                    'metode'           => $row['metode'],
                    'sampel_diperiksa' => $row['sampel_diperiksa'],
                    'bulan'            => $row['bulan'] ?? null,
                    'status'           => $row['status'],
                    'mutasi'           => $row['mutasi'] ?? null,
                    'publikasi'        => $row['publikasi'] ?? null,
                ]);
            }
        });
        return redirect()->route('input')->with('success','Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $item = DataUjiResistensi::with(['provinsi','kabupaten'])->findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'provinsi_id'      => 'required|exists:provinsis,id',
            'kabupaten_id'     => 'required|exists:kabupatens,id',
            'jenis_nyamuk'     => 'required|string',
            'insektisida'      => 'required|string',
            'metode'           => 'required|string',
            'sampel_diperiksa' => 'required|integer|min:1',
            'status'           => 'required|in:resisten,rentan,toleran',
            'bulan'            => 'nullable|string',
            'alamat'           => 'nullable|string',
            'mutasi'           => 'nullable|string',
            'publikasi'        => 'nullable|string',
        ]);
        $item = DataUjiResistensi::findOrFail($id);
        Kabupaten::where('id', $request->kabupaten_id)
            ->where('provinsi_id', $request->provinsi_id)->firstOrFail();
        $item->update([
            'provinsi_id'      => $request->provinsi_id,
            'kabupaten_id'     => $request->kabupaten_id,
            'alamat'           => $request->alamat,
            'jenis_nyamuk'     => $request->jenis_nyamuk,
            'insektisida'      => $request->insektisida,
            'metode'           => $request->metode,
            'sampel_diperiksa' => $request->sampel_diperiksa,
            'bulan'            => $request->bulan,
            'status'           => $request->status,
            'mutasi'           => $request->mutasi,
            'publikasi'        => $request->publikasi,
        ]);
        return redirect()->route('input',['tahun'=>$item->tahun])
            ->with('success','Data berhasil diperbarui.');
    }

    public function getKabupaten($provinsi_id)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $provinsi_id)
            ->orderBy('nama_kabupaten','asc')->get();
        return response()->json($kabupatens);
    }

    public function dashboard(Request $request)
    {
        $tahun = $request->get('tahun', 'semua');
        $query = DataUjiResistensi::with(['provinsi','kabupaten']);
        if ($tahun !== 'semua') {
            $query->where('tahun', $tahun);
        }
        $data = $query->get();

        $totalPengujian = $data->count();
        $totalSampel    = $data->sum('sampel_diperiksa');
        $totalProvinsi  = $data->pluck('provinsi_id')->unique()->count();
        $totalKabupaten = $data->pluck('kabupaten_id')->unique()->count();
        $totalResisten  = $data->where('status','resisten')->count();
        $totalRentan    = $data->where('status','rentan')->count();
        $totalToleran   = $data->where('status','toleran')->count();
        $dataTerbaru    = $data->sortByDesc('id')->take(10);

        $distribusiNyamuk = $data->groupBy('jenis_nyamuk')->map(function ($items, $key) {
            return (object)[
                'jenis_nyamuk' => $key,
                'total'        => $items->count()
            ];
        })->sortByDesc('total')->take(5)->values();

        $totalDistribusi = $distribusiNyamuk->sum('total') ?: 1;

        $tahunList = DataUjiResistensi::select('tahun')->distinct()
            ->whereNotNull('tahun')->orderBy('tahun','desc')->pluck('tahun');

        return view('dashboard', compact(
            'data','tahun','totalPengujian','totalSampel','totalProvinsi','totalKabupaten',
            'totalResisten','totalRentan','totalToleran','dataTerbaru','distribusiNyamuk','totalDistribusi','tahunList'
        ));
    }

    public function destroy($id)
    {
        $item = DataUjiResistensi::findOrFail($id);
        $tahun = $item->tahun;
        $item->delete();
        return redirect()->route('input', ['tahun' => $tahun])->with('success','Data berhasil dihapus.');
    }
}