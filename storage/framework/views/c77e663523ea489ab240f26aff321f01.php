<?php $__env->startSection('title', 'Riwayat Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- Header Halaman Sesuai Figma RIWAYAT LAPORAN.png -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
            Riwayat <span class="text-blue-600">Saya</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Semua aktivitasmu di FindU: barang yang kamu upload, laporan kehilangan, dan klaim.
        </p>
    </div>

    <!-- 4 Kotak Ringkasan Metrik (Grid 4 Kolom) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
        <!-- 1. Barang diupload -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600"><?php echo e($stats['uploaded']); ?></div>
            <div class="text-xs font-medium text-slate-500 mt-1">Barang diupload</div>
        </div>

        <!-- 2. Laporan kehilangan -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600"><?php echo e($stats['lost']); ?></div>
            <div class="text-xs font-medium text-slate-500 mt-1">Laporan kehilangan</div>
        </div>

        <!-- 3. Klaim diajukan -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600"><?php echo e($stats['claimed']); ?></div>
            <div class="text-xs font-medium text-slate-500 mt-1">Klaim diajukan</div>
        </div>

        <!-- 4. Selesai -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600"><?php echo e($stats['completed']); ?></div>
            <div class="text-xs font-medium text-slate-500 mt-1">Selesai</div>
        </div>
    </div>

    <!-- Bagian Klaim Aktif -->
    <?php if($activeClaim): ?>
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-6">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Klaim Aktif</h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Tunjukkan kode ini ke satpam di <?php echo e($activeClaim->location); ?> sebelum <?php echo e($activeClaim->expired_date); ?>.
            </p>
        </div>

        <!-- Header Klaim Aktif (QR, Kode, Info Barang) -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-1">
            <div class="flex items-center gap-5">
                <!-- QR Code Antrean -->
                <div class="w-24 h-24 bg-white border border-slate-300 rounded-2xl p-2 flex flex-col justify-between shadow-2xs shrink-0">
                    <div class="flex justify-between">
                        <div class="w-6 h-6 border-4 border-slate-800 rounded-sm"></div>
                        <div class="w-2 h-2 bg-slate-800 self-center"></div>
                        <div class="w-6 h-6 border-4 border-slate-800 rounded-sm"></div>
                    </div>
                    <div class="flex justify-center gap-1.5 py-1">
                        <div class="w-2 h-2 bg-slate-800"></div>
                        <div class="w-3 h-2 bg-slate-800"></div>
                        <div class="w-2 h-2 bg-slate-800"></div>
                    </div>
                    <div class="flex justify-between items-end">
                        <div class="w-6 h-6 border-4 border-slate-800 rounded-sm"></div>
                        <div class="w-2 h-2 bg-slate-800"></div>
                        <div class="w-4 h-4 bg-slate-800 rounded-sm"></div>
                    </div>
                </div>

                <!-- Kode Klaim & Status -->
                <div>
                    <div class="text-[11px] font-bold text-slate-400 tracking-wider">KODE KLAIM</div>
                    <div class="text-2xl sm:text-3xl font-black text-blue-600 tracking-tight mt-0.5">
                        <?php echo e($activeClaim->claim_code); ?>

                    </div>
                    <div class="mt-2">
                        <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200/80 text-xs px-3.5 py-1 rounded-full font-medium">
                            <?php echo e($activeClaim->status); ?>

                        </span>
                    </div>
                </div>
            </div>

            <!-- Info Barang & Foto -->
            <div class="flex items-center gap-4 bg-slate-50/80 p-3.5 sm:p-4 rounded-2xl border border-slate-100">
                <div class="w-14 h-14 bg-slate-200 rounded-xl flex items-center justify-center text-xs font-semibold text-slate-400 shrink-0">
                    Foto
                </div>
                <div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900"><?php echo e($activeClaim->item_name); ?></h3>
                    <p class="text-xs text-slate-500 mt-0.5">Disimpan di <?php echo e($activeClaim->location); ?></p>
                    <p class="text-xs text-slate-400 mt-0.5"><?php echo e($activeClaim->validity); ?></p>
                </div>
            </div>
        </div>

        <!-- Stepper Progres Baris -->
        <div class="pt-1">
            <div class="grid grid-cols-4 gap-2 text-center text-xs font-medium text-slate-500">
                <div class="flex flex-col items-center">
                    <span class="text-slate-900 font-bold mb-2">Klaim diajukan</span>
                    <div class="w-full h-1 bg-blue-600 rounded-full"></div>
                </div>
                <div class="flex flex-col items-center">
                    <span class="mb-2">Ke pos satpam</span>
                    <div class="w-full h-1 bg-slate-200 rounded-full"></div>
                </div>
                <div class="flex flex-col items-center">
                    <span class="mb-2">Verifikasi petugas</span>
                    <div class="w-full h-1 bg-slate-200 rounded-full"></div>
                </div>
                <div class="flex flex-col items-center">
                    <span class="mb-2">Diserahkan</span>
                    <div class="w-full h-1 bg-slate-200 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Box Petunjuk Informasi -->
        <div class="bg-slate-50/90 border border-slate-100 rounded-2xl p-3.5 sm:p-4 text-xs text-slate-600 leading-relaxed">
            <?php echo e($activeClaim->notice); ?>

        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center gap-3 pt-1">
            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition shadow-xs">
                Unduh Kode Klaim
            </a>

            <form action="<?php echo e(route('claims.cancel', $activeClaim->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan klaim ini?')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="border border-rose-300 text-rose-500 hover:bg-rose-50 font-semibold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition">
                    Batalkan klaim
                </button>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Bagian Riwayat (Satu Kartu Putih Besar Sesuai RIWAYAT LAPORAN.png) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-6">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Riwayat</h2>
            <p class="text-xs text-slate-500 mt-0.5">Urut dari yang terbaru. Pilih tab untuk melihat satu jenis saja.</p>
        </div>

        <!-- Filter Tab Pills (Semua 10, Upload 3, Kehilangan 4, Klaim 4) -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1">
            <a href="<?php echo e(route('claims.index', ['filter' => 'semua'])); ?>" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition <?php echo e($filter === 'semua' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100'); ?>">
                Semua <?php echo e($counts['semua']); ?>

            </a>
            <a href="<?php echo e(route('claims.index', ['filter' => 'upload'])); ?>" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition <?php echo e($filter === 'upload' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100'); ?>">
                Upload <?php echo e($counts['upload']); ?>

            </a>
            <a href="<?php echo e(route('claims.index', ['filter' => 'kehilangan'])); ?>" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition <?php echo e($filter === 'kehilangan' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100'); ?>">
                Kehilangan <?php echo e($counts['kehilangan']); ?>

            </a>
            <a href="<?php echo e(route('claims.index', ['filter' => 'klaim'])); ?>" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition <?php echo e($filter === 'klaim' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100'); ?>">
                Klaim <?php echo e($counts['klaim']); ?>

            </a>
        </div>

        <!-- Daftar Baris Item dengan Garis Pembatas (divide-y) Sesuai Figma -->
        <div class="divide-y divide-slate-100 pt-2">
            <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="py-4 first:pt-2 last:pb-1 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <!-- Foto Placeholder -->
                    <div class="w-14 h-14 bg-slate-200 rounded-2xl flex items-center justify-center text-xs font-semibold text-slate-400 shrink-0">
                        Foto
                    </div>
                    
                    <div class="space-y-1">
                        <!-- Badge Kategori (Klaim / Kehilangan / Upload) -->
                        <div>
                            <span class="inline-block <?php echo e($act->category_color); ?> text-[10px] font-bold px-2.5 py-0.5 rounded-md">
                                <?php echo e($act->category_label); ?>

                            </span>
                        </div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-tight"><?php echo e($act->title); ?></h3>
                        <p class="text-xs text-slate-400 leading-normal"><?php echo e($act->subtitle); ?></p>
                    </div>
                </div>

                <!-- Bagian Status Badge & Tombol Aksi Sesuai Figma -->
                <div class="flex items-center gap-2.5 self-end sm:self-center shrink-0">
                    <!-- Status Badge (Jika Ada) -->
                    <?php if(!empty($act->status_badge)): ?>
                        <span class="<?php echo e($act->status_badge_color); ?> text-xs px-3.5 py-1 rounded-full font-semibold">
                            <?php echo e($act->status_badge); ?>

                        </span>
                    <?php endif; ?>

                    <!-- Tombol Aksi / Badge Khusus -->
                    <?php if(!empty($act->action_button)): ?>
                        <?php if(!empty($act->action_is_badge)): ?>
                            <span class="bg-slate-100 text-slate-500 text-xs px-4 py-1.5 rounded-xl font-semibold">
                                <?php echo e($act->action_button); ?>

                            </span>
                        <?php else: ?>
                            <a href="#" class="border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-semibold px-4 py-1.5 rounded-xl transition">
                                <?php echo e($act->action_button); ?>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="py-8 text-center text-slate-400 text-xs sm:text-sm">
                Belum ada data pada kategori ini.
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\new-xampp\htdocs\findu-laravel\resources\views/claims/index.blade.php ENDPATH**/ ?>