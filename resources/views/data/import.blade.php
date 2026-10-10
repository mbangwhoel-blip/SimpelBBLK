<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800">
@include('sidebar')
<main class="ml-64 min-h-screen p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Import Data</h1>
            <p class="mt-1 text-sm text-slate-500">Upload file Excel (.xlsx) untuk memasukkan data secara massal</p>
        </div>
        <a href="{{ route('export.template') }}" class="flex items-center gap-2 rounded-xl border border-blue-300 bg-blue-50 px-5 py-2.5 text-sm font-semibold text-blue-600 hover:bg-blue-100">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3"/></svg>
            Download Template
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-sm font-medium text-green-700">
            {{ session('success') }}
            @if(session('errors_import'))
                <ul class="mt-2 list-disc pl-5 text-red-600">
                    @foreach(session('errors_import') as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            @endif
        </div>
    @endif
    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm text-red-700">
            @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="mb-5 text-base font-bold text-slate-800">Upload File Excel</h2>
            <form method="POST" action="{{ route('import.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">File (.xlsx atau .xls)</label>
                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-700" required>
                    <p class="mt-1.5 text-xs text-slate-500">Maksimal 5MB. Gunakan template yang disediakan.</p>
                </div>
                <button type="submit" class="w-full rounded-xl bg-blue-600 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    Import Data
                </button>
            </form>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="mb-4 text-base font-bold text-slate-800">Petunjuk Import</h2>
            <div class="space-y-3 text-sm text-slate-600">
                <div class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600">1</span><p>Download template Excel dengan klik tombol <strong>Download Template</strong> di kanan atas.</p></div>
                <div class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600">2</span><p>Isi data sesuai kolom: <strong>provinsi, kabupaten, jenis_nyamuk, insektisida, metode, sampel_diperiksa, status, mutasi, tahun</strong>.</p></div>
                <div class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600">3</span><p>Kolom <strong>status</strong> diisi: <code class="rounded bg-slate-100 px-1">resisten</code>, <code class="rounded bg-slate-100 px-1">rentan</code>, atau <code class="rounded bg-slate-100 px-1">toleran</code>.</p></div>
                <div class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600">4</span><p>Nama <strong>kabupaten/kota</strong> dicocokkan otomatis ke master data. Prefiks <code class="rounded bg-slate-100 px-1">Kab</code>/<code class="rounded bg-slate-100 px-1">Kota</code> boleh ditulis atau tidak.</p></div>
                <div class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600">5</span><p>Koordinat <strong>latitude &amp; longitude</strong> terisi otomatis dari master wilayah kabupaten.</p></div>
                <div class="flex gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-600">6</span><p>Kolom <strong>mutasi</strong> boleh dikosongkan.</p></div>
            </div>
        </div>
    </div>

</main>
</body>
</html>