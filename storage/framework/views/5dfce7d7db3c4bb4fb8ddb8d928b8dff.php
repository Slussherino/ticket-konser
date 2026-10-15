<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Event
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg mb-5">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Daftar Event</h3>
            <a href="<?php echo e(route('admin.events.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                + Tambah Event Baru
            </a>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm border-b">
                        <th class="p-4">Poster</th>
                        <th class="p-4">Judul Event</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b hover:bg-gray-50 text-sm">
                            <td class="p-4">
                                <?php if($event->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" class="w-16 h-12 object-cover rounded">
                                <?php else: ?>
                                    <span class="text-xs text-gray-400">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 font-semibold text-gray-800"><?php echo e($event->title); ?></td>
                            <td class="p-4">
                                <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded text-xs font-semibold">
                                    <?php echo e($event->category); ?>

                                </span>
                            </td>
                            <td class="p-4 font-bold text-green-600">Rp <?php echo e(number_format($event->price, 0, ',', '.')); ?></td>
                            <td class="p-4 text-center space-x-2">
                                <a href="<?php echo e(route('admin.events.edit', $event->id)); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded text-xs font-semibold">
                                    Edit
                                </a>
                                <form action="<?php echo e(route('admin.events.destroy', $event->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-500">
                                Belum ada event yang ditambahkan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <?php echo e($events->links()); ?>

        </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\praserkom_zhulfa\ticket-konser\resources\views/admin/events/index.blade.php ENDPATH**/ ?>