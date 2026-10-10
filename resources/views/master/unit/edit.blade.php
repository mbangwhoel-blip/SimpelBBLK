<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Unit - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800">
@include('sidebar')
<main class="ml-64 min-h-screen p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">{{ isset($unit) ? 'Edit Unit' : 'Tambah Unit' }}</h1>
        <p class="mt-1 text-sm text-slate-500">{{ isset($unit) ? 'Perbarui data unit/instansi' : 'Tambah unit atau instansi baru' }}</p>
    </div>
    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <ul class="list-disc pl-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif
    <div class="max-w-2xl rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ isset($unit) ? route('unit.update', $unit->id) : route('unit.store') }}">
            @csrf
            @if(isset($unit)) @method('PUT') @endif
            <div class="grid grid-cols-2 gap-5">
                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Unit <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_unit" value="{{ old('nama_unit', $unit->nama_unit ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Kode Unit</label>
                    <input type="text" name="kode_unit" value="{{ old('kode_unit', $unit->kode_unit ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Kepala Unit</label>
                    <input type="text" name="kepala_unit" value="{{ old('kepala_unit', $unit->kepala_unit ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $unit->telepon ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $unit->email ?? '') }}" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
                </div>
                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">{{ old('alamat', $unit->alamat ?? '') }}</textarea>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">Simpan</button>
                <a href="{{ route('unit.index') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>