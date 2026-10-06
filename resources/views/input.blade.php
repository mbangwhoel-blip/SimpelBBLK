<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Input Data - SIMPEL BBLKL</title>

</head>


<body class="bg-slate-50 text-slate-800">

    {{-- SIDEBAR --}}

    @include('sidebar')


    {{-- MAIN--}}

    <main class="ml-64 min-h-screen p-6">

        {{-- HEADER --}}
        <section class="mb-6 rounded-2xl border border-blue-100 bg-gradient-to-r from-blue-50 via-white to-purple-50 p-6 shadow-sm">

            <div class="flex flex-wrap items-start justify-between gap-5">
                
                <div>
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                            📊
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-slate-900">
                                Input Bulanan
                            </h1>

                            <p class="mt-1 text-sm text-slate-500">
                                Penginputan data uji resistensi laboratorium
                            </p>
                        </div>

                    </div>

                    <div class="mt-4 flex flex-wrap items-center gap-2 text-sm text-slate-600">
                        
                        <span> 
                            Lab:
                            <strong class="text-slate-800">
                                Balai Besar Laboratorium Kesehatan Lingkungan
                            </strong>
                        </span>

                        <span>•</span>

                        <span>
                            Filter:
                            <strong class="text-slate-800">
                               Semua bulan 2026
                            </strong>
                        </span>

                    </div>
                </div>

                {{-- PERIODE --}}
                <div class="rounded-xl border-border-slate-200 bg-white px-5 py-4 shadow-sm">
        
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                        Entri pada
                    </p>

                    <p class="mt-1 text-lg font-bold text-slate-800">
                        Oktober 2026
                    </p>

                </div>

            </div>

            {{-- FILTER --}}
            <div class="mt-6 grid gap-4 md:grid-cols-2">
                
                {{-- BULAN --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Bulan
                    </label>

                    <select class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option>
                            Semua bulan
                        </option>

                        <option>
                            Januari
                        </option>

                        <option>
                            Februari
                        </option>

                        <option>
                            Maret
                        </option>

                        <option>
                            April
                        </option>

                        <option>
                            Mei
                        </option>

                        <option>
                            Juni
                        </option>

                        <option>
                            Juli
                        </option>

                        <option>
                            Agustus
                        </option>

                        <option>
                            September
                        </option>

                        <option selected>
                            Oktober
                        </option>

                        <option>
                            November
                        </option>

                        <option>
                            Desember
                        </option>

                    </select>

                </div>


                {{-- TAHUN --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold ttext-slate-700">
                        Tahun
                    </label>

                    <select class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option>
                            2024
                        </option>

                        <option>
                            2025
                        </option>

                        <option selected>
                            2026
                        </option>

                        <option>
                            2027
                        </option>

                    </select>

                </div>

            </div>

        </section>

        {{-- STATISTIC CARDS --}}
        <section class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    
            {{-- ITEM BULAN --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">
    
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Item
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Filter Bulan
                        </p>

                    </div>
                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900"> 
                    {{ $data->count() }}
                </p>

            </div>

            {{-- SAMPEL BULAN --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                
                <div class="flex items-start justify-between">
                
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Sampel
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Filter Bulan
                        </p>

                    </div>

                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $data->sum('sampel_diperiksa') }}
                </p>

            </div>

            {{-- ITEM TAHUN --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                      
                <div class="flex items-start justify-between">
                          
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Item
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Tahun Berjalan
                        </p>

                    </div>

                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $data->count() }}
                </p>

            </div>

            {{-- SAMPEL TAHUN --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Sampel
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Tahun Berjalan
                        </p>

                    </div>

                </div>

                <p class="mt-4 text-3xl font-bold text-slate-900">
                    {{ $data->sum('sampel_diperiksa') }}
                </p>

            </div>

        </section>

        {{-- INFO --}}
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-blue-100 bg-blue-50 px-5 py-4 text-sm text-bluee-800">

            <div>
                <strong>
                    Data yang akan di entri:
                </strong>
                Bulan Oktober, Tahun 2026
            </div>

        </div>

        {{-- PESAN SUCCESS --}}

        @if (session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR --}}

        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
 
                <p class="font-bold">
                    Data belum dapat disimpan:
                </p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORM INPUT --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 shadow-sm">

            {{-- HEADER TABLE --}}
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="h-3 w-3 rounded-full bg-blue-600"></div>

                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            Form Entri
                        </h2>

                        <p class="text-xs text-slate-500">
                            Masukkan data pemeriksaan laboratorium
                        </p>

                    </div>

                </div>

                <div class="flex flex-wrap gap-2">

                    <button type="button" id="btnTambahBaris" class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                        + Tambah Baris
                    </button>

                </div>

            </div>

            {{-- FORM --}}
            <form id="formInput" method="POST" action="{{ route('input.store') }}">
                @csrf

                {{-- TABLE WRAPPER --}}
                <div class="overflow-x-auto">

                    <table class="min-w-[1500px] w-full border-collapse">

                        {{-- TABLE HEAD --}}
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">

                                <th class="w-16 px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                    No
                                </th>

                                <th  class="min-w-[220px] px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Provinsi
                                </th>

                                <th class="min-w-[220px] px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Kota/Kab
                                </th>

                                <th class="min-w-[190px] px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">

                                    Jenis Nyamuk
                                </th>

                                <th class="min-w-[230px] px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500>">
                                    Insektisida
                                </th>

                                <th class="min-w-[190px] px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Metode
                                </th>

                                <th class="min-w-[170px] px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Sampel Diperiksa
                                </th>

                                <th class="w-24 px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- TABLE BODY --}}
                        <tbody id="tableBody">

                            {{-- BARIS PERTAMA --}}
                            <tr class="entry-row border-b border-slate-100 transition hover:bg-slate-50">

                                {{-- NO --}}
                                <td class="row-number px-4 py-4 align-top text-sm font-semibold text-slate-600">
                                    1
                                </td>

                                {{-- PROVINSI --}}
                                <td class="px-4 py-4 align-top">

                                    <select 
                                        name="rows[0][provinsi_id]" 
                                        class="provinsi w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"      
                                        required>

                                        <option value="">
                                            Pilih Provinsi
                                        </option>

                                        @foreach ($provinsis as $provinsi)

                                            <option value="{{ $provinsi->id }}">
                                                {{ $provinsi->nama_provinsi }}
                                            </option>

                                        @endforeach

                                    </select>

                                </td>


                                {{-- KABUPATEN --}}

                                <td class="px-4 py-4  align-top">

                                    <select name="rows[0][kabupaten_id]" class="kabupaten w-full rounded-lg border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 disabled:cursor-not-allowed"
                                        disabled
                                        required>

                                        <option value="">
                                            Pilih Provinsi Terlebih Dahulu
                                        </option>

                                    </select>

                                </td>


                                {{-- Jenis Nyamuk --}}
                                <td class="px-4 py-4 align-top">

                                    <select 
                                        name="rows[0][jenis_nyamuk]" 
                                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm"
                                        required
                                    >

                                        <option value="">
                                            Pilih Jenis
                                        </option>

                                        <option value="Ae. aegypti">
                                            Ae. aegypti
                                        </option>

                                        <option value="Culex sp">
                                            Culex sp
                                        </option>

                                        <option value="Anhopheles">
                                            Anhopheles
                                        </option>

                                        <option value="Aedes sp">
                                            Aedes sp
                                        </option>

                                        <option value="An. Farauti">
                                            An. Farauti
                                        </option>

                                        <option value="An. Vagus">
                                            An. Vagus
                                        </option>

                                        <option value="An. tessellatus">
                                            An. tessellatus
                                        </option>

                                        <option value="An. sundaicus s.I">
                                            An. sundaicus s.I
                                        </option>

                                        <option value="An. punctulatus s.I.">
                                            An. punctulatus s.I.
                                        </option>

                                        <option value="An. peditaeniatus">
                                            An. peditaeniatus
                                        </option>

                                        <option value="An. parensis">
                                            An. parensis
                                        </option>

                                        <option value="An. letifer">
                                            An. letifer
                                        </option>

                                        <option value="An. koliensis">
                                            An. koliensis
                                        </option>

                                        <option value="An. kochi">
                                            An. kochi
                                        </option>

                                        <option value="An. indefinitus">
                                            An. indefinitus
                                        </option>

                                        <option value="An. hyrcanus s.I.">
                                            An. hyrcanus s.I.
                                        </option>

                                        <option value="An. farauti s.s">
                                            An. farauti s.s
                                        </option>

                                        <option value="An. barbirostris">
                                            An. barbirostris
                                        </option>

                                        <option value="An. aconitus">
                                            An. aconitus
                                        </option>

                                        <option value="An. Albopictus">
                                            An. Albopictus
                                        </option>

                                    </select>

                                </td>

                                {{-- INSEKTISIDA --}}
                                <td class="px-4 py-4 align-top">

                                    <select 
                                        name="rows[0][insektisida]" 
                                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm"
                                        required
                                    >

                                        <option value="">
                                            Pilih Insektisida
                                        </option>

                                        <option value="Cypermethrin">
                                            Cypermethrin
                                        </option>

                                        <option value="Lamdacyhalothrin">
                                            Lamdacyhalothrin
                                        </option>

                                        <option value="Deltamethrin">
                                            Deltamethrin
                                        </option>

                                        <option value="Alphacypermethrin">
                                            Alphacypermethrin
                                        </option>

                                        <option value="Cyfluthrin">
                                            Cyfluthrin
                                        </option>

                                        <option value="Permethrin">
                                           Permethrin
                                        </option>

                                        <option value="Malathion">
                                           Malathion
                                        </option>

                                        <option value="Deltamethrin 0,025%">
                                           Deltamethrin 0,025%
                                        </option>

                                        <option value="Lambda-cyhalothrin 0,0025%">
                                           Lambda-cyhalothrin 0,0025%
                                        </option>

                                        <option value="Temefos (Abate)">
                                           Temefos (Abate)
                                        </option>

                                        <option value="Bendiocarb">
                                           Bendiocarb
                                        </option>

                                        <option value="Sipermethrin">
                                           Sipermethrin
                                        </option>

                                    </select>

                                </td>


                                {{-- METODE --}}
                                <td class="px-4 py-4 align-top">

                                    <select 
                                        name="rows[0][metode]" 
                                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm"
                                        required
                                    >

                                        <option value="">
                                            Pilih Metode
                                        </option>

                                        <option value="Sequencing">
                                            Sequencing
                                        </option>

                                        <option value="WHO Tube Bioassay">
                                            WHO Tube Bioassay
                                        </option>

                                        <option value="WHO larval bioassay">
                                            WHO larval bioassay
                                        </option>

                                        <option value="WHO susceptibilitity test">
                                            WHO susceptibilitity test
                                        </option>

                                        <option value="WHO test kit_adullts">
                                            WHO test kit_adults
                                        </option>

                                        <option value="CDC bottle_adults">
                                            WHO bottle_adults
                                        </option>

                                        <option value="CDC bottle bioassay">
                                            CDC bottle bioassay
                                        </option>

                                        <option value="WHO standars bioassay">
                                            WHO standards bioassay
                                        </option>

                                    </select>

                                </td>

                                {{-- JUMLAH SAMPEL --}}
                                <td class="px-4 py-4 align-top">

                                    <input type="number" name="rows[0][sampel_diperiksa]" min="1" placeholder="0"
                                        class="w-full
                                               rounded-lg
                                               border
                                               border-slate-300
                                               bg-white
                                               px-3
                                               py-2.5
                                               text-sm
                                               focus:border-blue-500
                                               focus:outline-none
                                               focus:ring-2
                                               focus:ring-blue-100"
                                        required
                                    >

                                </td>

                                {{-- AKSI --}}
                                <td class="px-4 py-4 align-top">

                                    <button type="button" class="btnHapus rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                        disabled
                                    >
                                        Hapus
                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                {{-- FOOTER FORM --}}
                <div class="flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 bg-slate-200 px-5 py-4">

                    <p class="text-xs text-slate-500">
                        Gunakan tombol
                        <strong>
                            + Tambah Baris
                        </strong>
                        untuk menambahkan data lainnya.
                    </p>

                    <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Simpan Semua
                    </button>

                </div>

            </form>

        </section>

        {{-- DATA YANG SUDAH TERSIMPAN --}}
        <section class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
 
            <div class="border-b border-slate-200 px-5 py-4">

                <h2 class="text-lg font-bold text-slate-800">
                    Data Tersimpan
                </h2>

                <p class="mt-1 text-xs tetx-slate-500">
                    Data yang sudah berhasil disimpan ke database.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">

                            <th class="px-4 py-4 text-xs font-bold text-slate-500">
                                No
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Provinsi
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Kota/Kab
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Jenis Nyamuk
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Insektisida
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Metode
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Sampel Diperiksa
                            </th>

                            <th class="px-4 py-3 text-xs font-bold text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($data as $item)
                            <tr class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="px-4 py-3 text-sm">
                                    {{ $item->no }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $item->provinsi->nama_provinsi ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $item->kabupaten->nama_kabupaten ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $item->jenis_nyamuk }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $item->insektisida }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $item->metode }}
                                </td>

                                <td class="px-4 py-3 text-sm font-semibold">
                                    {{ $item->sampel_diperiksa }}
                                </td>

                                <td class="px-4 py-3">
                                    <button
                                        type="button"
                                        onclick="openDeleteModal({{ $item->id }})"
                                        class="rounded-md border border-red-500 px-3 py-2 text-sm text-red-500 transition hover:bg-red-50"
                                    >
                                        Hapus
                                    </button>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="px-4 py-10 text-center text-sm text-slate-400">
                                    Belum ada data yang tersimpan.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </main>

            {{-- popup konfirmasi hapus --}}
        <div
            id="deleteModal"
            class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 px-4">
        
            <div class="w-full max-w-sm rounded-xl bg-white p-6 shadow-2xl">

                <div class="text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                        <span class="text-xl font-bold text-red-600">
                            !
                        </span>
                    </div>

                    <h3 class="mt-4 text-lg font-bold text-slate-800">
                        Hapus Data?
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Apakah kamu yakin ingin menghapus data ini?
                        <br>
                        Data yang sudah dihapus tidak dapat dikembalikan.
                    </p>

                </div>

                <div class="mt-6 flex justify-center gap-3">
                    <button 
                        type="button"
                        onclick="closeDeleteModal()"
                        class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        Batal
                    </button>

                    <form
                        id="deleteForm"
                        method="POST"
                    >
                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700"
                            >
                                Ya, Hapus
                        </button>

                    </form>

                </div>

            </div>
            
        </div>


    {{-- JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tableBody = document.getElementById('tableBody');

            const btnTambahBaris = document.getElementById('btnTambahBaris');

                /*LOAD KABUPATEN*/
                function loadKabupaten(
                    provinsiSelect,
                    kabupatenSelect
                ) {

                    const provinsiId =
                        provinsiSelect.value;


                    if (!provinsiId) {

                        kabupatenSelect.innerHTML = `
                            <option value="">
                                Pilih Provinsi Terlebih Dahulu
                            </option>
                        `;

                        kabupatenSelect.disabled =
                            true;

                        return;
                    }


                    kabupatenSelect.innerHTML = `
                        <option value="">
                            Memuat Kabupaten...
                        </option>
                    `;

                    kabupatenSelect.disabled =
                        true;


                    fetch(
                        `/kabupaten/${provinsiId}`
                    )

                    .then(response => {

                        if (!response.ok) {

                            throw new Error(
                                'Gagal mengambil data kabupaten'
                            );

                        }

                        return response.json();

                    })

                    .then(data => {

                        kabupatenSelect.innerHTML = `
                            <option value="">
                                Pilih Kota/Kabupaten
                            </option>
                        `;


                        if (data.length === 0) {

                            kabupatenSelect.innerHTML = `
                                <option value="">
                                    Kabupaten tidak tersedia
                                </option>
                            `;

                            kabupatenSelect.disabled =
                                true;

                            return;
                        }


                        data.forEach(
                            function (item) {

                                const option =
                                    document.createElement(
                                        'option'
                                    );

                                option.value =
                                    item.id;

                                option.textContent =
                                    item.nama_kabupaten;

                                kabupatenSelect.appendChild(
                                    option
                                );

                            }
                        );


                        kabupatenSelect.disabled =
                            false;

                    })

                    .catch(error => {

                        console.error(
                            'ERROR:',
                            error
                        );


                        kabupatenSelect.innerHTML = `
                            <option value="">
                                Gagal memuat Kabupaten
                            </option>
                        `;


                        kabupatenSelect.disabled =
                            true;

                    });

                }


                /*EVENT PROVINSI*/
                function attachProvinsiEvent(
                    row
                ) {

                    const provinsi =
                        row.querySelector(
                            '.provinsi'
                        );

                    const kabupaten =
                        row.querySelector(
                            '.kabupaten'
                        );


                    if (!provinsi ||
                        !kabupaten) {
                        return;
                    }


                    provinsi.addEventListener(
                        'change',
                        function () {

                            loadKabupaten(
                                provinsi,
                                kabupaten
                            );

                        }
                    );

                }


                /*UPDATE NOMOR*/
                function updateNomor() {

                    const rows =
                        tableBody.querySelectorAll(
                            '.entry-row'
                        );


                    rows.forEach(
                        function (row, index) {

                            const number =
                                row.querySelector(
                                    '.row-number'
                                );

                            if (number) {

                                number.textContent =
                                    index + 1;

                            }

                        }
                    );


                    const buttons =
                        tableBody.querySelectorAll(
                            '.btnHapus'
                        );


                    buttons.forEach(
                        function (button) {

                            button.disabled =
                                rows.length <= 1;

                        }
                    );

                }


                /*EVENT HAPUS*/
                function attachHapusEvent(
                    row
                ) {

                    const button =
                        row.querySelector(
                            '.btnHapus'
                        );


                    if (!button) {
                        return;
                    }


                    button.addEventListener(
                        'click',
                        function () {

                            const rows =
                                tableBody.querySelectorAll(
                                    '.entry-row'
                                );


                            if (rows.length <= 1) {
                                return;
                            }


                            row.remove();

                            updateNomor();

                        }
                    );

                }


                /*TAMBAH BARIS*/
                btnTambahBaris.addEventListener(
                    'click',
                    function () {

                        const rows =
                            tableBody.querySelectorAll(
                                '.entry-row'
                            );

                        const index =
                            rows.length;


                        const row =
                            document.createElement(
                                'tr'
                            );


                        row.className =
                            'entry-row border-b border-slate-100 hover:bg-slate-50';


                        row.innerHTML = `

                            <td
                                class="row-number
                                       px-4
                                       py-4
                                       align-top
                                       text-sm
                                       font-semibold
                                       text-slate-600"
                            >
                                ${index + 1}
                            </td>


                            <td class="px-4 py-4 align-top">

                                <select
                                    name="rows[${index}][provinsi_id]"
                                    class="provinsi
                                           w-full
                                           rounded-lg
                                           border
                                           border-slate-300
                                           bg-white
                                           px-3
                                           py-2.5
                                           text-sm"
                                    required
                                >

                                    <option value="">
                                        Pilih Provinsi
                                    </option>

                                    @foreach ($provinsis as $provinsi)

                                        <option
                                            value="{{ $provinsi->id }}"
                                        >
                                            {{ $provinsi->nama_provinsi }}
                                        </option>

                                    @endforeach

                                </select>

                            </td>


                            <td class="px-4 py-4 align-top">

                                <select
                                    name="rows[${index}][kabupaten_id]"
                                    class="kabupaten
                                           w-full
                                           rounded-lg
                                           border
                                           border-slate-300
                                           bg-slate-100
                                           px-3
                                           py-2.5
                                           text-sm"
                                    disabled
                                    required
                                >

                                    <option value="">
                                        Pilih Provinsi Terlebih Dahulu
                                    </option>

                                </select>

                            </td>


                            <td class="px-4 py-4 align-top">

                                <select
                                    name="rows[${index}][jenis_nyamuk]"
                                    class="w-full
                                           rounded-lg
                                           border
                                           border-slate-300
                                           bg-white
                                           px-3
                                           py-2.5
                                           text-sm"
                                    required
                                >

                                    <option value="">
                                        Pilih Jenis Nyamuk
                                    </option>

                                    <option value="Ae. aegypti">
                                        Ae. aegypti
                                    </option>

                                    <option value="Culex sp">
                                        Culex sp
                                    </option>

                                    <option value="Anhopheles">
                                        Anhopheles
                                    </option>

                                    <option value="Aedes sp">
                                        Aedes sp
                                    </option>

                                    <option value="Culex">
                                        Culex
                                    </option>

                                    <option value="An. Farauti">
                                        An. Farauti
                                    </option>

                                    <option value="An. Vagus">
                                        An. Vagus
                                    </option>

                                    <option value="An. tessellatus">
                                        An. tessellatus
                                    </option>

                                    <option value="An. sundaicus s.I.">
                                        An. sundaicus s.I.
                                    </option>

                                    <option value="An. punctulatus">
                                        An. punctulatus
                                    </option>

                                    <option value="An. peditaeniatus">
                                        An. peditaeniatus
                                    </option>

                                    <option value="An. parensis">
                                        An. parensis
                                    </option>

                                    <option value="An. letifer">
                                        An. letifer
                                    </option>

                                    <option value="An. koliensis">
                                        An. koliensis
                                    </option>

                                    <option value="An. kochi">
                                        An. kochi
                                    </option>

                                    <option value="An. indefinitus">
                                        An. indefinitus
                                    </option>

                                    <option value="An. hyrcanus s.I.">
                                        An. hyrcanus s.I.
                                    </option>

                                    <option value="An. farauti s.s">
                                        An. farauti s.s
                                    </option>

                                    <option value="An. barbirostris">
                                        An. barbirostris
                                    </option>

                                    <option value="An. aconitus">
                                        An. aconitus
                                    </option>

                                    <option value="An. Albopictus">
                                        Ae. aegypti
                                    </option>

                                </select>

                            </td>


                            <td class="px-4 py-4 align-top">

                                <select
                                    name="rows[${index}][insektisida]"
                                    class="w-full
                                           rounded-lg
                                           border
                                           border-slate-300
                                           bg-white
                                           px-3
                                           py-2.5
                                           text-sm"
                                    required
                                >

                                    <option value="">
                                        Pilih Insektisida
                                    </option>

                                    <option value="Cypermethrin">
                                        Cypermethrin
                                    </option>

                                    <option value="Lamdacyhalothrin">
                                        Lamdacyhalothrin
                                    </option>

                                    <option value="Deltamethrin">
                                        Deltamethrin
                                    </option>

                                    <option value="Alphacypermethrin">
                                        Alphacypermethrin
                                    </option>

                                    <option value="Cyfluthrin">
                                        Cyfluthrin
                                    </option>

                                    <option value="Permethrin">
                                        Permethrin
                                    </option>

                                    <option value="Malathion">
                                        Malathion
                                    </option>

                                    <option value="Deltamethrin 0,025%">
                                        Deltamethrin 0,025%
                                    </option>

                                    <option value="Lambda-cyhalothrin 0,0025%">
                                        Lambda-cyhalothrin 0,0025%
                                    </option>

                                    <option value="Temefos (Abate)">
                                        Temefos (Abate)
                                    </option>

                                    <option value="Bendiocarb">
                                        Bendiocarb
                                    </option>

                                    <option value="Sipermethrin">
                                        Sipermethrin
                                    </option>

                                </select>

                            </td>


                            <td class="px-4 py-4 align-top">

                                <select
                                    name="rows[${index}][metode]"
                                    class="w-full
                                           rounded-lg
                                           border
                                           border-slate-300
                                           bg-white
                                           px-3
                                           py-2.5
                                           text-sm"
                                    required
                                >

                                    <option value="">
                                        Pilih Metode
                                    </option>

                                    <option value="Sequencing">
                                        Sequencing
                                    </option>

                                    <option value="WHO Tube Bioassay">
                                        WHO Tube Bioassay
                                    </option>

                                    <option value="WHO larval bioassay">
                                        WHO larval bioasssay
                                    </option>

                                    <option value="WHO susceptibilitity test">
                                        WHO susceptibilitity test
                                    </option>

                                    <option value="WHO test kit_adults">
                                        WHO test kit_adults
                                    </option>

                                    <option value="CDC bottle_adults">
                                        CDC bottle_adults
                                    </option>

                                    <option value="CDC bottle bioassay">
                                        CDC bottle bioassay
                                    </option>

                                    <option value="WHO standard bioassay">
                                        WHO standard bioassay
                                    </option>

                                </select>

                            </td>

                            <td class="px-4 py-4 align-top">

                                <input
                                    type="number"
                                    name="rows[${index}][sampel_diperiksa]"
                                    min="1"
                                    placeholder="0"
                                    class="w-full
                                           rounded-lg
                                           border
                                           border-slate-300
                                           bg-white
                                           px-3
                                           py-2.5
                                           text-sm"
                                    required
                                >

                            </td>


                            <td class="px-4 py-4 align-top">

                                <button
                                    type="button"
                                    class="btnHapus
                                           rounded-lg
                                           border
                                           border-red-200
                                           px-3
                                           py-2
                                           text-xs
                                           font-semibold
                                           text-red-600
                                           hover:bg-red-50"
                                >
                                    Hapus
                                </button>

                            </td>

                        `;


                        tableBody.appendChild(
                            row
                        );


                        attachProvinsiEvent(
                            row
                        );

                        attachHapusEvent(
                            row
                        );

                        updateNomor();

                    }
                );


                /*BARIS PERTAMA*/
                const firstRow =
                    tableBody.querySelector(
                        '.entry-row'
                    );


                attachProvinsiEvent(
                    firstRow
                );


                attachHapusEvent(
                    firstRow
                );


                updateNomor();

            }
        );

    </script>

    <script>
        window.openDeleteModal = function(id)
        {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');

            if (!modal || !form) {
                console.error('Popup atau form hapus tidak ditemukan');
                return;
            }

            //menemukan data yg akan dihapus
            form.action = '/input/' + id;

            //tampilan data yg akan dihapus
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };
        
        window.closeDeleteModal = function()
        {
            const modal = document.getElementById('deleteModal');

            if (!modal) {
                return;
            }

            //sembunyikan popup
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        };
    </script>

</body>

</html>