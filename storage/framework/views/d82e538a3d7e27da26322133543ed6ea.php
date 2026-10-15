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
            Edit Event
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">

        <?php if($errors->any()): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <form action="<?php echo e(route('admin.events.update', $event->id)); ?>"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white p-6 rounded-lg shadow-sm border">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="title" class="block font-medium mb-1">
                    Nama Event
                </label>
                <input id="title" type="text" name="title"
                       value="<?php echo e(old('title', $event->title)); ?>"
                       class="w-full border-gray-300 rounded-lg p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="category" class="block font-medium mb-1">
                    Kategori
                </label>
                <select id="category" name="category"
                        class="w-full border-gray-300 rounded-lg p-2"
                        required>
                    <option value="Musik" <?php if(old('category', $event->category) === 'Musik'): echo 'selected'; endif; ?>>
                        Musik
                    </option>
                    <option value="Festival" <?php if(old('category', $event->category) === 'Festival'): echo 'selected'; endif; ?>>
                        Festival
                    </option>
                    <option value="Seminar" <?php if(old('category', $event->category) === 'Seminar'): echo 'selected'; endif; ?>>
                        Seminar
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium mb-1">
                    Harga Tiket (Rp)
                </label>
                <input id="price" type="number" name="price"
                       value="<?php echo e(old('price', $event->price)); ?>"
                       min="0"
                       class="w-full border-gray-300 rounded-lg p-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium mb-1">
                    Deskripsi
                </label>
                <textarea id="description" name="description" rows="4"
                          class="w-full border-gray-300 rounded-lg p-2"
                          required><?php echo e(old('description', $event->description)); ?></textarea>
            </div>

            <div class="mb-5">
                <label class="block font-medium mb-2">
                    Poster Saat Ini
                </label>

                <?php if($event->image): ?>
                    <img src="<?php echo e(asset('storage/' . $event->image)); ?>"
                         alt="<?php echo e($event->title); ?>"
                         class="w-40 h-40 object-cover rounded-lg border mb-3">
                <?php else: ?>
                    <div class="w-40 h-40 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 mb-3">
                        Belum ada poster
                    </div>
                <?php endif; ?>

                <label for="image" class="block font-medium mb-1">
                    Ganti Poster (Opsional)
                </label>
                <input id="image" type="file" name="image"
                       accept=".jpg,.jpeg,.png,.gif"
                       class="w-full border rounded-lg p-2">

                <p class="text-sm text-gray-500 mt-1">
                    Kosongkan jika tidak ingin mengganti poster. Maksimal 2 MB.
                </p>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold">
                    Update Event
                </button>

                <a href="<?php echo e(route('admin.events.index')); ?>"
                   class="bg-gray-200 hover:bg-gray-300 px-6 py-2.5 rounded-lg font-semibold">
                    Kembali
                </a>
            </div>
        </form>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\praserkom_zhulfa\ticket-konser\resources\views/admin/events/edit.blade.php ENDPATH**/ ?>