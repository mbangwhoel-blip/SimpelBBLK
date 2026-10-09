<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Dashboard - SIMPEL BBLKL</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        #map { width: 100%; height: 430px; border-radius: 16px; z-index: 1; }
    </style>
</head>

<body class="bg-slate-100 text-slate-800">

@include('sidebar')

<main class="ml-64 min-h-screen">

    {{-- TOPBAR --}}
    <header class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-slate-200 bg-white px-8 shadow-sm">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Dashboard</h1>
            <p class="text-sm text-slate-500">Sistem Informasi Pengolahan Data Laboratorium</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-semibold text-white">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-slate-500">{{ auth()->user()->username ?? '' }}</p>
            </div>
        </div>
    </header>

    <section class="p-8">

        {{-- WELCOME --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Selamat Datang 👋</h2>
                <p class="mt-1 text-sm text-slate-500">Berikut adalah ringkasan data pemeriksaan BBLKL tahun {{ $tahun }}.</p>
            </div>
            <a href="{{ route('input') }}" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                + Input Data
            </a>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">

            {{-- Total Pengujian --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Pengujian</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ number_format($totalPengujian) }}</h3>
                        <p class="mt-2 text-xs font-medium text-blue-600">Semua tahun</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Total Sampel --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Sampel</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ number_format($totalSampel) }}</h3>
                        <p class="mt-2 text-xs font-medium text-indigo-600">Sampel diperiksa</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Provinsi --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Provinsi Terdata</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ $totalProvinsi }}</h3>
                        <p class="mt-2 text-xs font-medium text-emerald-600">dari 38 provinsi</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100">
                        <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21s7-5.4 7-11a7 7 0 10-14 0c0 5.6 7 11 7 11z"/>
                            <circle cx="12" cy="10" r="2.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Kabupaten --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Kab/Kota Terdata</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-800">{{ $totalKabupaten }}</h3>
                        <p class="mt-2 text-xs font-medium text-amber-600">Wilayah uji</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100">
                        <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M9 7h2m-2 4h2m4-4h2m-2 4h2"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- MAP + STATISTIK --}}
        <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- MAP --}}
            <div class="xl:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5">
                    <h3 class="text-lg font-bold text-slate-800">Peta Sebaran Pemeriksaan</h3>
                    <p class="text-sm text-slate-500">Lokasi pemeriksaan berdasarkan wilayah</p>
                </div>
                <div id="map"></div>
            </div>

            {{-- STATISTIK DISTRIBUSI --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800">Top Jenis Nyamuk</h3>
                <p class="mt-1 mb-6 text-sm text-slate-500">Berdasarkan jumlah pengujian</p>

                @forelse($distribusiNyamuk as $item)
                    @php $pct = round(($item->total / $totalDistribusi) * 100) @endphp
                    <div class="mb-4">
                        <div class="mb-1 flex justify-between text-sm">
                            <span class="font-medium text-slate-700">{{ $item->jenis_nyamuk }}</span>
                            <span class="font-bold text-slate-800">{{ $item->total }}</span>
                        </div>
                        <div class="h-2.5 rounded-full bg-slate-100">
                            <div class="h-2.5 rounded-full bg-blue-500" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 text-center py-6">Belum ada data</p>
                @endforelse

                <div class="mt-6 rounded-xl bg-slate-50 p-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-500">Total Data</span>
                        <span class="text-2xl font-bold text-slate-800">{{ number_format($totalPengujian) }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- DATA TERBARU --}}
        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-200 p-6">
                <div>
                    <h3 class="text-lg font-bold">Data Pemeriksaan Terbaru</h3>
                    <p class="text-sm text-slate-500">10 data terakhir yang dimasukkan</p>
                </div>
                <a href="{{ route('input') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                    Lihat Semua →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Provinsi</th>
                            <th class="px-6 py-4">Kab/Kota</th>
                            <th class="px-6 py-4">Jenis Nyamuk</th>
                            <th class="px-6 py-4">Insektisida</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4">Sampel</th>
                            <th class="px-6 py-4">Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($dataTerbaru as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium">{{ $item->provinsi->nama_provinsi ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->kabupaten->nama_kabupaten ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $item->jenis_nyamuk }}</td>
                                <td class="px-6 py-4">{{ $item->insektisida }}</td>
                                <td class="px-6 py-4">{{ $item->metode }}</td>
                                <td class="px-6 py-4 font-semibold">{{ number_format($item->sampel_diperiksa) }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                        {{ $item->tahun }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-sm text-slate-400">
                                    Belum ada data. <a href="{{ route('input') }}" class="text-blue-600 hover:underline">Input data sekarang →</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</main>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const map = L.map('map').setView([-2.5, 118], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const data = @json($data);
    const grouped = {};

    data.forEach(item => {
        const kab = item.kabupaten;
        if (!kab || kab.latitude === null || kab.longitude === null) return;
        if (!grouped[kab.id]) {
            grouped[kab.id] = { kab, prov: item.provinsi, entries: [] };
        }
        grouped[kab.id].entries.push(item);
    });

    Object.values(grouped).forEach(({ kab, prov, entries }) => {
        const totalEntri  = entries.length;
        const totalSampel = entries.reduce((s, i) => s + Number(i.sampel_diperiksa || 0), 0);
        const nyamuk   = [...new Set(entries.map(i => i.jenis_nyamuk))].map(n => `<li>${n}</li>`).join('');
        const sektisida = [...new Set(entries.map(i => i.insektisida))].map(n => `<li>${n}</li>`).join('');
        const met      = [...new Set(entries.map(i => i.metode))].map(n => `<li>${n}</li>`).join('');

        const popup = `
            <div style="min-width:200px;font-size:12px">
                <strong style="font-size:13px">${kab.nama_kabupaten}</strong><br>
                <span style="color:#64748b">${prov ? prov.nama_provinsi : ''} &bull; ${totalEntri} entri</span>
                <hr style="margin:6px 0">
                <b>Sampel:</b> ${totalSampel}<br>
                <b>Nyamuk:</b><ul style="margin:2px 0 6px 14px">${nyamuk}</ul>
                <b>Insektisida:</b><ul style="margin:2px 0 6px 14px">${sektisida}</ul>
                <b>Metode:</b><ul style="margin:2px 0 0 14px">${met}</ul>
            </div>`;

        L.marker([Number(kab.latitude), Number(kab.longitude)])
            .addTo(map)
            .bindTooltip(`<strong>${kab.nama_kabupaten}</strong><br>${prov ? prov.nama_provinsi : ''}`, { direction: 'top', offset: [0, -10] })
            .bindPopup(popup, { maxWidth: 260 });
    });
});
</script>

</body>
</html>