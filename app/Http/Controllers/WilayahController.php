<?php
namespace App\Http\Controllers;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
class WilayahController extends Controller {
    public function index(Request $request) {
        $search = $request->get('search');
        $provinsis = Provinsi::orderBy('nama_provinsi')->get();
        $query = Kabupaten::with('provinsi');
        if ($search) $query->where('nama_kabupaten', 'like', "%$search%");
        if ($request->provinsi_id) $query->where('provinsi_id', $request->provinsi_id);
        $kabupatens = $query->orderBy('nama_kabupaten')->paginate(20)->withQueryString();
        return view('master.wilayah.index', compact('provinsis', 'kabupatens', 'search'));
    }
    public function store(Request $request) {
        $request->validate([
            'provinsi_id'    => 'required|exists:provinsis,id',
            'nama_kabupaten' => 'required|string|max:255',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
        ]);
        Kabupaten::create([
            'provinsi_id'    => $request->provinsi_id,
            'nama_kabupaten' => $request->nama_kabupaten,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
        ]);
        return redirect()->route('wilayah.index')->with('success', 'Wilayah berhasil ditambahkan.');
    }
    public function editKoordinat($id) {
        $kabupaten = Kabupaten::with('provinsi')->findOrFail($id);
        return view('master.wilayah.edit', compact('kabupaten'));
    }
    public function updateKoordinat(Request $request, $id) {
        $request->validate(['latitude'=>'nullable|numeric|between:-90,90', 'longitude'=>'nullable|numeric|between:-180,180']);
        Kabupaten::findOrFail($id)->update(['latitude'=>$request->latitude, 'longitude'=>$request->longitude]);
        return redirect()->route('wilayah.index')->with('success', 'Koordinat berhasil diperbarui.');
    }
}