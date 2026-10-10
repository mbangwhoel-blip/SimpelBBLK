<?php
namespace App\Http\Controllers;
use App\Models\Unit;
use Illuminate\Http\Request;
class UnitController extends Controller {
    public function index() {
        $units = Unit::latest()->paginate(15);
        return view('master.unit.index', compact('units'));
    }
    public function create() { return view('master.unit.create'); }
    public function store(Request $request) {
        $request->validate(['nama_unit'=>'required|string|max:255', 'kode_unit'=>'nullable|string|max:50']);
        Unit::create($request->all());
        return redirect()->route('unit.index')->with('success', 'Unit berhasil ditambahkan.');
    }
    public function edit($id) {
        $unit = Unit::findOrFail($id);
        return view('master.unit.edit', compact('unit'));
    }
    public function update(Request $request, $id) {
        $request->validate(['nama_unit'=>'required|string|max:255']);
        Unit::findOrFail($id)->update($request->all());
        return redirect()->route('unit.index')->with('success', 'Unit berhasil diperbarui.');
    }
    public function destroy($id) {
        Unit::findOrFail($id)->delete();
        return redirect()->route('unit.index')->with('success', 'Unit berhasil dihapus.');
    }
}