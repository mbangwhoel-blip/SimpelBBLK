<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"><\/script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-slate-50 text-slate-800">

@include('sidebar')

<main class="ml-64 min-h-screen p-6">

    {{-- HEADER --}}
    <section class="mb-6 rounded-2xl border border-blue-100 bg-gradient-to-r from-blue-50 via-white to-purple-50 p-6 shadow-sm">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white text-xl shadow-sm">📊</div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Input Data</h1>
                    <p class="mt-0.5 text-sm text-slate-500">Data uji resistensi nyamuk laboratorium</p>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white px-5 py-3 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tahun Aktif</p>
                <p class="mt-0.5 text-xl font-bold text-slate-800">{{ $tahun }}</p>
            </div>
        </div>
        {{-- FILTER TAHUN --}}
        <form method="GET" action="{{ route('input') }}" class="mt-5 flex items-end gap-3">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Filter Tahun</label>
                <select name="tahun" onchange="this.form.submit()"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @foreach(range(date('Y') - 3, date('Y') + 1) as $y)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </section>

    {{-- STAT CARDS --}}
    <section class="mb-6 grid grid-cols-2 gap-4 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Entri</p>
            <p class="text-xs text-slate-400 mt-0.5">Tahun {{ $tahun }}</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $data->count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Sampel</p>
            <p class="text-xs text-slate-400 mt-0.5">Tahun {{ $tahun }}</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($data->sum('sampel_diperiksa')) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Provinsi</p>
            <p class="text-xs text-slate-400 mt-0.5">Terdata</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $data->unique('provinsi_id')->count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kab/Kota</p>
            <p class="text-xs text-slate-400 mt-0.5">Terdata</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $data->unique('kabupaten_id')->count() }}</p>
        </div>
    </section>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="mb-5 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-3.5 text-sm font-medium text-green-700">
            <svg class="h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-bold">Data belum dapat disimpan:</p>
            <ul class="mt-1.5 list-disc pl-5 space-y-0.5">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- ═══════════════════════════════════════════════════════
         FORM INPUT — CARD PER ENTRI
    ═══════════════════════════════════════════════════════ --}}
    <section class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">

        {{-- Header form --}}
        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100">
                    <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-800">Form Input Data</h2>
                    <p class="text-xs text-slate-500">Isi semua field lalu klik Simpan</p>
                </div>
            </div>
            <button type="button" id="btnTambahInput"
                class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 active:scale-95">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Input
            </button>
        </div>

        {{-- Form --}}
        <form id="formInput" method="POST" action="{{ route('input.store') }}">
            @csrf

            {{-- Container semua card entri --}}
            <div id="entryContainer" class="divide-y divide-slate-100 p-6 space-y-5">

                {{-- CARD ENTRI PERTAMA --}}
                <div class="entry-card relative rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-200 hover:shadow-sm" data-index="0">

                    {{-- Badge nomor + tombol hapus baris --}}
                    <div class="mb-4 flex items-center justify-between">
                        <span class="entry-badge inline-flex items-center gap-1.5 rounded-full bg-blue-600 px-3 py-1 text-xs font-bold text-white">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                            </svg>
                            Entri #1
                        </span>
                        <button type="button" class="btnHapusCard flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-500 transition hover:bg-red-50 opacity-30 cursor-not-allowed">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M3 7h18"/>
                            </svg>
                            Hapus Entri
                        </button>
                    </div>

                    {{-- Grid field 3 kolom --}}
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                        {{-- PROVINSI --}}
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Provinsi <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][provinsi_id]" class="provinsi w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                                <option value="">— Pilih Provinsi —</option>
                                @foreach ($provinsis as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- KABUPATEN --}}
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kota / Kabupaten <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][kabupaten_id]" class="kabupaten w-full rounded-xl border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" disabled required>
                                <option value="">Pilih provinsi dulu</option>
                            </select>
                        </div>

                        {{-- JENIS NYAMUK --}}
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Jenis Nyamuk <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][jenis_nyamuk]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                                <option value="">— Pilih Jenis —</option>
                                <option>Ae. aegypti</option><option>Ae. albopictus</option>
                                <option>Aedes sp</option><option>Culex sp</option>
                                <option>Anopheles</option><option>An. aconitus</option>
                                <option>An. barbirostris</option><option>An. farauti s.s</option>
                                <option>An. Farauti</option><option>An. hyrcanus s.l.</option>
                                <option>An. indefinitus</option><option>An. kochi</option>
                                <option>An. koliensis</option><option>An. letifer</option>
                                <option>An. parensis</option><option>An. peditaeniatus</option>
                                <option>An. punctulatus s.l.</option><option>An. sundaicus s.l.</option>
                                <option>An. tessellatus</option><option>An. Vagus</option>
                            </select>
                        </div>

                        {{-- INSEKTISIDA --}}
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Insektisida <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][insektisida]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                                <option value="">— Pilih Insektisida —</option>
                                <option>Alphacypermethrin</option><option>Bendiocarb</option>
                                <option>Cypermethrin</option><option>Cyfluthrin</option>
                                <option>Deltamethrin</option><option>Deltamethrin 0,025%</option>
                                <option>Lambda-cyhalothrin 0,0025%</option><option>Lamdacyhalothrin</option>
                                <option>Malathion</option><option>Permethrin</option>
                                <option>Sipermethrin</option><option>Temefos (Abate)</option>
                            </select>
                        </div>

                        {{-- METODE --}}
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Metode Uji <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][metode]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                                <option value="">— Pilih Metode —</option>
                                <option>CDC bottle adults</option><option>CDC bottle bioassay</option>
                                <option>Sequencing</option><option>WHO larval bioassay</option>
                                <option>WHO standard bioassay</option><option>WHO susceptibility test</option>
                                <option>WHO test kit adults</option><option>WHO Tube Bioassay</option>
                            </select>
                        </div>

                        {{-- SAMPEL --}}
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Jumlah Sampel <span class="text-red-400 normal-case">*</span></label>
                            <input type="number" name="rows[0][sampel_diperiksa]" min="1" placeholder="Contoh: 25"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        </div>

                    </div>
                </div>
                {{-- / card entri pertama --}}

            </div>
            {{-- / entry container --}}

            {{-- Footer form --}}
            <div class="flex items-center justify-between border-t border-slate-200 bg-slate-50 px-6 py-4">
                <p class="text-xs text-slate-500">
                    <span id="entryCount">1</span> entri siap disimpan
                </p>
                <button type="submit"
                    class="flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 active:scale-95">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Semua
                </button>
            </div>

        </form>
    </section>

    {{-- ═══════════════════════════════════════════════════════
         TABEL DATA TERSIMPAN
    ═══════════════════════════════════════════════════════ --}}
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h2 class="text-base font-bold text-slate-800">Data Tersimpan</h2>
                <p class="mt-0.5 text-xs text-slate-500">{{ $data->count() }} entri &bull; tahun {{ $tahun }}</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-[1000px] w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        <th class="w-10 px-5 py-3">#</th>
                        <th class="px-5 py-3">Provinsi</th>
                        <th class="px-5 py-3">Kota/Kab</th>
                        <th class="px-5 py-3">Jenis Nyamuk</th>
                        <th class="px-5 py-3">Insektisida</th>
                        <th class="px-5 py-3">Metode</th>
                        <th class="px-5 py-3 text-right">Sampel</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($data as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 text-slate-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3 font-medium">{{ $item->provinsi->nama_provinsi ?? '-' }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->kabupaten->nama_kabupaten ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-block rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700">{{ $item->jenis_nyamuk }}</span>
                        </td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->insektisida }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->metode }}</td>
                        <td class="px-5 py-3 text-right font-bold text-slate-800">{{ number_format($item->sampel_diperiksa) }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button"
                                    onclick="openEditModal({{ $item->id }}, {{ $item->provinsi_id }}, {{ $item->kabupaten_id }}, '{{ addslashes($item->jenis_nyamuk) }}', '{{ addslashes($item->insektisida) }}', '{{ addslashes($item->metode) }}', {{ $item->sampel_diperiksa }})"
                                    class="flex items-center gap-1 rounded-lg border border-blue-300 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button type="button"
                                    onclick="openDeleteModal({{ $item->id }})"
                                    class="flex items-center gap-1 rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-500 transition hover:bg-red-100">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M3 7h18"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-14 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">
                                    <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-500">Belum ada data untuk tahun {{ $tahun }}</p>
                                <p class="text-xs text-slate-400">Isi form di atas untuk menambahkan data baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</main>

{{-- ═══════════════════════════════════════════════════════
     CARD TEMPLATE (di-render server, di-clone JS)
═══════════════════════════════════════════════════════ --}}
<template id="cardTemplate">
    <div class="entry-card relative rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-200 hover:shadow-sm" data-index="__IDX__">
        <div class="mb-4 flex items-center justify-between">
            <span class="entry-badge inline-flex items-center gap-1.5 rounded-full bg-blue-600 px-3 py-1 text-xs font-bold text-white">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                </svg>
                Entri #__NUM__
            </span>
            <button type="button" class="btnHapusCard flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-500 transition hover:bg-red-50">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M3 7h18"/>
                </svg>
                Hapus Entri
            </button>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Provinsi <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][provinsi_id]" class="provinsi w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">— Pilih Provinsi —</option>
                    @foreach ($provinsis as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_provinsi }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kota / Kabupaten <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][kabupaten_id]" class="kabupaten w-full rounded-xl border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" disabled required>
                    <option value="">Pilih provinsi dulu</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Jenis Nyamuk <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][jenis_nyamuk]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">— Pilih Jenis —</option>
                    <option>Ae. aegypti</option><option>Ae. albopictus</option>
                    <option>Aedes sp</option><option>Culex sp</option>
                    <option>Anopheles</option><option>An. aconitus</option>
                    <option>An. barbirostris</option><option>An. farauti s.s</option>
                    <option>An. Farauti</option><option>An. hyrcanus s.l.</option>
                    <option>An. indefinitus</option><option>An. kochi</option>
                    <option>An. koliensis</option><option>An. letifer</option>
                    <option>An. parensis</option><option>An. peditaeniatus</option>
                    <option>An. punctulatus s.l.</option><option>An. sundaicus s.l.</option>
                    <option>An. tessellatus</option><option>An. Vagus</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Insektisida <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][insektisida]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">— Pilih Insektisida —</option>
                    <option>Alphacypermethrin</option><option>Bendiocarb</option>
                    <option>Cypermethrin</option><option>Cyfluthrin</option>
                    <option>Deltamethrin</option><option>Deltamethrin 0,025%</option>
                    <option>Lambda-cyhalothrin 0,0025%</option><option>Lamdacyhalothrin</option>
                    <option>Malathion</option><option>Permethrin</option>
                    <option>Sipermethrin</option><option>Temefos (Abate)</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Metode Uji <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][metode]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">— Pilih Metode —</option>
                    <option>CDC bottle adults</option><option>CDC bottle bioassay</option>
                    <option>Sequencing</option><option>WHO larval bioassay</option>
                    <option>WHO standard bioassay</option><option>WHO susceptibility test</option>
                    <option>WHO test kit adults</option><option>WHO Tube Bioassay</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Jumlah Sampel <span class="text-red-400 normal-case">*</span></label>
                <input type="number" name="rows[__IDX__][sampel_diperiksa]" min="1" placeholder="Contoh: 25"
                    class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
            </div>
        </div>
    </div>
</template>

{{-- MODAL EDIT --}}
<div id="editModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-2xl rounded-2xl bg-white shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Edit Data</h3>
                <p class="text-xs text-slate-500 mt-0.5">Ubah data uji resistensi</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4 p-6">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Provinsi <span class="text-red-500">*</span></label>
                    <select id="editProvinsi" name="provinsi_id" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinsis as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_provinsi }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Kota/Kabupaten <span class="text-red-500">*</span></label>
                    <select id="editKabupaten" name="kabupaten_id" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" disabled required>
                        <option value="">Pilih Provinsi Dulu</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Jenis Nyamuk <span class="text-red-500">*</span></label>
                    <select id="editJenisNyamuk" name="jenis_nyamuk" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="">Pilih Jenis</option>
                        <option>Ae. aegypti</option><option>Ae. albopictus</option>
                        <option>Aedes sp</option><option>Culex sp</option>
                        <option>Anopheles</option><option>An. aconitus</option>
                        <option>An. barbirostris</option><option>An. farauti s.s</option>
                        <option>An. Farauti</option><option>An. hyrcanus s.l.</option>
                        <option>An. indefinitus</option><option>An. kochi</option>
                        <option>An. koliensis</option><option>An. letifer</option>
                        <option>An. parensis</option><option>An. peditaeniatus</option>
                        <option>An. punctulatus s.l.</option><option>An. sundaicus s.l.</option>
                        <option>An. tessellatus</option><option>An. Vagus</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Insektisida <span class="text-red-500">*</span></label>
                    <select id="editInsektisida" name="insektisida" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="">Pilih Insektisida</option>
                        <option>Alphacypermethrin</option><option>Bendiocarb</option>
                        <option>Cypermethrin</option><option>Cyfluthrin</option>
                        <option>Deltamethrin</option><option>Deltamethrin 0,025%</option>
                        <option>Lambda-cyhalothrin 0,0025%</option><option>Lamdacyhalothrin</option>
                        <option>Malathion</option><option>Permethrin</option>
                        <option>Sipermethrin</option><option>Temefos (Abate)</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Metode <span class="text-red-500">*</span></label>
                    <select id="editMetode" name="metode" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="">Pilih Metode</option>
                        <option>CDC bottle adults</option><option>CDC bottle bioassay</option>
                        <option>Sequencing</option><option>WHO larval bioassay</option>
                        <option>WHO standard bioassay</option><option>WHO susceptibility test</option>
                        <option>WHO test kit adults</option><option>WHO Tube Bioassay</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Sampel Diperiksa <span class="text-red-500">*</span></label>
                    <input type="number" id="editSampel" name="sampel_diperiksa" min="1"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 rounded-b-2xl">
                <button type="button" onclick="closeEditModal()" class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                    Batal
                </button>
                <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div id="deleteModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4">
    <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">
        <div class="text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100">
                <svg class="h-7 w-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.3 3.8L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7-3L12.7 3.8a2 2 0 00-3.4 0z"/>
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-bold text-slate-800">Hapus Data?</h3>
            <p class="mt-2 text-sm text-slate-500">Data yang sudah dihapus tidak dapat dikembalikan.</p>
        </div>
        <div class="mt-6 flex justify-center gap-3">
            <button type="button" onclick="closeDeleteModal()" class="rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Batal
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const KABUPATEN_URL = '{{ url("/kabupaten") }}';
const INPUT_URL     = '{{ url("/input") }}';

/* ═══ LOAD KABUPATEN ═══════════════════════════════════ */
function loadKabupaten(provSel, kabSel, selectedId) {
    const id = provSel.value;
    if (!id) {
        kabSel.innerHTML = '<option value="">Pilih provinsi dulu</option>';
        kabSel.disabled = true;
        kabSel.classList.replace('bg-white', 'bg-slate-100');
        return;
    }
    kabSel.innerHTML = '<option>Memuat data...</option>';
    kabSel.disabled = true;

    fetch(KABUPATEN_URL + '/' + id)
        .then(r => r.ok ? r.json() : Promise.reject())
        .then(list => {
            kabSel.innerHTML = '<option value="">— Pilih Kota/Kabupaten —</option>';
            list.forEach(item => {
                const o = document.createElement('option');
                o.value = item.id;
                o.textContent = item.nama_kabupaten;
                if (selectedId && item.id == selectedId) o.selected = true;
                kabSel.appendChild(o);
            });
            kabSel.disabled = false;
            kabSel.classList.replace('bg-slate-100', 'bg-white');
            kabSel.classList.replace('text-slate-500', 'text-slate-700');
        })
        .catch(() => {
            kabSel.innerHTML = '<option value="">Gagal memuat</option>';
        });
}

/* ═══ ATTACH EVENTS KE CARD ════════════════════════════ */
function attachCardEvents(card) {
    const prov = card.querySelector('.provinsi');
    const kab  = card.querySelector('.kabupaten');
    const btn  = card.querySelector('.btnHapusCard');

    if (prov && kab) {
        prov.addEventListener('change', () => loadKabupaten(prov, kab, null));
    }
    if (btn) {
        btn.addEventListener('click', () => {
            const cards = document.querySelectorAll('.entry-card');
            if (cards.length <= 1) return;
            card.remove();
            reindexCards();
        });
    }
}

/* ═══ REINDEX SEMUA CARD ═══════════════════════════════ */
function reindexCards() {
    const cards = document.querySelectorAll('.entry-card');
    cards.forEach((card, i) => {
        // Update badge
        const badge = card.querySelector('.entry-badge');
        if (badge) badge.childNodes[badge.childNodes.length - 1].textContent = ' Entri #' + (i + 1);

        // Reindex semua name
        card.querySelectorAll('[name]').forEach(el => {
            el.name = el.name.replace(/rows\[\d+\]/, 'rows[' + i + ']');
        });

        // Update data-index
        card.dataset.index = i;

        // Tombol hapus — disable jika hanya 1 card
        const btn = card.querySelector('.btnHapusCard');
        if (!btn) return;
        if (cards.length <= 1) {
            btn.classList.add('opacity-30', 'cursor-not-allowed');
        } else {
            btn.classList.remove('opacity-30', 'cursor-not-allowed');
        }
    });

    // Update counter
    const counter = document.getElementById('entryCount');
    if (counter) counter.textContent = cards.length;
}

/* ═══ TAMBAH INPUT BARU ════════════════════════════════ */
document.getElementById('btnTambahInput').addEventListener('click', function () {
    const cards    = document.querySelectorAll('.entry-card');
    const idx      = cards.length;
    const template = document.getElementById('cardTemplate');
    const clone    = template.content.cloneNode(true);
    const card     = clone.querySelector('.entry-card');

    // Ganti __IDX__ dan __NUM__
    card.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace('__IDX__', idx);
    });
    card.dataset.index = idx;
    const badge = card.querySelector('.entry-badge');
    if (badge) badge.childNodes[badge.childNodes.length - 1].textContent = ' Entri #' + (idx + 1);

    document.getElementById('entryContainer').appendChild(card);
    attachCardEvents(document.querySelector('.entry-card:last-child'));
    reindexCards();

    // Scroll ke card baru
    document.querySelector('.entry-card:last-child').scrollIntoView({ behavior: 'smooth', block: 'center' });
});

/* ═══ INIT CARD PERTAMA ════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function () {
    const firstCard = document.querySelector('.entry-card');
    if (firstCard) { attachCardEvents(firstCard); reindexCards(); }
});

/* ═══ MODAL EDIT ═══════════════════════════════════════ */
window.openEditModal = function(id, provinsiId, kabupatenId, jenisNyamuk, insektisida, metode, sampel) {
    document.getElementById('editForm').action = INPUT_URL + '/' + id;
    document.getElementById('editJenisNyamuk').value = jenisNyamuk;
    document.getElementById('editInsektisida').value = insektisida;
    document.getElementById('editMetode').value      = metode;
    document.getElementById('editSampel').value      = sampel;

    const provSel = document.getElementById('editProvinsi');
    const kabSel  = document.getElementById('editKabupaten');
    provSel.value = provinsiId;

    kabSel.innerHTML = '<option>Memuat...</option>';
    kabSel.disabled = true;
    fetch(KABUPATEN_URL + '/' + provinsiId)
        .then(r => r.ok ? r.json() : Promise.reject())
        .then(list => {
            kabSel.innerHTML = '<option value="">— Pilih Kota/Kabupaten —</option>';
            list.forEach(item => {
                const o = document.createElement('option');
                o.value = item.id;
                o.textContent = item.nama_kabupaten;
                if (item.id == kabupatenId) o.selected = true;
                kabSel.appendChild(o);
            });
            kabSel.disabled = false;
            kabSel.classList.replace('bg-slate-100', 'bg-white');
        })
        .catch(() => { kabSel.innerHTML = '<option value="">Gagal memuat</option>'; });

    provSel.onchange = function() {
        loadKabupaten(provSel, kabSel, null);
    };

    const modal = document.getElementById('editModal');
    modal.classList.replace('hidden', 'flex');
};

window.closeEditModal = function() {
    document.getElementById('editModal').classList.replace('flex', 'hidden');
    document.getElementById('editProvinsi').onchange = null;
};

/* ═══ MODAL HAPUS ══════════════════════════════════════ */
window.openDeleteModal = function(id) {
    document.getElementById('deleteForm').action = INPUT_URL + '/' + id;
    document.getElementById('deleteModal').classList.replace('hidden', 'flex');
};

window.closeDeleteModal = function() {
    document.getElementById('deleteModal').classList.replace('flex', 'hidden');
};

// Tutup modal klik overlay
['editModal', 'deleteModal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) this.classList.replace('flex', 'hidden');
    });
});
</script>

</body>
</html>