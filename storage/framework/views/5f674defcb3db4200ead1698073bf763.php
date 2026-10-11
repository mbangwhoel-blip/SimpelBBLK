<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Unit - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800">
<?php echo $__env->make('sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<main class="ml-64 min-h-screen p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Unit / Instansi</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola data unit atau instansi laboratorium</p>
        </div>
        <a href="<?php echo e(route('unit.create')); ?>" class="flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            + Tambah Unit
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-sm font-medium text-green-700"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-5 py-4 text-left">No</th>
                    <th class="px-5 py-4 text-left">Nama Unit</th>
                    <th class="px-5 py-4 text-left">Kode</th>
                    <th class="px-5 py-4 text-left">Kepala Unit</th>
                    <th class="px-5 py-4 text-left">Telepon</th>
                    <th class="px-5 py-4 text-left">Email</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__empty_1 = true; $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-slate-50">
                    <td class="px-5 py-3 text-slate-400"><?php echo e($loop->iteration); ?></td>
                    <td class="px-5 py-3 font-medium"><?php echo e($unit->nama_unit); ?></td>
                    <td class="px-5 py-3 text-slate-600"><?php echo e($unit->kode_unit ?? '—'); ?></td>
                    <td class="px-5 py-3 text-slate-600"><?php echo e($unit->kepala_unit ?? '—'); ?></td>
                    <td class="px-5 py-3 text-slate-600"><?php echo e($unit->telepon ?? '—'); ?></td>
                    <td class="px-5 py-3 text-slate-600"><?php echo e($unit->email ?? '—'); ?></td>
                    <td class="px-5 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="<?php echo e(route('unit.edit', $unit->id)); ?>" class="rounded-lg border border-blue-300 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 hover:bg-blue-100">Edit</a>
                            <form method="POST" action="<?php echo e(route('unit.destroy', $unit->id)); ?>" onsubmit="return confirm('Hapus unit ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-500 hover:bg-red-100">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="px-5 py-12 text-center text-sm text-slate-400">Belum ada data unit. <a href="<?php echo e(route('unit.create')); ?>" class="text-blue-600 hover:underline">Tambah sekarang →</a></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="border-t border-slate-200 px-5 py-4"><?php echo e($units->links()); ?></div>
    </div>

</main>
</body>
</html><?php /**PATH C:\xampp\htdocs\SimpelBBLK\resources\views/master/unit/index.blade.php ENDPATH**/ ?>