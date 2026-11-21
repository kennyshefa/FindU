<?php $__env->startSection('title', 'Laporan Ditemukan Berhasil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto py-8">

    <!-- Card Putih Sesuai LAPORAN BERHASIL.png -->
    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 text-center space-y-6">
        
        <!-- Lingkaran Centang Hijau Mint -->
        <div class="w-16 h-16 mx-auto rounded-full bg-[#D1FAE5] text-[#10B981] flex items-center justify-center shadow-2xs">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <!-- Teks Berhasil -->
        <div class="space-y-2">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Laporan berhasil <span class="text-blue-600">dikirim</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto">
                Terima kasih sudah membantu. Laporanmu sudah tersimpan dan tampil di Barang Terbaru. Kami akan memberi tahu kamu lewat Notifikasi saat ada yang mengajukan klaim.
            </p>
        </div>

        <!-- Kartu Ringkasan Sesuai Figma -->
        <div class="border border-slate-100 rounded-2xl p-4 bg-white flex items-center gap-4 text-left shadow-2xs max-w-sm mx-auto">
            <div class="w-16 h-16 rounded-xl bg-slate-200 shrink-0"></div>
            <div class="space-y-1.5">
                <div>
                    <span class="inline-block bg-[#D1FAE5] text-[#059669] text-[10px] font-semibold px-2.5 py-0.5 rounded-full">
                        Ditemukan
                    </span>
                </div>
                <div class="flex items-center gap-1.5 text-xs text-blue-500">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>
                <div class="flex items-center gap-1.5 text-xs text-blue-500">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="<?php echo e(route('claims.index')); ?>" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-7 py-3 rounded-xl transition shadow-xs text-center">
                Lihat laporan saya
            </a>
            <a href="<?php echo e(route('items.create-found')); ?>" class="w-full sm:w-auto border border-blue-500 text-blue-600 hover:bg-blue-50 font-semibold text-xs sm:text-sm px-6 py-3 rounded-xl transition text-center">
                Laporkan barang lain
            </a>
        </div>

        <div>
            <a href="<?php echo e(route('home')); ?>" class="text-xs font-semibold text-blue-600 hover:underline">
                Kembali ke Beranda
            </a>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\new-xampp\htdocs\findu-laravel\resources\views/items/success-found.blade.php ENDPATH**/ ?>