<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Wilayah - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800">
@include('sidebar')
<main class="ml-64 min-h-screen p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Wilayah</h1>
            <p class="mt-1 text-sm text-slate-500">Data provinsi dan kabupaten beserta koordinat peta</p>
        </div>
        <button type="button" onclick="openTambahWilayah()" class="flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            + Tambah Wilayah
        </button>
    </div>
    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-sm font-medium text-green-700">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-bold">Wilayah belum dapat disimpan:</p>
            <ul class="mt-1.5 list-disc pl-5 space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif
    <form method="GET" action="{{ route('wilayah.index') }}" class="mb-5 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari kabupaten..." class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none w-64">
        <select name="provinsi_id" class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
            <option value="">Semua Provinsi</option>
            @foreach($provinsis as $p)
                <option value="{{ $p->id }}" {{ request('provinsi_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_provinsi }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Filter</button>
        <a href="{{ route('wilayah.index') }}" class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">Reset</a>
    </form>
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-5 py-4 text-left">No</th>
                    <th class="px-5 py-4 text-left">Kabupaten / Kota</th>
                    <th class="px-5 py-4 text-left">Provinsi</th>
                    <th class="px-5 py-4 text-left">Latitude</th>
                    <th class="px-5 py-4 text-left">Longitude</th>
                    <th class="px-5 py-4 text-center">Status</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($kabupatens as $kab)
                <tr class="hover:bg-slate-50">
                    <td class="px-5 py-3 text-slate-400">{{ $kabupatens->firstItem() + $loop->index }}</td>
                    <td class="px-5 py-3 font-medium">{{ $kab->nama_kabupaten }}</td>
                    <td class="px-5 py-3 text-slate-600">{{ $kab->provinsi->nama_provinsi ?? '—' }}</td>
                    <td class="px-5 py-3 font-mono text-xs text-slate-600">{{ $kab->latitude ?? '—' }}</td>
                    <td class="px-5 py-3 font-mono text-xs text-slate-600">{{ $kab->longitude ?? '—' }}</td>
                    <td class="px-5 py-3 text-center">
                        @if($kab->latitude && $kab->longitude)
                            <span class="inline-block rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-bold text-green-700">✓ Ada</span>
                        @else
                            <span class="inline-block rounded-full bg-slate-100 px-2.5 py-0.5 text-xs text-slate-500">Kosong</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-center">
                        <a href="{{ route('wilayah.edit', $kab->id) }}" class="rounded-lg border border-blue-300 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 hover:bg-blue-100">
                            Edit Koordinat
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-5 py-12 text-center text-sm text-slate-400">Tidak ada data wilayah.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="border-t border-slate-200 px-5 py-4">{{ $kabupatens->links() }}</div>
    </div>

</main>

{{-- MODAL TAMBAH WILAYAH --}}
<div id="tambahModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-lg rounded-2xl bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Tambah Wilayah</h3>
                <p class="text-xs text-slate-500 mt-0.5">Tambah kabupaten / kota baru</p>
            </div>
            <button type="button" onclick="closeTambahWilayah()" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('wilayah.store') }}">
            @csrf
            <div class="grid grid-cols-1 gap-4 p-6">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Provinsi <span class="text-red-500">*</span></label>
                    <select name="provinsi_id" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinsis as $p)
                            <option value="{{ $p->id }}" {{ old('provinsi_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_provinsi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Kabupaten / Kota <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_kabupaten" value="{{ old('nama_kabupaten') }}" placeholder="Contoh: Kabupaten Kebumen"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Latitude <span class="text-slate-400 font-normal">(opsional)</span></label>
                        <input type="text" name="latitude" value="{{ old('latitude') }}" placeholder="-7.6"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold text-slate-700">Longitude <span class="text-slate-400 font-normal">(opsional)</span></label>
                        <input type="text" name="longitude" value="{{ old('longitude') }}" placeholder="110.6"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 rounded-b-2xl">
                <button type="button" onclick="closeTambahWilayah()" class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                    Batal
                </button>
                <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
window.openTambahWilayah = function() {
    document.getElementById('tambahModal').classList.replace('hidden', 'flex');
};
window.closeTambahWilayah = function() {
    document.getElementById('tambahModal').classList.replace('flex', 'hidden');
};
document.getElementById('tambahModal').addEventListener('click', function(e) {
    if (e.target === this) this.classList.replace('flex', 'hidden');
});
@if($errors->any())
    openTambahWilayah();
@endif
</script>
</body>
</html>