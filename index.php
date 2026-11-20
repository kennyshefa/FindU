<?php
/**
 * FindU - Sistem Pelaporan & Klaim Barang Hilang Kampus
 * Halaman: Klaim Saya (Status & Riwayat Klaim)
 * 
 * Kelompok 1 - Pemrograman Web
 */

require_once __DIR__ . '/koneksi.php';

// Cek apakah database MySQL terkoneksi atau fallback ke data dummy
$claims = [];

if (isset($db_connected) && $db_connected && $conn) {
    try {
        $stmt = $conn->query("
            SELECT k.*, b.nama_barang, b.lokasi_penyimpanan, b.foto 
            FROM klaim k 
            JOIN barang b ON k.barang_id = b.id 
            ORDER BY k.id ASC
        ");
        $raw_claims = $stmt->fetchAll();
        
        foreach ($raw_claims as $rc) {
            $item = [
                'id' => $rc['id'],
                'kode_klaim' => $rc['kode_klaim'],
                'nama_barang' => $rc['nama_barang'],
                'lokasi_penyimpanan' => $rc['lokasi_penyimpanan'],
                'status' => $rc['status'],
                'is_active' => (bool)$rc['is_active'],
                'tahap' => (int)$rc['tahap'],
                'deadline' => date('d M Y', strtotime($rc['deadline'])),
                'masa_berlaku' => 'Berlaku ' . ($rc['masa_berlaku_hari'] ?? 7) . ' hari. Setelah itu klaim kedaluwarsa.',
                'gambar' => $rc['foto'],
                'catatan' => $rc['catatan_klaim'],
                'tanggal_serah' => $rc['tanggal_selesai'] ? date('d M Y', strtotime($rc['tanggal_selesai'])) : null,
                'tanggal' => $rc['tanggal_selesai'] ? date('d M Y', strtotime($rc['tanggal_selesai'])) : date('d M Y', strtotime($rc['tanggal_pengajuan'])),
                'alasan' => $rc['alasan_petugas'],
            ];

            if ($rc['status'] === 'menunggu_verifikasi') {
                $item['status_label'] = 'Menunggu verifikasi';
            } elseif ($rc['status'] === 'selesai') {
                $item['status_label'] = 'Klaim berhasil';
                $item['jejak_serah_terima'] = [
                    'tanggal' => '20 Nov 2026, 14.32',
                    'detail_penyerahan' => 'Diserahkan oleh ' . ($rc['petugas_penyerah'] ?: '[Nama Petugas]') . ' setelah verifikasi',
                    'foto_server' => '20 Nov 2026, 14.30 · Foto serah terima dicatat server',
                    'pengajuan' => '20 Nov 2026, 10.15 · Klaim diajukan',
                    'batas_keberatan' => date('d M Y', strtotime('+7 days', strtotime($rc['tanggal_selesai'] ?? '2026-11-20')))
                ];
            } elseif ($rc['status'] === 'ditolak') {
                $item['status_label'] = 'Ditolak';
            } elseif ($rc['status'] === 'kedaluwarsa') {
                $item['status_label'] = 'Kedaluwarsa';
            }

            $claims[] = $item;
        }
    } catch (Exception $e) {
        $claims = [];
    }
}

// Fallback ke Mock Data jika database kosong atau belum terhubung
if (empty($claims)) {
    $claims = [
        [
            'id' => 1,
            'kode_klaim' => 'FU-2611-0038',
            'nama_barang' => 'Kunci Motor',
            'lokasi_penyimpanan' => 'Pos Satpam Gedung F',
            'status' => 'menunggu_verifikasi',
            'status_label' => 'Menunggu verifikasi',
            'is_active' => true,
            'deadline' => '27 Nov 2026',
            'masa_berlaku' => 'Berlaku 7 hari. Setelah itu klaim kedaluwarsa.',
            'gambar' => null,
            'tahap' => 2,
            'catatan' => 'Bawa KTM dan ingat kapan (jam) serta di mana kamu merasa kehilangan barang ini. Kode hanya nomor antrean, bukan bukti kepemilikan.',
        ],
        [
            'id' => 2,
            'kode_klaim' => 'FU-2611-0042',
            'nama_barang' => 'Kotak Pensil',
            'lokasi_penyimpanan' => 'Pos Satpam Gedung B',
            'status' => 'selesai',
            'status_label' => 'Klaim berhasil',
            'is_active' => false,
            'tanggal_serah' => '20 Nov 2026',
            'jejak_serah_terima' => [
                'tanggal' => '20 Nov 2026, 14.32',
                'detail_penyerahan' => 'Diserahkan oleh [Nama Petugas] setelah verifikasi',
                'foto_server' => '20 Nov 2026, 14.30 · Foto serah terima dicatat server',
                'pengajuan' => '20 Nov 2026, 10.15 · Klaim diajukan',
                'batas_keberatan' => '27 Nov 2026'
            ]
        ],
        [
            'id' => 3,
            'kode_klaim' => 'FU-2611-0031',
            'nama_barang' => 'Tumbler Biru',
            'lokasi_penyimpanan' => 'Pos Satpam Rektorat',
            'status' => 'ditolak',
            'status_label' => 'Ditolak',
            'is_active' => false,
            'tanggal' => '12 Nov 2026',
            'alasan' => 'ciri tidak sesuai'
        ],
        [
            'id' => 4,
            'kode_klaim' => 'FU-2611-0027',
            'nama_barang' => 'Kacamata',
            'lokasi_penyimpanan' => 'Pos Satpam Gedung A',
            'status' => 'kedaluwarsa',
            'status_label' => 'Kedaluwarsa',
            'is_active' => false,
            'tanggal' => '10 Nov 2026',
            'alasan' => 'Tidak datang ke pos dalam 7 hari'
        ]
    ];
}

// Perhitungan Statistik Metrik
$total_klaim = count($claims);
$total_menunggu = count(array_filter($claims, fn($c) => $c['status'] === 'menunggu_verifikasi'));
$total_selesai = count(array_filter($claims, fn($c) => $c['status'] === 'selesai'));
$total_ditolak_kedaluwarsa = count(array_filter($claims, fn($c) => in_array($c['status'], ['ditolak', 'kedaluwarsa'])));

// Pisahkan Klaim Aktif & Riwayat
$klaim_aktif = null;
$riwayat_klaim = [];

foreach ($claims as $c) {
    if ($c['is_active']) {
        $klaim_aktif = $c;
    } else {
        $riwayat_klaim[] = $c;
    }
}

// Filter Tab Riwayat
$filter = isset($_GET['filter']) ? strtolower(trim($_GET['filter'])) : 'semua';
$filtered_riwayat = $riwayat_klaim;

if ($filter !== 'semua') {
    $filtered_riwayat = array_filter($riwayat_klaim, function($c) use ($filter) {
        return $c['status'] === $filter;
    });
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindU - Klaim Saya</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #E8F0FC;
        }
        @media print {
            body { background-color: #ffffff; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="font-sans text-slate-800 antialiased min-h-screen pb-20">

    <!-- NAVBAR CONTAINER -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-5">
        <header class="bg-white rounded-2xl shadow-[0_2px_12px_rgba(30,64,175,0.06)] border border-blue-50/80 px-6 py-3.5 flex items-center justify-between">
            
            <!-- Left Logo: FindU -->
            <a href="index.php" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full border-[2.2px] border-blue-600 flex items-center justify-center text-blue-600">
                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21s-6-5.333-6-10a6 6 0 0 1 12 0c0 4.667-6 10-6 10z"/>
                        <circle cx="12" cy="11" r="2.5"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-blue-600">Find<span class="text-blue-700">U</span></span>
            </a>

            <!-- Nav Links -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
                <a href="#beranda" class="hover:text-blue-600 transition">Beranda</a>
                <a href="#cari" class="hover:text-blue-600 transition">Cari</a>
                <a href="#upload" class="hover:text-blue-600 transition">Upload</a>
                <a href="index.php" class="text-blue-600 font-semibold relative py-1">
                    Riwayat
                    <span class="absolute -bottom-1 left-0 w-full h-[2.5px] bg-blue-600 rounded-full"></span>
                </a>
                <a href="#tentang" class="hover:text-blue-600 transition">Tentang Kami</a>
            </nav>

            <!-- Right: Tombol Saya -->
            <div>
                <a href="#profile" class="inline-flex items-center justify-center px-6 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition rounded-xl shadow-sm">
                    Saya
                </a>
            </div>
        </header>
    </div>

    <!-- MAIN WRAPPER -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 pt-7 space-y-6">

        <!-- TITLE SECTION -->
        <div class="space-y-1">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-[#193B68] tracking-tight">Klaim Saya</h1>
            <p class="text-slate-500 text-sm sm:text-base">
                Pantau klaim aktif, kode, dan bukti serah terima dalam satu halaman.
            </p>
        </div>

        <!-- 4 SUMMARY STATS CARDS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            
            <!-- Total Klaim -->
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(30,64,175,0.04)] border border-blue-50/80">
                <div class="text-3xl sm:text-4xl font-extrabold text-blue-600 leading-none">
                    <?= $total_klaim ?>
                </div>
                <div class="text-xs sm:text-sm font-medium text-slate-500 mt-2.5">
                    Total klaim
                </div>
            </div>

            <!-- Menunggu -->
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(30,64,175,0.04)] border border-blue-50/80">
                <div class="text-3xl sm:text-4xl font-extrabold text-blue-600 leading-none">
                    <?= $total_menunggu ?>
                </div>
                <div class="text-xs sm:text-sm font-medium text-slate-500 mt-2.5">
                    Menunggu
                </div>
            </div>

            <!-- Selesai -->
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(30,64,175,0.04)] border border-blue-50/80">
                <div class="text-3xl sm:text-4xl font-extrabold text-blue-600 leading-none">
                    <?= $total_selesai ?>
                </div>
                <div class="text-xs sm:text-sm font-medium text-slate-500 mt-2.5">
                    Selesai
                </div>
            </div>

            <!-- Ditolak / Kedaluwarsa -->
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(30,64,175,0.04)] border border-blue-50/80">
                <div class="text-3xl sm:text-4xl font-extrabold text-blue-600 leading-none">
                    <?= $total_ditolak_kedaluwarsa ?>
                </div>
                <div class="text-xs sm:text-sm font-medium text-slate-500 mt-2.5">
                    Ditolak / kedaluwarsa
                </div>
            </div>

        </div>

        <?php if ($klaim_aktif): ?>
        <!-- SECTION: KLAIM AKTIF -->
        <section class="bg-white rounded-3xl p-6 sm:p-8 shadow-[0_3px_14px_rgba(30,64,175,0.05)] border border-blue-50/90">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-[#193B68]">Klaim Aktif</h2>
                <p class="text-slate-500 text-xs sm:text-sm mt-0.5">
                    Tunjukkan kode ini ke satpam di <span class="font-medium text-slate-700"><?= htmlspecialchars($klaim_aktif['lokasi_penyimpanan']) ?></span> sebelum <?= htmlspecialchars($klaim_aktif['deadline']) ?>.
                </p>
            </div>

            <!-- Main Info Row: QR Code + Kode Klaim + Foto & Nama Barang -->
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-7">
                
                <!-- QR Code Box (Pixel accurate style) -->
                <div class="w-28 h-28 sm:w-32 sm:h-32 bg-white rounded-2xl border border-slate-200 p-2.5 shadow-sm flex items-center justify-center flex-shrink-0">
                    <svg class="w-full h-full text-slate-800" viewBox="0 0 100 100" fill="currentColor">
                        <!-- Top-Left Finder Pattern -->
                        <path d="M8,8 h28 v28 h-28 z M14,14 v16 h16 v-16 z M19,19 h6 v6 h-6 z"/>
                        <!-- Top-Right Finder Pattern -->
                        <path d="M64,8 h28 v28 h-28 z M70,14 v16 h16 v-16 z M75,19 h6 v6 h-6 z"/>
                        <!-- Bottom-Left Finder Pattern -->
                        <path d="M8,64 h28 v28 h-28 z M14,70 v16 h16 v-16 z M19,75 h6 v6 h-6 z"/>
                        
                        <!-- Internal Pattern Elements -->
                        <rect x="42" y="10" width="6" height="6" />
                        <rect x="52" y="10" width="6" height="6" />
                        <rect x="42" y="22" width="6" height="6" />
                        <rect x="52" y="24" width="6" height="12" />
                        <rect x="10" y="42" width="6" height="6" />
                        <rect x="22" y="42" width="6" height="10" />
                        <rect x="10" y="52" width="6" height="6" />
                        <rect x="42" y="42" width="8" height="8" />
                        <rect x="56" y="42" width="6" height="6" />
                        <rect x="42" y="56" width="6" height="14" />
                        <rect x="56" y="54" width="8" height="6" />
                        <rect x="52" y="66" width="8" height="6" />
                        <rect x="70" y="44" width="6" height="6" />
                        <rect x="82" y="44" width="10" height="6" />
                        <rect x="74" y="56" width="10" height="6" />
                        <rect x="68" y="68" width="6" height="12" />
                        <rect x="80" y="68" width="12" height="6" />
                        <rect x="84" y="80" width="8" height="12" />
                        <rect x="42" y="80" width="12" height="6" />
                        <rect x="58" y="82" width="6" height="10" />
                    </svg>
                </div>

                <!-- Middle: Label, Kode Klaim, Badge -->
                <div class="space-y-1.5 flex-1">
                    <span class="text-[11px] font-bold tracking-wider uppercase text-slate-400">KODE KLAIM</span>
                    <div class="text-2xl sm:text-3xl font-extrabold text-[#1D58D8] tracking-tight">
                        <?= htmlspecialchars($klaim_aktif['kode_klaim']) ?>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#FEF3C7] text-[#92400E]">
                            <?= htmlspecialchars($klaim_aktif['status_label']) ?>
                        </span>
                    </div>
                </div>

                <!-- Right: Item Photo Placeholder & Information -->
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-[#C8D6E5] text-slate-600 text-xs font-medium flex items-center justify-center flex-shrink-0">
                        Foto
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800 text-base sm:text-lg leading-snug">
                            <?= htmlspecialchars($klaim_aktif['nama_barang']) ?>
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Disimpan di <?= htmlspecialchars($klaim_aktif['lokasi_penyimpanan']) ?>
                        </p>
                        <p class="text-xs text-slate-400 mt-1">
                            <?= htmlspecialchars($klaim_aktif['masa_berlaku']) ?>
                        </p>
                    </div>
                </div>

            </div>

            <!-- Stepper Progress Tracker -->
            <div class="mb-6 pt-2">
                <!-- Bar Container -->
                <div class="relative w-full mb-3">
                    <!-- Gray Background Line -->
                    <div class="h-1.5 w-full bg-slate-200 rounded-full"></div>
                    <!-- Blue Progress Line (sampai tahap 'Ke pos satpam' ~ 35%) -->
                    <div class="absolute top-0 left-0 h-1.5 w-[33%] bg-blue-600 rounded-full"></div>
                </div>

                <!-- 4 Labels -->
                <div class="grid grid-cols-4 text-xs font-semibold">
                    <div class="text-left text-slate-800">Klaim diajukan</div>
                    <div class="text-center text-slate-800">Ke pos satpam</div>
                    <div class="text-center text-slate-400 font-normal">Verifikasi petugas</div>
                    <div class="text-right text-slate-400 font-normal">Diserahkan</div>
                </div>
            </div>

            <!-- Guidance Text Note -->
            <p class="text-xs sm:text-sm text-slate-500 mb-6 leading-relaxed">
                <?= htmlspecialchars($klaim_aktif['catatan']) ?>
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-3">
                <button onclick="downloadCode('<?= $klaim_aktif['kode_klaim'] ?>')" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition shadow-sm hover:shadow">
                    Unduh Kode Klaim
                </button>
                <button onclick="cancelClaim('<?= $klaim_aktif['kode_klaim'] ?>')" class="px-6 py-2.5 bg-white border border-rose-300 text-rose-600 hover:bg-rose-50 font-medium text-sm rounded-xl transition">
                    Batalkan klaim
                </button>
            </div>

        </section>
        <?php endif; ?>

        <!-- SECTION: RIWAYAT -->
        <section class="bg-white rounded-3xl p-6 sm:p-8 shadow-[0_3px_14px_rgba(30,64,175,0.05)] border border-blue-50/90">
            <!-- Header -->
            <div class="mb-5">
                <h2 class="text-xl font-bold text-[#193B68]">Riwayat</h2>
                <p class="text-slate-500 text-xs sm:text-sm mt-0.5">
                    Klaim yang sudah selesai, ditolak, atau kedaluwarsa.
                </p>
            </div>

            <!-- Filter Tabs Pills -->
            <div class="flex flex-wrap items-center gap-2 mb-6">
                <?php
                $tab_list = [
                    'semua' => 'Semua',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                    'kedaluwarsa' => 'Kedaluwarsa'
                ];
                foreach ($tab_list as $key => $name):
                    $isActive = ($filter === $key);
                ?>
                    <a href="?filter=<?= $key ?>" class="px-4 py-1.5 rounded-full text-xs sm:text-sm font-medium transition <?= $isActive ? 'bg-blue-600 text-white shadow-sm' : 'bg-[#EBF2FC] text-blue-600 hover:bg-blue-100' ?>">
                        <?= $name ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- History Items List -->
            <div class="space-y-4">

                <?php if (empty($filtered_riwayat)): ?>
                    <div class="p-8 text-center text-slate-400 text-sm">
                        Tidak ada riwayat klaim untuk filter ini.
                    </div>
                <?php endif; ?>

                <?php foreach ($filtered_riwayat as $item): ?>
                    
                    <div class="border border-slate-100 rounded-2xl p-4 sm:p-5 transition bg-white hover:border-blue-100">
                        
                        <!-- Header Row Item -->
                        <div class="flex items-center justify-between gap-4">
                            
                            <!-- Left: Foto & Info -->
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-[#C8D6E5] text-slate-600 text-xs font-medium flex items-center justify-center flex-shrink-0">
                                    Foto
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-base">
                                        <?= htmlspecialchars($item['nama_barang']) ?>
                                    </h4>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        <?= htmlspecialchars($item['kode_klaim']) ?> · 
                                        <?php if ($item['status'] === 'selesai'): ?>
                                            Diserahkan <?= htmlspecialchars($item['tanggal_serah']) ?>
                                        <?php elseif ($item['status'] === 'ditolak'): ?>
                                            Ditolak <?= htmlspecialchars($item['tanggal']) ?> · Alasan petugas: <?= htmlspecialchars($item['alasan']) ?>
                                        <?php elseif ($item['status'] === 'kedaluwarsa'): ?>
                                            Kedaluwarsa <?= htmlspecialchars($item['tanggal']) ?> · <?= htmlspecialchars($item['alasan']) ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Right: Status Pill & Action Buttons -->
                            <div class="flex items-center gap-3">
                                <?php if ($item['status'] === 'selesai'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#E6F4EA] text-[#137333]">
                                        Klaim berhasil
                                    </span>
                                <?php elseif ($item['status'] === 'ditolak'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#FCE8E6] text-[#C5221F]">
                                        Ditolak
                                    </span>
                                    <button onclick="ajukanKeberatan('<?= $item['kode_klaim'] ?>')" class="px-4 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-semibold text-slate-700 transition">
                                        Ajukan keberatan
                                    </button>
                                <?php elseif ($item['status'] === 'kedaluwarsa'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#F1F3F4] text-[#5F6368]">
                                        Kedaluwarsa
                                    </span>
                                    <button onclick="klaimLagi('<?= $item['nama_barang'] ?>')" class="px-4 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-semibold text-slate-700 transition">
                                        Klaim lagi
                                    </button>
                                <?php endif; ?>
                            </div>

                        </div>

                        <!-- Expanded Box Jejak Serah Terima (Untuk yang selesai) -->
                        <?php if (isset($item['jejak_serah_terima'])): ?>
                        <div class="mt-4 pt-4 border-t border-slate-100 bg-[#EBF2FC]/60 rounded-xl p-4 flex flex-col sm:flex-row gap-4 items-start">
                            <!-- Foto Serah Terima Placeholder -->
                            <div class="w-20 h-20 rounded-lg bg-[#C8D6E5] text-slate-600 text-[10px] font-medium flex items-center justify-center text-center p-2 flex-shrink-0">
                                Foto serah terima
                            </div>

                            <!-- Log Items -->
                            <div class="flex-1 text-xs space-y-1">
                                <div class="text-slate-700">
                                    <span class="font-bold text-slate-800">Jejak serah terima</span>
                                    <?= htmlspecialchars($item['jejak_serah_terima']['tanggal']) ?> · <?= htmlspecialchars($item['jejak_serah_terima']['detail_penyerahan']) ?>
                                </div>
                                <div class="text-slate-500">
                                    <?= htmlspecialchars($item['jejak_serah_terima']['foto_server']) ?>
                                </div>
                                <div class="text-slate-500">
                                    <?= htmlspecialchars($item['jejak_serah_terima']['pengajuan']) ?>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-blue-100/60 mt-2">
                                    Jejak ini hanya terlihat oleh kamu, petugas, dan admin. Keberatan dapat diajukan sampai <?= htmlspecialchars($item['jejak_serah_terima']['batas_keberatan']) ?>: 
                                    <a href="javascript:void(0)" onclick="ajukanKeberatan('<?= $item['kode_klaim'] ?>')" class="text-blue-600 font-semibold hover:underline">Ajukan keberatan</a>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        </section>

    </main>

    <!-- Client-side Interactive JavaScript -->
    <script>
        function downloadCode(kode) {
            alert('Mengunduh kode tiket klaim: ' + kode + '\n\nSilakan tunjukkan QR Code atau Kode ini ke petugas di Pos Satpam Gedung F.');
        }

        function cancelClaim(kode) {
            if (confirm('Apakah Anda yakin ingin membatalkan klaim dengan kode: ' + kode + '?')) {
                alert('Permintaan pembatalan klaim ' + kode + ' telah diproses.');
            }
        }

        function ajukanKeberatan(kode) {
            const alasan = prompt('Masukkan alasan keberatan untuk klaim ' + kode + ':');
            if (alasan) {
                alert('Keberatan Anda untuk klaim ' + kode + ' telah dikirim dan akan diverifikasi ulang oleh petugas.');
            }
        }

        function klaimLagi(barang) {
            if (confirm('Apakah Anda ingin mengajukan kembali klaim untuk barang: ' + barang + '?')) {
                alert('Mengarahkan ke form pengajuan klaim baru untuk ' + barang + '...');
            }
        }
    </script>
</body>
</html>
