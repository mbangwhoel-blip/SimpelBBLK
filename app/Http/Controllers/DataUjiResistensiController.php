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
        $tahun = $request->get('tahun', date('Y'));
        $data = DataUjiResistensi::with(['provinsi', 'kabupaten'])
            ->where('tahun', $tahun)
            ->latest()
            ->get();
        return view('input', compact('provinsis', 'data', 'tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rows'                    => 'required|array|min:1',
            'rows.*.provinsi_id'      => 'required|exists:provinsis,id',
            'rows.*.kabupaten_id'     => 'required|exists:kabupatens,id',
            'rows.*.jenis_nyamuk'     => 'required|string',
            'rows.*.insektisida'      => 'required|string',
            'rows.*.metode'           => 'required|string',
            'rows.*.sampel_diperiksa' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->rows as $index => $row) {
                Kabupaten::where('id', $row['kabupaten_id'])
                    ->where('provinsi_id', $row['provinsi_id'])
                    ->firstOrFail();
                DataUjiResistensi::create([
                    'no'               => $index + 1,
                    'tahun'            => date('Y'),
                    'provinsi_id'      => $row['provinsi_id'],
                    'kabupaten_id'     => $row['kabupaten_id'],
                    'jenis_nyamuk'     => $row['jenis_nyamuk'],
                    'insektisida'      => $row['insektisida'],
                    'metode'           => $row['metode'],
                    'sampel_diperiksa' => $row['sampel_diperiksa'],
                ]);
            }
        });

        return redirect()->route('input')->with('success', 'Data berhasil disimpan.');
    }

    public function getKabupaten($provinsi_id)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $provinsi_id)
            ->orderBy('nama_kabupaten', 'asc')
            ->get();
        return response()->json($kabupatens);
    }

    public function dashboard()
    {
        $data = DataUjiResistensi::with(['provinsi', 'kabupaten'])->get();
        return view('dashboard', compact('data'));
    }

    public function destroy($id)
    {
        $data = DataUjiResistensi::findOrFail($id);
        $data->delete();
        return redirect()->route('input')->with('success', 'Data berhasil dihapus.');
    }
}