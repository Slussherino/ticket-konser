<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans text-gray-800">
    <div class="max-w-5xl mx-auto">
        <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-blue-600">
                Daftar Event
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Pilih event favoritmu dan pesan tiket dengan mudah.
            </p>
        </div>

        <!-- NOTIFIKASI -->
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-center font-semibold">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                <p class="font-bold mb-2">Pesanan belum dapat diproses:</p>
                <ul class="list-disc list-inside">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form id="orderForm" action="<?php echo e(route('customer.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <!-- Hidden Input untuk menyimpan event_id yang dipilih -->
            <input type="hidden" name="event_id" id="selected_event_id" value="<?php echo e(old('event_id')); ?>">

            <!-- 1. INFORMASI PEMESAN -->
            <div class="bg-white p-6 rounded-xl shadow-sm border mb-6">
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">
                    1. Informasi Pemesan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="customer_name" class="block text-sm font-semibold text-gray-600 mb-1">
                            Nama Lengkap
                        </label>
                        <input type="text" id="customer_name" name="customer_name" value="<?php echo e(old('customer_name')); ?>" maxlength="255" required placeholder="Masukkan nama lengkap" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label for="customer_email" class="block text-sm font-semibold text-gray-600 mb-1">
                            Email
                        </label>
                        <input type="email" id="customer_email" name="customer_email" value="<?php echo e(old('customer_email')); ?>" maxlength="255" required placeholder="nama@email.com" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- 2. FILTER KATEGORI -->
            <div class="mb-6">
                <div class="text-center mb-5">
                    <h2 class="text-xl font-extrabold text-gray-800">
                        2. Pilih Event
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Pilih event dan tentukan jumlah tiket yang ingin dipesan.
                    </p>
                </div>
                <div class="flex flex-wrap justify-center gap-3">
                    <button type="button" onclick="filterCategory('all', this)" class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-blue-600 text-white shadow-md">
                        Semua Event
                    </button>
                    <button type="button" onclick="filterCategory('Musik', this)" class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border">
                        Musik
                    </button>
                    <button type="button" onclick="filterCategory('Festival', this)" class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border">
                        Festival
                    </button>
                    <button type="button" onclick="filterCategory('Seminar', this)" class="btn-category px-5 py-2 rounded-full font-semibold text-sm transition bg-white text-gray-600 hover:bg-gray-200 border">
                        Seminar
                    </button>
                </div>
            </div>

            <!-- 3. DAFTAR EVENT -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="event-card bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col justify-between transition-all duration-300" data-category="<?php echo e($event->category); ?>">
                        <div>
                            <?php if($event->image): ?>
                                <img src="<?php echo e(asset('storage/' . $event->image)); ?>" alt="<?php echo e($event->title); ?>" class="w-full h-40 object-cover">
                            <?php else: ?>
                                <div class="bg-gradient-to-br from-blue-100 to-indigo-200 h-40 flex items-center justify-center text-blue-500 font-semibold">
                                    Tanpa Poster
                                </div>
                            <?php endif; ?>
                            <div class="p-4">
                                <div class="flex justify-between items-center gap-2 mb-2">
                                    <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2.5 py-1 rounded">
                                        <?php echo e($event->category); ?>

                                    </span>
                                    <span class="font-bold text-green-600 text-sm whitespace-nowrap">
                                        Rp <?php echo e(number_format($event->price, 0, ',', '.')); ?>

                                    </span>
                                </div>
                                <h3 class="font-bold text-gray-800 text-lg">
                                    <?php echo e($event->title); ?>

                                </h3>
                                <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                                    <?php echo e($event->description ?: 'Tidak ada deskripsi event.'); ?>

                                </p>
                            </div>
                        </div>

                        <!-- PILIH EVENT DAN JUMLAH -->
                        <div class="p-4 bg-gray-50 border-t">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">
                                Jumlah Tiket
                            </label>
                            <input type="number" 
                                   name="quantity" 
                                   min="1" 
                                   max="1000" 
                                   value="1" 
                                   class="event-qty w-full border rounded-lg px-3 py-2 text-center font-bold text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none mb-3"
                                   data-event-id="<?php echo e($event->id); ?>"
                                   data-price="<?php echo e($event->price); ?>">

                            <button type="button" 
                                    onclick="selectEvent('<?php echo e($event->id); ?>', this)" 
                                    id="btn-select-<?php echo e($event->id); ?>"
                                    class="w-full py-2 px-4 rounded-lg font-semibold text-sm transition bg-blue-600 hover:bg-blue-700 text-white">
                                Pilih Event Ini
                            </button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full text-center py-10 bg-white rounded-xl border">
                        <p class="text-gray-500">Belum ada event tersedia saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- RINGKASAN & SUBMIT (SELALU MUNCUL) -->
            <div id="checkout-section" class="bg-white p-6 rounded-xl shadow-sm border mb-8">
                <h2 class="text-lg font-bold text-gray-700 mb-4 pb-2 border-b">
                    3. Ringkasan Pesanan
                </h2>
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Event Terpilih: <span id="summary-title" class="font-bold text-red-500">
                            Belum ada event yang dipilih (Silakan klik "Pilih Event Ini" di atas)
                        </span></p>
                        <p class="text-sm text-gray-600 mt-1">Total Pembayaran: <span id="summary-total" class="font-extrabold text-green-600 text-lg">
                            Rp 0
                        </span></p>
                    </div>
                    <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3 rounded-xl shadow-md transition">
                        Konfirmasi & Pesan Tiket
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- SCRIPT JAVASCRIPT -->
    <script>
        function filterCategory(category, button) {
            document.querySelectorAll('.btn-category').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
                btn.classList.add('bg-white', 'text-gray-600', 'hover:bg-gray-200', 'border');
            });
            button.classList.remove('bg-white', 'text-gray-600', 'hover:bg-gray-200', 'border');
            button.classList.add('bg-blue-600', 'text-white', 'shadow-md');

            document.querySelectorAll('.event-card').forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function selectEvent(eventId, btnElement) {
            // Set input hidden event_id
            document.getElementById('selected_event_id').value = eventId;

            // Reset semua tombol pilih event
            document.querySelectorAll('[id^="btn-select-"]').forEach(btn => {
                btn.className = 'w-full py-2 px-4 rounded-lg font-semibold text-sm transition bg-blue-600 hover:bg-blue-700 text-white';
                btn.innerText = 'Pilih Event Ini';
            });

            // Ubah tombol yang diklik jadi aktif
            btnElement.className = 'w-full py-2 px-4 rounded-lg font-semibold text-sm transition bg-green-600 text-white';
            btnElement.innerText = 'Event Dipilih';

            // Hitung total dan update ringkasan
            updateTotal();
        }

        function updateTotal() {
            const eventId = document.getElementById('selected_event_id').value;
            if (!eventId) return;

            const qtyInput = document.querySelector('input.event-qty[data-event-id="' + eventId + '"]');
            if (!qtyInput) return;

            const quantity = parseInt(qtyInput.value) || 1;
            const price = parseFloat(qtyInput.dataset.price) || 0;
            const total = quantity * price;

            const card = qtyInput.closest('.event-card');
            const title = card.querySelector('h3').innerText;

            const summaryTitle = document.getElementById('summary-title');
            const summaryTotal = document.getElementById('summary-total');

            summaryTitle.className = 'font-bold text-gray-800';
            summaryTitle.innerText = title + ' (' + quantity + ' Tiket)';
            summaryTotal.innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Listener perubahan jumlah tiket pada setiap input quantity
        document.querySelectorAll('.event-qty').forEach(input => {
            input.addEventListener('input', function() {
                const eventId = this.dataset.eventId;
                const currentSelected = document.getElementById('selected_event_id').value;
                if (eventId === currentSelected) {
                    updateTotal();
                }
            });
        });

        // Validasi sebelum submit form
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            const eventId = document.getElementById('selected_event_id').value;
            if (!eventId) {
                e.preventDefault();
                alert('Silakan pilih salah satu event terlebih dahulu dengan mengklik tombol "Pilih Event Ini".');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\praserkom_zhulfa\ticket-konser\resources\views/customer/index.blade.php ENDPATH**/ ?>