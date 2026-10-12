<?php

// Folder tempat file ini berada (otomatis, bekerja di localhost/subfolder maupun hosting)
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';

// Tautan aset + ?v=waktu-ubah-file agar browser selalu memuat versi terbaru
function asset(string $file): string
{
    global $basePath;
    $path = __DIR__ . '/' . $file;
    $ver  = is_file($path) ? filemtime($path) : time();
    return htmlspecialchars($basePath . $file . '?v=' . $ver, ENT_QUOTES, 'UTF-8');
}

// Escape output
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// Data pengguna (ganti dengan data dari session / database)
$user = [
    'nama'    => 'Nama Pengguna',
    'depan'   => 'Naya',
    'inisial' => 'RI',
    'email'   => 'email@student.ub.ac.id',
    'telepon' => '+62 xxx xxxx xxxx',
    'nim'     => 'XXXXXXXXXXXXXXX',
    'prodi'   => 'Pendidikan Teknologi Informasi (PTI)',
    'fakultas'=> 'Ilmu Komputer',
    'angkatan'=> '2025',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Saya — FindU</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= asset('style.css') ?>">
</head>
<body>

<!--  HEADER / NAVBAR  -->
<header class="site-header">
    <div class="site-header__panel">
        <nav class="navbar" aria-label="Navigasi utama">

            <a href="<?= e($basePath) ?>index.php" class="brand" aria-label="FindU - beranda">
                <svg width="34" height="38" viewBox="0 0 30 34" aria-hidden="true">
                    <path d="M15 1C7.8 1 2 6.7 2 13.8 2 23 15 33 15 33s13-10 13-19.2C28 6.7 22.2 1 15 1z" fill="#1d4fd8"/>
                    <circle cx="15" cy="13.5" r="5" fill="#fff"/>
                </svg>
                <span>FindU</span>
            </a>

            <button class="navbar__toggle" id="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="nav-links">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
            </button>

            <ul class="navbar__links" id="nav-links">
                <li><a href="<?= e($basePath) ?>dashboard1.php" class="is-current" aria-current="page">Beranda</a></li>
                <li><a href="<?= e($basePath) ?>cari.php">Cari</a></li>
                <li><a href="<?= e($basePath) ?>upload.php">Upload</a></li>
                <li><a href="<?= e($basePath) ?>tentang.php">Tentang Kami</a></li>
            </ul>

            <div class="user-menu">
                <button class="user-menu__btn" id="user-btn" type="button" aria-haspopup="true" aria-expanded="false">
                    <?= e($user['depan']) ?> <span class="caret" aria-hidden="true"></span>
                </button>
                <ul class="user-menu__list" id="user-list" hidden>
                    <li><a href="<?= e($basePath) ?>profile.php">Profil Saya</a></li>
                    <li><a href="<?= e($basePath) ?>../Login/login.php">Keluar</a></li>
                </ul>
            </div>

        </nav>
    </div>
</header>

<!--  KONTEN  -->
<main class="layout">

    <!--  KOLOM KIRI  -->
    <section class="card profile" aria-label="Profil pengguna">

        <div class="cover">
            <div class="avatar" id="avatar"><?= e($user['inisial']) ?></div>

            <div class="cover__info">
                <h1 data-bind="nama"><?= e($user['nama']) ?></h1>
                <p class="cover__mail">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22 6 12 13 2 6"/></svg>
                    <?= e($user['email']) ?>
                </p>
                <span class="chip">Mahasiswa</span>
            </div>

            <button type="button" class="btn-edit" data-open="modal-edit">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                Edit Profil
            </button>
        </div>

        <!-- Tabs -->
        <div class="tabs" role="tablist" aria-label="Bagian profil">
            <button class="tab is-active" role="tab" id="tab-akun"       aria-controls="panel-akun"       aria-selected="true"  data-tab="akun">Informasi Akun</button>
            <button class="tab"           role="tab" id="tab-laporan"    aria-controls="panel-laporan"    aria-selected="false" data-tab="laporan">Riwayat Laporan</button>
            <button class="tab"           role="tab" id="tab-klaim"      aria-controls="panel-klaim"      aria-selected="false" data-tab="klaim">Klaim Saya</button>
            <button class="tab"           role="tab" id="tab-notifikasi" aria-controls="panel-notifikasi" aria-selected="false" data-tab="notifikasi">Notifikasi</button>
        </div>

        <div class="profile__body">

            <!-- Panel: Informasi Akun -->
            <div class="panel" id="panel-akun" role="tabpanel" aria-labelledby="tab-akun">

                <div class="box">
                    <h2 class="box__title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Data Diri
                    </h2>
                    <dl class="info">
                        <div class="info__row"><dt>Nama Lengkap</dt><dd data-bind="nama"><?= e($user['nama']) ?></dd></div>
                        <div class="info__row"><dt>Email</dt><dd><?= e($user['email']) ?></dd></div>
                        <div class="info__row"><dt>Nomor Telepon</dt><dd data-bind="telepon"><?= e($user['telepon']) ?></dd></div>
                        <div class="info__row"><dt>NIM</dt><dd><?= e($user['nim']) ?></dd></div>
                        <div class="info__row"><dt>Program Studi</dt><dd><?= e($user['prodi']) ?></dd></div>
                        <div class="info__row"><dt>Fakultas</dt><dd><?= e($user['fakultas']) ?></dd></div>
                        <div class="info__row"><dt>Angkatan</dt><dd><?= e($user['angkatan']) ?></dd></div>
                    </dl>
                </div>

                <div class="box box--password">
                    <div class="box__text">
                        <h2 class="box__title box__title--plain">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><rect x="9" y="9" width="6" height="6"/></svg>
                            Ubah Password
                        </h2>
                        <p>Pastikan password kamu kuat dan mudah diingat.</p>
                    </div>
                    <button type="button" class="btn-outline" data-open="modal-password">Ganti Password</button>
                </div>
            </div>

            <!-- Panel: Riwayat Laporan -->
            <div class="panel" id="panel-laporan" role="tabpanel" aria-labelledby="tab-laporan" hidden>
                <ul class="list">
                    <li class="list__item">
                        <div class="list__text"><strong>Dompet kulit warna coklat</strong><small>Perpustakaan Pusat • 8 Okt 2026</small></div>
                        <span class="status status--wait">Dicari</span>
                    </li>
                    <li class="list__item">
                        <div class="list__text"><strong>Kunci motor Honda</strong><small>Parkiran Gedung F • 3 Okt 2026</small></div>
                        <span class="status status--ok">Ditemukan</span>
                    </li>
                    <li class="list__item">
                        <div class="list__text"><strong>Botol minum Tupperware</strong><small>Kantin Fakultas • 27 Sep 2026</small></div>
                        <span class="status status--ok">Ditemukan</span>
                    </li>
                </ul>
            </div>

            <!-- Panel: Klaim Saya -->
            <div class="panel" id="panel-klaim" role="tabpanel" aria-labelledby="tab-klaim" hidden>
                <ul class="list">
                    <li class="list__item">
                        <div class="list__text"><strong>Kunci motor Honda</strong><small>Diajukan 9 Okt 2026</small></div>
                        <span class="status status--wait">Menunggu verifikasi</span>
                    </li>
                </ul>
            </div>

            <!-- Panel: Notifikasi -->
            <div class="panel" id="panel-notifikasi" role="tabpanel" aria-labelledby="tab-notifikasi" hidden>
                <ul class="list">
                    <li class="list__item is-new"><div class="list__text"><strong>Klaim kamu sedang diverifikasi</strong><small>2 jam lalu</small></div><span class="dot" aria-label="Belum dibaca"></span></li>
                    <li class="list__item is-new"><div class="list__text"><strong>Ada barang mirip dompet coklatmu</strong><small>5 jam lalu</small></div><span class="dot" aria-label="Belum dibaca"></span></li>
                    <li class="list__item is-new"><div class="list__text"><strong>Laporan "Kunci motor Honda" ditemukan</strong><small>Kemarin</small></div><span class="dot" aria-label="Belum dibaca"></span></li>
                    <li class="list__item"><div class="list__text"><strong>Laporanmu sudah dipublikasikan</strong><small>3 hari lalu</small></div></li>
                    <li class="list__item"><div class="list__text"><strong>Selamat datang di FindU</strong><small>1 minggu lalu</small></div></li>
                </ul>
            </div>

        </div>
    </section>

    <!--  KOLOM KANAN  -->
    <aside class="side">

        <section class="card quick" aria-labelledby="quick-title">
            <h2 class="card__title" id="quick-title">Aksi Cepat</h2>
            <ul class="quick__list">
                <li>
                    <button type="button" class="quick__item" data-action="modal:modal-edit">
                        <span class="quick__ic">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                        </span>
                        <span class="quick__text"><strong>Edit Profil</strong><small>Ubah data diri dan informasi akun</small></span>
                        <svg class="quick__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="quick__item" data-action="tab:laporan">
                        <span class="quick__ic">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="2"/><line x1="8" y1="8" x2="16" y2="8"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="8" y1="16" x2="16" y2="16"/></svg>
                        </span>
                        <span class="quick__text"><strong>Lihat Riwayat Laporan</strong><small>Cek barang yang pernah kamu laporkan</small></span>
                        <svg class="quick__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="quick__item" data-action="tab:klaim">
                        <span class="quick__ic">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="2"/><line x1="8" y1="8" x2="16" y2="8"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="8" y1="16" x2="16" y2="16"/></svg>
                        </span>
                        <span class="quick__text"><strong>Klaim Saya</strong><small>Pantau status klaim barang</small></span>
                        <svg class="quick__arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </li>
            </ul>
        </section>

        <section class="card summary" aria-labelledby="summary-title">
            <h2 class="card__title card__title--plain" id="summary-title">Ringkasan Aktivitas</h2>
            <div class="summary__grid">
                <div class="stat stat--blue">
                    <b data-count="3">3</b>
                    <span>Total Laporan</span>
                </div>
                <div class="stat stat--green">
                    <b data-count="2">2</b>
                    <span>Barang Ditemukan</span>
                </div>
                <div class="stat stat--purple">
                    <b data-count="1">1</b>
                    <span>Klaim Aktif</span>
                </div>
                <div class="stat stat--peach">
                    <b data-count="5">5</b>
                    <span>Notifikasi</span>
                </div>
            </div>
        </section>

    </aside>
</main>

<!--  MODAL: EDIT PROFIL  -->
<div class="modal" id="modal-edit" hidden>
    <div class="modal__box" role="dialog" aria-modal="true" aria-labelledby="t-edit">
        <button class="modal__close" type="button" data-close aria-label="Tutup">&times;</button>
        <h2 id="t-edit">Edit Profil</h2>

        <form id="form-edit" novalidate>
            <label class="field">
                <span>Nama lengkap</span>
                <input type="text" name="nama" value="<?= e($user['nama']) ?>" required>
                <em class="field__err"></em>
            </label>
            <label class="field">
                <span>Nomor telepon</span>
                <input type="tel" name="telepon" value="<?= e($user['telepon']) ?>" placeholder="+62 812 3456 7890" required>
                <em class="field__err"></em>
            </label>
            <label class="field">
                <span>Email (tidak bisa diubah)</span>
                <input type="email" value="<?= e($user['email']) ?>" disabled>
            </label>

            <div class="modal__actions">
                <button type="button" class="btn btn--ghost" data-close>Batal</button>
                <button type="submit" class="btn btn--solid">Simpan perubahan</button>
            </div>
        </form>
    </div>
</div>

<!--  MODAL: GANTI PASSWORD  -->
<div class="modal" id="modal-password" hidden>
    <div class="modal__box" role="dialog" aria-modal="true" aria-labelledby="t-pass">
        <button class="modal__close" type="button" data-close aria-label="Tutup">&times;</button>
        <h2 id="t-pass">Ganti Password</h2>

        <form id="form-password" novalidate>
            <label class="field">
                <span>Password lama</span>
                <input type="password" name="lama" autocomplete="current-password" required>
                <em class="field__err"></em>
            </label>
            <label class="field">
                <span>Password baru</span>
                <input type="password" name="baru" id="pw-new" autocomplete="new-password" minlength="8" required>
                <div class="meter" aria-hidden="true"><i id="pw-meter"></i></div>
                <small class="hint" id="pw-hint">Minimal 8 karakter, kombinasikan huruf dan angka.</small>
                <em class="field__err"></em>
            </label>
            <label class="field">
                <span>Ulangi password baru</span>
                <input type="password" name="ulang" id="pw-repeat" autocomplete="new-password" required>
                <em class="field__err"></em>
            </label>

            <div class="modal__actions">
                <button type="button" class="btn btn--ghost" data-close>Batal</button>
                <button type="submit" class="btn btn--solid">Simpan password</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast -->
<div class="toast" id="toast" role="status" aria-live="polite"></div>

<!-- JS -->
<script src="<?= asset('script.js') ?>"></script>
</body>
</html>
