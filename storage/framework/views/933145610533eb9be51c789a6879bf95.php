<?php $__env->startSection('title', 'Laporan Hilang Berhasil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto py-10">

    <!-- Card Putih Sesuai LAPORAN BERHASIL UPLOAD BARANG.png -->
    <div class="bg-white rounded-3xl p-8 sm:p-14 shadow-sm border border-slate-100 text-center space-y-7">
        
        <!-- Icon Centang Hijau Mint -->
        <div class="w-16 h-16 mx-auto rounded-3xl bg-[#D1FAE5] text-[#10B981] flex items-center justify-center shadow-2xs">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <!-- Teks Berhasil -->
        <div class="space-y-2">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Laporan berhasil <span class="text-blue-600">dikirim</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-sm mx-auto">
                Terimakasih laporan barang hilang kamu telah berhasil ditambahkan ke FindU
            </p>
        </div>

        <!-- Tombol Aksi Sesuai Figma -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-3">
            <a href="<?php echo e(route('claims.index')); ?>" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-7 py-3 rounded-xl transition shadow-xs flex items-center justify-center gap-2">
                <span>Lihat laporan saya</span>
                <span>&rarr;</span>
            </a>
            <a href="<?php echo e(route('home')); ?>" class="w-full sm:w-auto border border-blue-500 text-blue-600 hover:bg-blue-50 font-semibold text-xs sm:text-sm px-6 py-3 rounded-xl transition flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\new-xampp\htdocs\findu-laravel\resources\views/items/success-lost.blade.php ENDPATH**/ ?>