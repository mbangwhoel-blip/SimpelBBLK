<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIMPEL BBLKL</title>

    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">

    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    
    <style type="text/tailwindcss">
        @layer base {
            .leaflet-container img {
                display: inline !important;
                max-width: none !important;
                max-height: none !important;
            }
            .leaflet-tile {
                display: inline !important;
                max-width: none !important;
                max-height: none !important;
            }
        }
    </style>
    <style>
        #map { height: 520px; border-radius: 12px; }
    </style>

    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
</head>
<body class="bg-slate-100 text-slate-800">

<?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="ml-64 min-h-screen">

    
    <header class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-slate-200 bg-white px-8 shadow-sm">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Dashboard</h1>
            <p class="text-sm text-slate-500">Sistem Informasi Pengolahan Data Laboratorium</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-semibold text-white">
                <?php echo e(strtoupper(substr(auth()->user()->name ?? 'A', 0, 1))); ?>

            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800"><?php echo e(auth()->user()->name ?? 'Admin'); ?></p>
                <p class="text-xs text-slate-500"><?php echo e(auth()->user()->username ?? ''); ?></p>
            </div>
        </div>
    </header>

    <section class="p-8">

        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Selamat Datang 👋</h2>
                <p class="mt-1 text-sm text-slate-500">Ringkasan data uji resistensi nyamuk BBLKL tahun <?php echo e($tahun); ?>.</p>
            </div>
            <a href="<?php echo e(route('input')); ?>" class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                + Input Data
            </a>
        </div>

        
        <div class="mb-6 grid grid-cols-2 gap-5 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Pengujian</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-800"><?php echo e(number_format($totalPengujian)); ?></h3>
                        <p class="mt-1 text-xs font-medium text-blue-600">Semua tahun</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl border border-red-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Resisten</p>
                        <h3 class="mt-2 text-3xl font-bold text-red-600"><?php echo e(number_format($totalResisten)); ?></h3>
                        <p class="mt-1 text-xs font-medium text-red-500">
                            <?php if($totalPengujian > 0): ?> <?php echo e(round(($totalResisten/$totalPengujian)*100)); ?>% dari total <?php else: ?> 0% <?php endif; ?>
                        </p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-100 text-xl">🔴</div>
                </div>
            </div>
            <div class="rounded-2xl border border-green-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Rentan</p>
                        <h3 class="mt-2 text-3xl font-bold text-green-600"><?php echo e(number_format($totalRentan)); ?></h3>
                        <p class="mt-1 text-xs font-medium text-green-500">
                            <?php if($totalPengujian > 0): ?> <?php echo e(round(($totalRentan/$totalPengujian)*100)); ?>% dari total <?php else: ?> 0% <?php endif; ?>
                        </p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-xl">🟢</div>
                </div>
            </div>
            <div class="rounded-2xl border border-yellow-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Toleran</p>
                        <h3 class="mt-2 text-3xl font-bold text-yellow-600"><?php echo e(number_format($totalToleran)); ?></h3>
                        <p class="mt-1 text-xs font-medium text-yellow-500">
                            <?php if($totalPengujian > 0): ?> <?php echo e(round(($totalToleran/$totalPengujian)*100)); ?>% dari total <?php else: ?> 0% <?php endif; ?>
                        </p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-100 text-xl">🟡</div>
                </div>
            </div>
        </div>

        
        <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-slate-800">Peta Sebaran Hasil Uji</h3>
                <p class="text-sm text-slate-500">Klik marker untuk detail per kab/kota</p>
            </div>
            <div id="map"></div>
            <div class="mt-3 flex flex-wrap items-center gap-5 border-t border-slate-100 pt-3 text-xs font-medium text-slate-600">
                <span class="mr-1 font-semibold uppercase tracking-wide text-slate-400">Keterangan:</span>
                <div class="flex items-center gap-2"><span class="inline-block h-3 w-3 rounded-full" style="background:#ef4444"></span>Resisten</div>
                <div class="flex items-center gap-2"><span class="inline-block h-3 w-3 rounded-full" style="background:#22c55e"></span>Rentan</div>
                <div class="flex items-center gap-2"><span class="inline-block h-3 w-3 rounded-full" style="background:#eab308"></span>Toleran</div>
                <div class="flex items-center gap-2"><span class="inline-block h-3 w-3 rounded-full" style="background:#a855f7"></span>Campuran</div>
            </div>
        </div>

        
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-200 p-6">
                <div>
                    <h3 class="text-lg font-bold">Data Pemeriksaan Terbaru</h3>
                    <p class="text-sm text-slate-500">10 data terakhir yang dimasukkan</p>
                </div>
                <a href="<?php echo e(route('input')); ?>" class="text-sm font-semibold text-blue-600 hover:underline">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-5 py-4 text-center w-10">No</th>
                            <th class="px-5 py-4">Provinsi</th>
                            <th class="px-5 py-4">Kab/Kota</th>
                            <th class="px-5 py-4">Jenis Nyamuk</th>
                            <th class="px-5 py-4">Insektisida</th>
                            <th class="px-5 py-4">Metode</th>
                            <th class="px-5 py-4 text-right">Sampel</th>
                            <th class="px-5 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php $__empty_1 = true; $__currentLoopData = $dataTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-5 py-3 text-center text-slate-400"><?php echo e($loop->iteration); ?></td>
                            <td class="px-5 py-3 font-medium"><?php echo e($item->provinsi->nama_provinsi ?? '-'); ?></td>
                            <td class="px-5 py-3 text-slate-600"><?php echo e($item->kabupaten->nama_kabupaten ?? '-'); ?></td>
                            <td class="px-5 py-3">
                                <span class="inline-block rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700"><?php echo e($item->jenis_nyamuk); ?></span>
                            </td>
                            <td class="px-5 py-3 text-slate-600"><?php echo e($item->insektisida); ?></td>
                            <td class="px-5 py-3 text-slate-600"><?php echo e($item->metode); ?></td>
                            <td class="px-5 py-3 text-right font-bold"><?php echo e(number_format($item->sampel_diperiksa)); ?></td>
                            <td class="px-5 py-3 text-center">
                                <?php if($item->status === 'resisten'): ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700">🔴 Resisten</span>
                                <?php elseif($item->status === 'rentan'): ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-bold text-green-700">🟢 Rentan</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-bold text-yellow-700">🟡 Toleran</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-sm text-slate-400">
                                Belum ada data. <a href="<?php echo e(route('input')); ?>" class="text-blue-600 hover:underline">Input data sekarang →</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</main>

<script>
(function () {
    var map = L.map('map').setView([-2.5, 118], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    setTimeout(function () { map.invalidateSize(); }, 300);

    var rawData = <?php echo json_encode($data, 15, 512) ?>;

    function color(status) {
        return status === 'resisten' ? '#ef4444'
             : status === 'rentan'   ? '#22c55e'
             : status === 'toleran'  ? '#eab308'
             : '#a855f7';
    }

    function icon(c) {
        return L.divIcon({
            html: '<div style="width:14px;height:14px;border-radius:50%;background:' + c + ';border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.4)"></div>',
            className: '',
            iconSize: [14, 14],
            iconAnchor: [7, 7],
            popupAnchor: [0, -10]
        });
    }

    var groups = {};
    rawData.forEach(function (item) {
        var k = item.kabupaten;
        if (!k || k.latitude == null || k.longitude == null) return;
        if (!groups[k.id]) groups[k.id] = { k: k, p: item.provinsi, e: [] };
        groups[k.id].e.push(item);
    });

    Object.values(groups).forEach(function (g) {
        var sc = { resisten: 0, rentan: 0, toleran: 0 };
        g.e.forEach(function (e) { if (sc[e.status] !== undefined) sc[e.status]++; });
        var sorted = Object.entries(sc).sort(function (a, b) { return b[1] - a[1]; });
        var mixed  = Object.values(sc).filter(function (v) { return v > 0; }).length > 1 && sorted[0][1] < g.e.length;
        var c      = mixed ? '#a855f7' : color(sorted[0][0]);

        var sampel = g.e.reduce(function (s, e) { return s + Number(e.sampel_diperiksa || 0); }, 0);
        var nyamuk = [...new Set(g.e.map(function (e) { return e.jenis_nyamuk; }))].join(', ');
        var insek  = [...new Set(g.e.map(function (e) { return e.insektisida;  }))].join(', ');
        var mutasi = [...new Set(g.e.map(function (e) { return e.mutasi; }).filter(Boolean))].join(', ');

        var badges = '';
        [['resisten','#fee2e2','#b91c1c','🔴 Resisten'],
         ['rentan',  '#dcfce7','#15803d','🟢 Rentan'],
         ['toleran', '#fef9c3','#a16207','🟡 Toleran']].forEach(function (cfg) {
            if (sc[cfg[0]] > 0)
                badges += '<span style="background:' + cfg[1] + ';color:' + cfg[2] + ';border-radius:9999px;padding:1px 8px;font-size:11px;font-weight:700;display:inline-block;margin:2px 2px 0 0">' + cfg[3] + ' (' + sc[cfg[0]] + ')</span>';
        });

        var popup = '<div style="min-width:200px;max-width:260px;font-family:sans-serif;font-size:12px">'
            + '<b style="font-size:13px">' + g.k.nama_kabupaten + '</b><br>'
            + '<span style="color:#64748b;font-size:11px">' + (g.p ? g.p.nama_provinsi : '') + ' &bull; ' + g.e.length + ' entri &bull; ' + sampel + ' sampel</span>'
            + '<div style="margin:5px 0">' + badges + '</div>'
            + '<hr style="border:none;border-top:1px solid #e2e8f0;margin:4px 0">'
            + '<div><b>Nyamuk:</b> <span style="color:#64748b">' + nyamuk + '</span></div>'
            + '<div><b>Insektisida:</b> <span style="color:#64748b">' + insek + '</span></div>'
            + (mutasi ? '<div><b>Mutasi:</b> <span style="color:#64748b">' + mutasi + '</span></div>' : '')
            + '</div>';

        L.marker([Number(g.k.latitude), Number(g.k.longitude)], { icon: icon(c) })
            .addTo(map)
            .bindTooltip('<b>' + g.k.nama_kabupaten + '</b>', { direction: 'top', offset: [0, -10] })
            .bindPopup(popup, { maxWidth: 270 });
    });
}());
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\SimpelBBLK\resources\views/dashboard.blade.php ENDPATH**/ ?>