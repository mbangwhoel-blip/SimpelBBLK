<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Koordinat - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800">
@include('sidebar')
<main class="ml-64 min-h-screen p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Edit Koordinat</h1>
        <p class="mt-1 text-sm text-slate-500">{{ $kabupaten->nama_kabupaten }} — {{ $kabupaten->provinsi->nama_provinsi ?? '' }}</p>
    </div>
    <div class="max-w-lg rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('wilayah.update', $kabupaten->id) }}">
            @csrf @method('PUT')
            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm text-red-700">
                    @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
                </div>
            @endif
            <div class="mb-4">
                <label class="mb-1.5 block text-sm font-semibold text-slate-700">Latitude <span class="text-xs font-normal text-slate-400">(-90 hingga 90)</span></label>
                <input type="number" step="any" name="latitude" value="{{ old('latitude', $kabupaten->latitude) }}" placeholder="contoh: -7.0806" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div class="mb-6">
                <label class="mb-1.5 block text-sm font-semibold text-slate-700">Longitude <span class="text-xs font-normal text-slate-400">(-180 hingga 180)</span></label>
                <input type="number" step="any" name="longitude" value="{{ old('longitude', $kabupaten->longitude) }}" placeholder="contoh: 110.9173" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">Simpan</button>
                <a href="{{ route('wilayah.index') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>

</main>
</body>
</html>