<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Dashboard - SIMPEL BBLKL</title>


    {{-- LEAFLET CSS --}}
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <style>

        #map {
            width: 100%;
            height: 430px;
            border-radius: 16px;
            z-index: 1;
        }

    </style>

</head>


<body class="bg-slate-100 text-slate-800">


    {{-- ================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ================================================= --}}

    @include('sidebar')

    {{-- ================================================= --}}
    {{-- KONTEN DASHBOARD --}}
    {{-- ================================================= --}}

    <main class="ml-64 min-h-screen">


        {{-- TOPBAR --}}
        <header
            class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-slate-200 bg-white px-8">

            <div>

                <h1 class="text-xl font-bold text-slate-800">
                    Dashboard
                </h1>

                <p class="text-sm text-slate-500">
                    Sistem Informasi Pengolahan Data Laboratorium
                </p>

            </div>


            {{-- USER --}}
            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-semibold text-white">

                    A

                </div>


                <div>

                    <p class="text-sm font-semibold text-slate-800">
                        Admin
                    </p>

                    <p class="text-xs text-slate-500">
                        Administrator
                    </p>

                </div>

            </div>

        </header>



        {{-- ================================================= --}}
        {{-- ISI DASHBOARD --}}
        {{-- ================================================= --}}

        <section class="p-8">


            {{-- HEADER --}}
            <div class="mb-8 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Selamat Datang 👋
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Berikut adalah ringkasan data pemeriksaan BBLKL.
                    </p>

                </div>


                <!-- <a href="#"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    + Input Data

                </a> -->

            </div>



            {{-- ================================================= --}}
            {{-- STATISTIK --}}
            {{-- ================================================= --}}

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">


                {{-- TOTAL PEMERIKSAAN --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Total Pemeriksaan
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-xs font-medium text-green-600">
                                ↑ 
                            </p>

                        </div>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100">

                            <svg
                                class="h-6 w-6 text-blue-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- TOTAL UNIT --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Total Unit
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-xs font-medium text-blue-600">
                                Unit terdaftar
                            </p>

                        </div>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100">

                            <svg
                                class="h-6 w-6 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M9 7h2m-2 4h2m4-4h2m-2 4h2" />

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- HASIL POSITIF --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Hasil Positif
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-xs font-medium text-red-600">
                                0% dari total
                            </p>

                        </div>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100">

                            <svg
                                class="h-6 w-6 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v4m0 4h.01M10.3 3.8L2.7 17a2 2 0 001.7 3h15.2a2 2 0 001.7 3z" />

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- WILAYAH --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Wilayah Terdata
                            </p>

                            <h3 class="mt-2 text-3xl font-bold text-slate-800">
                                0
                            </h3>

                            <p class="mt-2 text-xs font-medium text-emerald-600">
                                Provinsi
                            </p>

                        </div>


                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">

                            <svg
                                class="h-6 w-6 text-emerald-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 21s7-5.4 7-11a7 7 0 10-14 0c0 5.6 7 11 7 11z" />

                                <circle
                                    cx="12"
                                    cy="10"
                                    r="2.5" />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- MAP + STATISTIK --}}
            {{-- ================================================= --}}

            <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">


                {{-- MAP --}}
                <div
                    class="xl:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">


                    <div class="mb-5 flex items-center justify-between">

                        <div>

                            <h3 class="text-xs font-bold text-slate-800">
                                Peta Sebaran Pemeriksaan
                            </h3>

                            <p class="text-sm text-slate-500">
                                Lokasi pemeriksaan berdasarkan wilayah
                            </p>

                        </div>


                        <select
                            class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm">

                            <option>Semua Data</option>
                            <option>Uji Resistensi</option>
                            <option>Kerentanan</option>
                            <option>Mutasi</option>

                        </select>

                    </div>


                    <div id="map"></div>

                </div>



                {{-- STATISTIK --}}
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">


                    <h3 class="text-lg font-bold text-slate-800">
                        Statistik Pemeriksaan
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Berdasarkan kategori
                    </p>


                    {{-- UJI RESISTENSI --}}
                    <div class="mt-8">

                        <div class="mb-2 flex justify-between">

                            <span class="text-sm font-medium">
                                Uji Resistensi
                            </span>

                            <span class="text-sm font-bold">
                                620
                            </span>

                        </div>


                        <div class="h-3 rounded-full bg-slate-100">

                            <div
                                class="h-3 w-[78%] rounded-full bg-blue-600">
                            </div>

                        </div>

                    </div>



                    {{-- KERENTANAN --}}
                    <div class="mt-6">

                        <div class="mb-2 flex justify-between">

                            <span class="text-sm font-medium">
                                Kerentanan
                            </span>

                            <span class="text-sm font-bold">
                                0
                            </span>

                        </div>


                        <div class="h-3 rounded-full bg-slate-100">

                            <div
                                class="h-3 w-[58%] rounded-full bg-indigo-500">
                            </div>

                        </div>

                    </div>



                    {{-- MUTASI --}}
                    <div class="mt-6">

                        <div class="mb-2 flex justify-between">

                            <span class="text-sm font-medium">
                                Mutasi
                            </span>

                            <span class="text-sm font-bold">
                                0
                            </span>

                        </div>


                        <div class="h-3 rounded-full bg-slate-100">

                            <div
                                class="h-3 w-[35%] rounded-full bg-emerald-500">
                            </div>

                        </div>

                    </div>



                    {{-- TOTAL --}}
                    <div class="mt-8 rounded-xl bg-slate-50 p-5">

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-slate-500">
                                Total Data
                            </span>

                            <span class="text-2xl font-bold">
                                0
                            </span>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- DATA TERBARU --}}
            {{-- ================================================= --}}

            <div
                class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                <div
                    class="flex items-center justify-between border-b border-slate-200 p-6">

                    <div>

                        <h3 class="text-lg font-bold">
                            Data Pemeriksaan Terbaru
                        </h3>

                        <p class="text-sm text-slate-500">
                            Data yang terakhir dimasukkan
                        </p>

                    </div>


                    <a href="#"
                        class="text-sm font-semibold text-blue-600">

                        Lihat Semua →

                    </a>

                </div>



                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead
                            class="bg-slate-50 text-xs uppercase text-slate-500">

                            <tr>

                                <th class="px-6 py-4">
                                    Provinsi
                                </th>

                                <th class="px-6 py-4">
                                    Kab/Kota
                                </th>

                                <th class="px-6 py-4">
                                    Kategori
                                </th>

                                <th class="px-6 py-4">
                                    Pemeriksaan
                                </th>

                                <th class="px-6 py-4">
                                    Sampel
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">


                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-4 font-medium">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">

                                    <span
                                        class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">

                                        

                                    </span>

                                </td>

                            </tr>


                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-4 font-medium">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">

                                    <span
                                        class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">

                                        

                                    </span>

                                </td>

                            </tr>


                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-4 font-medium">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">
                                    
                                </td>

                                <td class="px-6 py-4">

                                    <span
                                        class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">

                                        

                                    </span>

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>


        </section>

    </main>



    {{-- LEAFLET JS --}}
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>



    {{-- MAP SCRIPT --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const map = L.map('map').setView([-2.5, 118], 5);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    //maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }
            ).addTo(map);

            const data = @json($data);

            console.log('Data dari laravel:', data);

            const groupedData = {};

            data.forEach(item => {
                const kabupaten = item.kabupaten;

                if (!kabupaten) {
                    return;
                }

                const kabupatenId = kabupaten.id;

                if (
                    kabupaten.latitude === null ||
                    kabupaten.longitude === null
                ) {
                    return;
                }

                if (!groupedData[kabupatenId]) {

                    groupedData[kabupatenId] = {
                        kabupaten: kabupaten,
                        provinsi: item.provinsi,
                        data: []
                    };
                }

                groupedData[kabupatenId].data.push(item);
            });

            Object.values(groupedData).forEach(group => {

            const kabupaten = group.kabupaten;
            const provinsi = group.provinsi;
            const entries = group.data;

            const totalEntri = entries.length;

            const totalSampel = entries.reduce(
                (total, item) => {

                    return total + Number(
                        item.sampel_diperiksa || 0
                    );
                },
                0
            );

            const jenisNyamuk = [
                ...new Set(
                    entries.map(item => item.jenis_nyamuk)
                )
            ];

            const insektisida = [
                ...new Set(
                    entries.map(item => item.insektisida)
                )
            ];

            const metode = [
                ...new Set(
                    entries.map(item => item.metode)
                )
            ];

            const jenisNyamukHTML = jenisNyamuk
                .map(item => `<li>${item}</li>`)
                .join('');

            const insektisidaHTML = insektisida
                .map(item => `<li>${item}</li>`)
                .join('');
            
            const metodeHTML = metode
                .map(item => `<li>${item}</li>`)
                .join('');

            const popupHTML = `
                <div class="w-[210px] text-xs">

                    <h3 class="text-sm font-bold text-slate-800 mb-1">
                        Kabupaten ${kabupaten.nama_kabupaten}
                    </h3>

                    <p class="text-xs text-slate-500 mb-2">
                        ${provinsi ? provinsi.nama_provinsi : '_'}
                        - ${totalEntri} entri
                    </p>

                    <div class="grid grid-cols-2 gap-1.5 mb-2">

                        <div class="rounded-md border bg-slate-50 p-1.5 text-center">
                            <div class="text-base font-bold text-slate-800">
                                ${totalEntri}
                            </div>

                            <div class="text-[10] text-slate-500">
                                Total Entri
                            </div>
                        </div>

                        <div class="rounded-md border bg-slate-50 p-1.5 text-center">
                            <div class="text-base font-bold text-slate-800">
                                ${totalSampel}
                            </div>

                            <div class="text-[10px] text-slate-500">
                                Sampel Diperiksa
                            </div>
                        </div>

                    </div>

                    <div class="mb-2">
                        <p class="font-semibold text-slate-700 mb-0.5">
                            Jenis Nyamuk
                        </p>

                        <ul class="list-disc pl-3 text-[11px] text-slate-600">
                            ${jenisNyamukHTML}
                        </ul>
                    </div>

                    <div class="mb-2">
                        <p class="font-semibold text-slate-700 mb-0.5">
                            Insektisida
                        </p>

                        <ul class="list-disc pl-3 text-sm text-slate-600">
                            ${insektisidaHTML}
                        </ul>
                    </div>

                    <div>
                        <p class="font-semibold text-slate-700 mb-0.5">
                            Metode
                        </p>

                        <ul class="list-disc pl-3 text-[11px] text-slate-600">
                            ${metodeHTML}
                        </ul>
                    </div>
                
                </div>
            `;

            const latitude = Number(
                kabupaten.latitude
            );

            const longitude = Number(
                kabupaten.longitude
            );

            console.log(
                'Membuat Marker:',
                kabupaten.nama_kabupaten,
                latitude,
                longitude
            );

            const marker = L.marker([
                latitude,
                longitude
            ]).addTo(map);

            marker.bindTooltip(
                `
                    <strong>
                        Kabupaten ${kabupaten.nama_kabupaten}
                    </strong>
                    <br>
                    ${provinsi ? provinsi.nama_provinsi : ''}
                `,
                {
                    direction: 'top',
                    offset: [0, -10]
                }
            );

            marker.bindPopup(
                popupHTML,
                {
                    maxWidth: 240,
                    minWidth: 220
                }
            );
                        
            })
  
        });

    </script>


</body>

</html>