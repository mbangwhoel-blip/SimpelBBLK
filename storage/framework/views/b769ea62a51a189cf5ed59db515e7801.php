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
        #map {
            height: 540px;
            border-radius: 14px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.06);
            z-index: 1;
        }
        .leaflet-tooltip {
            pointer-events: none !important;
            border-radius: 6px !important;
            padding: 3px 8px !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15) !important;
        }
        .custom-pin-marker {
            cursor: pointer !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pin-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2.5px solid #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.38);
            transition: transform 0.15s ease-in-out;
        }
        .custom-pin-marker:hover .pin-dot {
            transform: scale(1.35);
        }
        .leaflet-popup-content-wrapper {
            border-radius: 12px !important;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.2) !important;
            padding: 4px !important;
        }
        .leaflet-popup-content {
            margin: 10px 14px !important;
            line-height: 1.4 !important;
        }
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

        
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Selamat Datang 👋</h2>
                <p class="mt-1 text-sm text-slate-500">Ringkasan data uji resistensi nyamuk BBLKL <?php echo e($tahun === 'semua' ? '(Semua Tahun)' : 'Tahun ' . $tahun); ?>.</p>
            </div>
            <div class="flex items-center gap-3">
                <form method="GET" action="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2">
                    <label class="text-xs font-semibold text-slate-500">Filter Tahun:</label>
                    <select name="tahun" onchange="this.form.submit()"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium shadow-sm focus:border-blue-500 focus:outline-none">
                        <option value="semua" <?php echo e($tahun === 'semua' ? 'selected' : ''); ?>>Semua Tahun</option>
                        <?php $__currentLoopData = $tahunList ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
                <a href="<?php echo e(route('input')); ?>" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    + Input Data
                </a>
            </div>
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
                        <tr class="transition hover:bg-blue-50 cursor-pointer" onclick="focusMarker(<?php echo e($item->kabupaten_id); ?>)" title="Klik untuk sorot wilayah di peta">
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
            html: '<div class="custom-pin-marker" style="width:26px;height:26px;display:flex;align-items:center;justify-content:center"><div class="pin-dot" style="background:' + c + '"></div></div>',
            className: '',
            iconSize: [26, 26],
            iconAnchor: [13, 13],
            popupAnchor: [0, -12]
        });
    }

    function norm(str) {
        return String(str || '')
            .toLowerCase()
            .replace(/^(kab\.?|kota|kabupaten|adm\.?|administrasi)\s+/i, '')
            .replace(/[^a-z0-9]/g, '');
    }

    var groups = {};
    var kabByNorm = {};

    rawData.forEach(function (item) {
        var k = item.kabupaten;
        if (!k || k.latitude == null || k.longitude == null) return;
        if (!groups[k.id]) {
            groups[k.id] = { k: k, p: item.provinsi, e: [] };
        }
        groups[k.id].e.push(item);

        if (k.nama_kabupaten) {
            kabByNorm[norm(k.nama_kabupaten)] = groups[k.id];
        }
    });

    function buildPopup(g) {
        var sc = { resisten: 0, rentan: 0, toleran: 0 };
        g.e.forEach(function (e) { if (sc[e.status] !== undefined) sc[e.status]++; });

        var sampel = g.e.reduce(function (s, e) { return s + Number(e.sampel_diperiksa || 0); }, 0);
        var nyamuk = [...new Set(g.e.map(function (e) { return e.jenis_nyamuk; }).filter(Boolean))].join(', ') || '-';
        var insek  = [...new Set(g.e.map(function (e) { return e.insektisida;  }).filter(Boolean))].join(', ') || '-';
        var mutasi = [...new Set(g.e.map(function (e) { return e.mutasi; }).filter(Boolean))].join(', ');

        var badges = '';
        [['resisten','#fee2e2','#b91c1c','🔴 Resisten'],
         ['rentan',  '#dcfce7','#15803d','🟢 Rentan'],
         ['toleran', '#fef9c3','#a16207','🟡 Toleran']].forEach(function (cfg) {
            if (sc[cfg[0]] > 0)
                badges += '<span style="background:' + cfg[1] + ';color:' + cfg[2] + ';border-radius:9999px;padding:2px 8px;font-size:11px;font-weight:700;display:inline-block;margin:2px 2px 0 0">' + cfg[3] + ' (' + sc[cfg[0]] + ')</span>';
        });

        return '<div style="min-width:220px;max-width:280px;font-family:sans-serif;font-size:12px">'
            + '<div style="font-size:14px;font-weight:bold;color:#0f172a;margin-bottom:2px">' + g.k.nama_kabupaten + '</div>'
            + '<div style="color:#64748b;font-size:11px;margin-bottom:6px">' + (g.p ? g.p.nama_provinsi : 'Indonesia') + ' &bull; <b>' + g.e.length + '</b> pengujian &bull; <b>' + sampel + '</b> sampel</div>'
            + '<div style="margin:6px 0">' + badges + '</div>'
            + '<hr style="border:none;border-top:1px solid #e2e8f0;margin:6px 0">'
            + '<div style="margin-bottom:3px"><b>Nyamuk:</b> <span style="color:#475569">' + nyamuk + '</span></div>'
            + '<div style="margin-bottom:3px"><b>Insektisida:</b> <span style="color:#475569">' + insek + '</span></div>'
            + (mutasi ? '<div style="margin-bottom:3px"><b>Mutasi:</b> <span style="color:#475569">' + mutasi + '</span></div>' : '')
            + '</div>';
    }

    var bounds = [];
    var markersByKabId = {};

    Object.values(groups).forEach(function (g) {
        var sc = { resisten: 0, rentan: 0, toleran: 0 };
        g.e.forEach(function (e) { if (sc[e.status] !== undefined) sc[e.status]++; });
        var sorted = Object.entries(sc).sort(function (a, b) { return b[1] - a[1]; });
        var mixed  = Object.values(sc).filter(function (v) { return v > 0; }).length > 1 && sorted[0][1] < g.e.length;
        var c      = mixed ? '#a855f7' : color(sorted[0][0]);

        var popupHtml = buildPopup(g);

        var marker = L.marker([Number(g.k.latitude), Number(g.k.longitude)], { icon: icon(c) })
            .addTo(map)
            .bindTooltip('<b>' + g.k.nama_kabupaten + '</b>', { direction: 'top', offset: [0, -12], opacity: 0.95 })
            .bindPopup(popupHtml, { maxWidth: 300 });

        markersByKabId[g.k.id] = marker;
        bounds.push([Number(g.k.latitude), Number(g.k.longitude)]);
    });

    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [35, 35], maxZoom: 10 });
    }

    // Muat batas poligon GeoJSON kabupaten Indonesia
    fetch('<?php echo e(asset("geojson/indonesia-kabupaten.json")); ?>')
        .then(function (res) { return res.json(); })
        .then(function (geojsonData) {
            L.geoJSON(geojsonData, {
                style: function (feature) {
                    var name = feature.properties ? feature.properties.name : '';
                    var g = kabByNorm[norm(name)];
                    if (g) {
                        var sc = { resisten: 0, rentan: 0, toleran: 0 };
                        g.e.forEach(function (e) { if (sc[e.status] !== undefined) sc[e.status]++; });
                        var sorted = Object.entries(sc).sort(function (a, b) { return b[1] - a[1]; });
                        var mixed  = Object.values(sc).filter(function (v) { return v > 0; }).length > 1 && sorted[0][1] < g.e.length;
                        var c      = mixed ? '#a855f7' : color(sorted[0][0]);
                        return {
                            fillColor: c,
                            fillOpacity: 0.28,
                            color: c,
                            weight: 1.5
                        };
                    } else {
                        return {
                            fillColor: '#64748b',
                            fillOpacity: 0.04,
                            color: '#94a3b8',
                            weight: 0.6,
                            dashArray: '2, 3'
                        };
                    }
                },
                onEachFeature: function (feature, layer) {
                    var name = feature.properties ? feature.properties.name : 'Wilayah';
                    var g = kabByNorm[norm(name)];

                    layer.on('mouseover', function () {
                        layer.setStyle({ fillOpacity: g ? 0.45 : 0.15, weight: 2 });
                    });
                    layer.on('mouseout', function () {
                        layer.setStyle({ fillOpacity: g ? 0.28 : 0.04, weight: g ? 1.5 : 0.6 });
                    });

                    if (g) {
                        layer.bindPopup(buildPopup(g), { maxWidth: 300 });
                    } else {
                        var emptyPopup = '<div style="font-family:sans-serif;font-size:12px;min-width:180px">'
                            + '<b style="font-size:13px;color:#0f172a">' + name + '</b>'
                            + '<div style="margin-top:6px;padding:6px 8px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:6px;color:#64748b;font-size:11px">'
                            + 'ℹ️ Belum ada data uji laboratorium di wilayah ini.'
                            + '</div></div>';
                        layer.bindPopup(emptyPopup, { maxWidth: 240 });
                    }
                }
            }).addTo(map);
        })
        .catch(function (err) {
            console.log('GeoJSON poligon tidak termuat, marker tetap aktif:', err);
        });

    // Fallback: klik bebas di dekat titik manapun otomatis membuka popup terdekat
    map.on('click', function (e) {
        var clickedLat = e.latlng.lat;
        var clickedLng = e.latlng.lng;
        var nearest = null;
        var minDist = 0.45; // ~50 km
        Object.values(groups).forEach(function (g) {
            var d = Math.sqrt(Math.pow(Number(g.k.latitude) - clickedLat, 2) + Math.pow(Number(g.k.longitude) - clickedLng, 2));
            if (d < minDist) {
                minDist = d;
                nearest = g;
            }
        });
        if (nearest && markersByKabId[nearest.k.id]) {
            markersByKabId[nearest.k.id].openPopup();
        }
    });

    // Helper fokus marker dari klik baris tabel
    window.focusMarker = function (kabId) {
        if (markersByKabId[kabId]) {
            var m = markersByKabId[kabId];
            map.flyTo(m.getLatLng(), 8, { duration: 0.8 });
            setTimeout(function () { m.openPopup(); }, 850);
        }
    };
}());
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\SimpelBBLK\resources\views/dashboard.blade.php ENDPATH**/ ?>