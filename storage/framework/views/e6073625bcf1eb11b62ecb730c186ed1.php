<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800">
<?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main class="ml-64 min-h-screen p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Export Data</h1>
        <p class="mt-1 text-sm text-slate-500">Download data uji resistensi ke file Excel</p>
    </div>
    <div class="max-w-lg rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <form method="GET" action="<?php echo e(route('export.download')); ?>">
            <div class="mb-5">
                <label class="mb-1.5 block text-sm font-semibold text-slate-700">Filter Tahun</label>
                <select name="tahun" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none">
                    <option value="semua">Semua Tahun</option>
                    <?php $__currentLoopData = range(date('Y'), date('Y') - 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($y); ?>" <?php echo e(date('Y') == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3"/></svg>
                Download Excel
            </button>
        </form>
        <div class="mt-6 rounded-xl bg-slate-50 p-4 text-sm text-slate-600">
            <p class="font-semibold text-slate-700 mb-2">Kolom yang diekspor:</p>
            <ul class="list-disc pl-5 space-y-1">
                <li>No, Tahun, Provinsi, Kab/Kota</li>
                <li>Jenis Nyamuk, Insektisida, Metode</li>
                <li>Sampel Diperiksa, Status, Mutasi</li>
            </ul>
        </div>
    </div>

</main>
</body>
</html><?php /**PATH C:\xampp\htdocs\SimpelBBLK\resources\views/data/export.blade.php ENDPATH**/ ?>