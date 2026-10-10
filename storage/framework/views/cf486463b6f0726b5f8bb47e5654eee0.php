<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body class="bg-slate-50 text-slate-800">

<?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main class="ml-64 min-h-screen p-6">

    
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
                <p class="mt-0.5 text-xl font-bold text-slate-800"><?php echo e($tahun === 'semua' ? 'Semua' : $tahun); ?></p>
            </div>
        </div>
        
        <form method="GET" action="<?php echo e(route('input')); ?>" class="mt-5 flex flex-wrap items-end gap-3">
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Filter Tahun</label>
                <select name="tahun" onchange="this.form.submit()"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option value="semua" <?php echo e($tahun === 'semua' ? 'selected' : ''); ?>>Semua Tahun</option>
                    <?php $__currentLoopData = $tahunList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-semibold text-slate-700">Filter Bulan</label>
                <select name="bulan" onchange="this.form.submit()"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option value="">Semua Bulan</option>
                    <?php $__currentLoopData = $bulans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($b); ?>" <?php echo e($bulan == $b ? 'selected' : ''); ?>><?php echo e($b); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if($bulan): ?>
                <a href="<?php echo e(route('input', ['tahun' => $tahun])); ?>"
                    class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50">Reset Bulan</a>
            <?php endif; ?>
        </form>
    </section>

    
    <section class="mb-6 grid grid-cols-2 gap-4 xl:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Entri</p>
            <p class="text-xs text-slate-400 mt-0.5"><?php echo e($tahun === 'semua' ? 'Semua Tahun' : 'Tahun '.$tahun); ?></p>
            <p class="mt-2 text-3xl font-bold text-slate-900"><?php echo e($data->count()); ?></p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Total Sampel</p>
            <p class="text-xs text-slate-400 mt-0.5"><?php echo e($tahun === 'semua' ? 'Semua Tahun' : 'Tahun '.$tahun); ?></p>
            <p class="mt-2 text-3xl font-bold text-slate-900"><?php echo e(number_format($data->sum('sampel_diperiksa'))); ?></p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Provinsi</p>
            <p class="text-xs text-slate-400 mt-0.5">Terdata</p>
            <p class="mt-2 text-3xl font-bold text-slate-900"><?php echo e($data->unique('provinsi_id')->count()); ?></p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kab/Kota</p>
            <p class="text-xs text-slate-400 mt-0.5">Terdata</p>
            <p class="mt-2 text-3xl font-bold text-slate-900"><?php echo e($data->unique('kabupaten_id')->count()); ?></p>
        </div>
    </section>

    
    <?php if(session('success')): ?>
        <div class="mb-5 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-5 py-3.5 text-sm font-medium text-green-700">
            <svg class="h-5 w-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="font-bold">Data belum dapat disimpan:</p>
            <ul class="mt-1.5 list-disc pl-5 space-y-0.5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <section class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">

        
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

        
        <form id="formInput" method="POST" action="<?php echo e(route('input.store')); ?>">
            <?php echo csrf_field(); ?>

            
            <div id="entryContainer" class="divide-y divide-slate-100 p-6 space-y-5">

                
                <div class="entry-card relative rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-200 hover:shadow-sm" data-index="0">

                    
                    <div class="mb-4 flex items-center justify-between">
                        <span class="entry-badge inline-flex items-center gap-1.5 rounded-full bg-blue-600 px-3 py-1 text-xs font-bold text-white">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                            </svg>
                            <span class="entry-badge-num">Entri #1</span>
                        </span>
                        <button type="button" class="btnHapusCard flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-500 transition hover:bg-red-50 opacity-30 cursor-not-allowed">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M3 7h18"/>
                            </svg>
                            Hapus Entri
                        </button>
                    </div>

                    
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Provinsi <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][provinsi_id]" class="provinsi w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                                <option value="">— Pilih Provinsi —</option>
                                <?php $__currentLoopData = $provinsis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->id); ?>"><?php echo e($p->nama_provinsi); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kota / Kabupaten <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][kabupaten_id]" class="kabupaten w-full rounded-xl border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" disabled required>
                                <option value="">Pilih provinsi dulu</option>
                            </select>
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Alamat <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                            <input type="text" name="rows[0][alamat]" placeholder="Contoh: Desa Sindoro, Kec. Rowokele..."
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                        </div>

                        
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

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Jumlah Sampel <span class="text-red-400 normal-case">*</span></label>
                            <input type="number" name="rows[0][sampel_diperiksa]" min="1" placeholder="Contoh: 25"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Status Resistensi <span class="text-red-400 normal-case">*</span></label>
                            <select name="rows[0][status]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                                <option value="">— Pilih Status —</option>
                                <option value="resisten">🔴 Resisten</option>
                                <option value="rentan">🟢 Rentan</option>
                                <option value="toleran">🟡 Toleran</option>
                            </select>
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Mutasi <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                            <input type="text" name="rows[0][mutasi]" placeholder="Contoh: kdr, ace-1, Rdl..."
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Bulan <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                            <select name="rows[0][bulan]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                                <option value="">— Pilih Bulan —</option>
                                <option>Januari</option><option>Februari</option><option>Maret</option>
                                <option>April</option><option>Mei</option><option>Juni</option>
                                <option>Juli</option><option>Agustus</option><option>September</option>
                                <option>Oktober</option><option>November</option><option>Desember</option>
                            </select>
                        </div>

                        
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Tahun <span class="text-red-400 normal-case">*</span></label>
                            <input type="number" name="rows[0][tahun]" value="<?php echo e(date('Y')); ?>" min="2000" max="2099"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                        </div>

                        
                        <div class="md:col-span-2 xl:col-span-3">
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Publikasi / Sumber <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                            <input type="text" name="rows[0][publikasi]" placeholder="Contoh: URL jurnal atau nama file sumber..."
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                        </div>

                    </div>
                    

                </div>
                

            </div>
            

            
            <div class="flex items-center justify-between border-t border-slate-200 bg-slate-50 px-6 py-4">
                <p class="text-xs text-slate-500">
                    <span id="entryCount">1</span> entri siap disimpan
                </p>
                <button type="submit"
                    class="flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 active:scale-95">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
            </div>

        </form>
    </section>

    
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h2 class="text-base font-bold text-slate-800">Data Tersimpan</h2>
                <p class="mt-0.5 text-xs text-slate-500"><?php echo e($data->count()); ?> entri &bull; <?php echo e($tahun === 'semua' ? 'semua tahun' : 'tahun '.$tahun); ?><?php if($bulan): ?> &bull; <?php echo e($bulan); ?><?php endif; ?></p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-[1000px] w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                        <th class="w-10 px-5 py-3">No</th>
                        <th class="px-5 py-3">Provinsi</th>
                        <th class="px-5 py-3">Kota/Kab</th>
                        <th class="px-5 py-3">Alamat</th>
                        <th class="px-5 py-3">Jenis Nyamuk</th>
                        <th class="px-5 py-3">Insektisida</th>
                        <th class="px-5 py-3">Metode</th>
                        <th class="px-5 py-3 text-right">Sampel</th>
                        <th class="px-5 py-3">Bulan</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3">Mutasi</th>
                        <th class="px-5 py-3">Publikasi</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 text-slate-400 text-xs"><?php echo e($loop->iteration); ?></td>
                        <td class="px-5 py-3 font-medium"><?php echo e($item->provinsi->nama_provinsi ?? '-'); ?></td>
                        <td class="px-5 py-3 text-slate-600"><?php echo e($item->kabupaten->nama_kabupaten ?? '-'); ?></td>
                        <td class="px-5 py-3 text-slate-500 text-xs"><?php echo e($item->alamat ?? '—'); ?></td>
                        <td class="px-5 py-3">
                            <span class="inline-block rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700"><?php echo e($item->jenis_nyamuk); ?></span>
                        </td>
                        <td class="px-5 py-3 text-slate-600"><?php echo e($item->insektisida); ?></td>
                        <td class="px-5 py-3 text-slate-600"><?php echo e($item->metode); ?></td>
                        <td class="px-5 py-3 text-right font-bold text-slate-800"><?php echo e(number_format($item->sampel_diperiksa)); ?></td>
                        <td class="px-5 py-3 text-slate-500 text-xs"><?php echo e($item->bulan ?? '—'); ?></td>
                        <td class="px-5 py-3 text-center">
                            <?php if($item->status === 'resisten'): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-bold text-red-700">🔴 Resisten</span>
                            <?php elseif($item->status === 'rentan'): ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-bold text-green-700">🟢 Rentan</span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-bold text-yellow-700">🟡 Toleran</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-500"><?php echo e($item->mutasi ?? '—'); ?></td>
                            <td class="px-5 py-3 text-xs text-slate-500 max-w-[160px] truncate">
                                <?php if($item->publikasi): ?>
                                    <?php if(str_starts_with($item->publikasi, 'http')): ?>
                                        <a href="<?php echo e($item->publikasi); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat →</a>
                                    <?php else: ?>
                                        <?php echo e($item->publikasi); ?>

                                    <?php endif; ?>
                                <?php else: ?> —
                                <?php endif; ?>
                            </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button"
                                    onclick="openEditModal(<?php echo e($item->id); ?>)"
                                    class="flex items-center gap-1 rounded-lg border border-blue-300 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button type="button"
                                    onclick="openDeleteModal(<?php echo e($item->id); ?>)"
                                    class="flex items-center gap-1 rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-500 transition hover:bg-red-100">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M3 7h18"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="13" class="px-5 py-14 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">
                                    <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-slate-500">Belum ada data untuk <?php echo e($tahun === 'semua' ? 'semua tahun' : 'tahun '.$tahun); ?><?php if($bulan): ?> bulan <?php echo e($bulan); ?><?php endif; ?></p>
                                <p class="text-xs text-slate-400">Isi form di atas untuk menambahkan data baru.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</main>


<template id="cardTemplate">
    <div class="entry-card relative rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-200 hover:shadow-sm" data-index="__IDX__">
        <div class="mb-4 flex items-center justify-between">
            <span class="entry-badge inline-flex items-center gap-1.5 rounded-full bg-blue-600 px-3 py-1 text-xs font-bold text-white">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                </svg>
                <span class="entry-badge-num">Entri #__NUM__</span>
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
                    <?php $__currentLoopData = $provinsis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->nama_provinsi); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kota / Kabupaten <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][kabupaten_id]" class="kabupaten w-full rounded-xl border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm text-slate-500 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" disabled required>
                    <option value="">Pilih provinsi dulu</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Alamat <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                <input type="text" name="rows[__IDX__][alamat]" placeholder="Contoh: Desa Sindoro..."
                    class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
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
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Status Resistensi <span class="text-red-400 normal-case">*</span></label>
                <select name="rows[__IDX__][status]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
                    <option value="">— Pilih Status —</option>
                    <option value="resisten">🔴 Resisten</option>
                    <option value="rentan">🟢 Rentan</option>
                    <option value="toleran">🟡 Toleran</option>
                </select>
            </div>


            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Mutasi <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                <input type="text" name="rows[__IDX__][mutasi]" placeholder="Contoh: kdr, ace-1, Rdl..."
                    class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Bulan <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                <select name="rows[__IDX__][bulan]" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
                    <option value="">— Pilih Bulan —</option>
                    <option>Januari</option><option>Februari</option><option>Maret</option>
                    <option>April</option><option>Mei</option><option>Juni</option>
                    <option>Juli</option><option>Agustus</option><option>September</option>
                    <option>Oktober</option><option>November</option><option>Desember</option>
                </select>
            </div>
            <div>
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Tahun <span class="text-red-400 normal-case">*</span></label>
                <input type="number" name="rows[__IDX__][tahun]" value="<?php echo e(date('Y')); ?>" min="2000" max="2099"
                    class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition" required>
            </div>
            <div class="md:col-span-2 xl:col-span-3">
                <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Publikasi / Sumber <span class="text-slate-400 normal-case font-normal">(opsional)</span></label>
                <input type="text" name="rows[__IDX__][publikasi]" placeholder="Contoh: URL jurnal atau nama file sumber..."
                    class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition">
            </div>
        </div>
    </div>
</template>


<div id="editModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 py-6">
    <div class="flex max-h-[90vh] w-full max-w-2xl flex-col rounded-2xl bg-white shadow-2xl">
        <div class="flex shrink-0 items-center justify-between border-b border-slate-200 px-6 py-4">
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
        <form id="editForm" method="POST" class="flex min-h-0 flex-1 flex-col">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="grid grid-cols-2 gap-4 overflow-y-auto p-6">
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Provinsi <span class="text-red-500">*</span></label>
                    <select id="editProvinsi" name="provinsi_id" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="">Pilih Provinsi</option>
                        <?php $__currentLoopData = $provinsis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p->id); ?>"><?php echo e($p->nama_provinsi); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Kota/Kabupaten <span class="text-red-500">*</span></label>
                    <select id="editKabupaten" name="kabupaten_id" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" disabled required>
                        <option value="">Pilih Provinsi Dulu</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Alamat <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" id="editAlamat" name="alamat" placeholder="Contoh: Desa Sindoro, Kec. Rowokele..."
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
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
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Status Resistensi <span class="text-red-500">*</span></label>
                    <select id="editStatus" name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="resisten">🔴 Resisten</option>
                        <option value="rentan">🟢 Rentan</option>
                        <option value="toleran">🟡 Toleran</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Mutasi <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" id="editMutasi" name="mutasi" placeholder="Contoh: kdr, ace-1, Rdl..."
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Bulan <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <select id="editBulan" name="bulan" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <option value="">— Pilih Bulan —</option>
                        <option>Januari</option><option>Februari</option><option>Maret</option>
                        <option>April</option><option>Mei</option><option>Juni</option>
                        <option>Juli</option><option>Agustus</option><option>September</option>
                        <option>Oktober</option><option>November</option><option>Desember</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Tahun <span class="text-red-500">*</span></label>
                    <input type="number" id="editTahun" name="tahun" value="<?php echo e(date('Y')); ?>" min="2000" max="2099"
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                </div>
                <div class="col-span-2">
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Publikasi / Sumber <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" id="editPublikasi" name="publikasi" placeholder="Contoh: URL jurnal atau nama file sumber..."
                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
            </div>
            <div class="flex shrink-0 items-center justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 rounded-b-2xl">
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
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const KABUPATEN_URL = '<?php echo e(url("/kabupaten")); ?>';
const INPUT_URL     = '<?php echo e(url("/input")); ?>';

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
        const badgeNum = card.querySelector('.entry-badge-num');
        if (badgeNum) badgeNum.textContent = 'Entri #' + (i + 1);

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
    const badgeNum = card.querySelector('.entry-badge-num');
    if (badgeNum) badgeNum.textContent = 'Entri #' + (idx + 1);

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
window.openEditModal = function(id) {
    document.getElementById('editForm').action = INPUT_URL + '/' + id;

    const provSel = document.getElementById('editProvinsi');
    const kabSel  = document.getElementById('editKabupaten');
    let kabupatenId = null;

    kabSel.innerHTML = '<option>Memuat...</option>';
    kabSel.disabled = true;

    fetch(INPUT_URL + '/' + id + '/edit')
        .then(r => r.ok ? r.json() : Promise.reject())
        .then(data => {
            kabupatenId = data.kabupaten_id;
            provSel.value = data.provinsi_id;
            document.getElementById('editJenisNyamuk').value = data.jenis_nyamuk;
            document.getElementById('editInsektisida').value = data.insektisida;
            document.getElementById('editMetode').value      = data.metode;
            document.getElementById('editSampel').value      = data.sampel_diperiksa;
            document.getElementById('editStatus').value      = data.status;
            document.getElementById('editAlamat').value      = data.alamat || '';
            document.getElementById('editMutasi').value      = data.mutasi || '';
            document.getElementById('editBulan').value       = data.bulan || '';
            document.getElementById('editTahun').value       = data.tahun || '';
            document.getElementById('editPublikasi').value   = data.publikasi || '';

            return fetch(KABUPATEN_URL + '/' + data.provinsi_id).then(r => r.ok ? r.json() : Promise.reject());
        })
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
</html><?php /**PATH C:\xampp\htdocs\SimpelBBLK\resources\views/input.blade.php ENDPATH**/ ?>