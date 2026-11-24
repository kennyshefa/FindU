<?php
session_start();

$currentPage = basename($_SERVER['PHP_SELF']);
$namaUser = $_SESSION['user']['nama'] ?? 'Nadia';

$url = [
  'beranda' => 'dashboard2.php',
  'cari' => 'search.php',
  'riwayat' => 'Riwayat.php',
  'tentang' => 'tentang-kami.php',
  'detail' => 'DetailBarang.php',
  'profil' => 'Profile.php',
  'hilang' => 'upload-barang.php',
  'ditemukan' => 'post-barang-ditemukan.php',
];

function e($val) {
  return htmlspecialchars((string)$val, ENT_QUOTES, 'UTF-8');
}

function aktif($halaman, $sekarang) {
  return strtolower($halaman) === strtolower($sekarang) ? 'aktif' : '';
}

$statistik = [
  ['10', 'Fitur tersedia'],
  ['4', 'Alur utama'],
  ['6', 'Anggota tim'],
  ['1', 'Tempat terpusat'],
];

$fitur = [
  ['fa-right-to-bracket', 'Login & Register', 'Masuk atau buat akun dengan email dan password.'],
  ['fa-table-columns', 'Dashboard', 'Lihat daftar barang hilang dan ditemukan lengkap dengan foto, kategori, lokasi, dan tanggal.'],
  ['fa-user', 'Profile', 'Kelola informasi akun dan lihat riwayat laporan yang pernah dibuat.'],
  ['fa-box-open', 'Lapor Barang Hilang', 'Buat laporan kehilangan dengan deskripsi, lokasi, tanggal, dan foto.'],
  ['fa-hand-holding-heart', 'Lapor Barang Ditemukan', 'Bantu pemilik mengenali barangnya dengan melaporkan temuanmu.'],
  ['fa-magnifying-glass', 'Cari & Filter', 'Cari lewat kata kunci, lalu saring berdasarkan kategori atau status.'],
  ['fa-clipboard-check', 'Klaim Barang', 'Ajukan klaim kepemilikan beserta informasi pendukung untuk diverifikasi.'],
  ['fa-tags', 'Status Barang', 'Pantau perkembangan laporan lewat badge status berwarna.'],
  ['fa-bell', 'Riwayat', 'Dapat kabar saat status berubah atau klaimmu direspons.'],
];

$langkah = [
  ['1', 'Buat laporan', 'Laporkan barang hilang atau ditemukan, lengkap dengan foto.'],
  ['2', 'Cari barangmu', 'Gunakan pencarian dan filter kategori atau status.'],
  ['3', 'Ajukan klaim', 'Kirim klaim kepemilikan dengan informasi pendukung.'],
  ['4', 'Verifikasi & serah terima', 'Barang diserahkan setelah pengecekan, statusnya terbarui otomatis.'],
];

$statusList = [
  ['Menunggu', 's-tunggu'],
  ['Diproses', 's-proses'],
  ['Ditemukan', 's-temu'],
  ['Diklaim', 's-klaim'],
  ['Selesai', 's-selesai'],
];

$tim = [
  ['RI', 'Rohmaniyyatul Islamiyyah', 'Status Barang • Profile', 'biru'],
  ['KSD', 'Kenny Shefa Dinarti', 'Detail & Klaim Barang • Login • Riwayat', 'kuning'],
  ['NNAR', 'Nadilia Nur Awwalia R', 'Post Barang Ditemukan • Dashboard', 'biru'],
  ['HPGP', 'Hana Paulina G. Purba', 'Post Barang Hilang • Login', 'kuning'],
  ['SZPC', 'Syahda Zaahirah Putri C.', 'Pencarian & Filter • Register', 'biru'],
  ['PP', 'Primada Purnama', 'Dashboard', 'kuning'],
];

$teknologi = ['Laravel', 'PHP', 'HTML / CSS', 'JavaScript', 'Figma', 'GitHub'];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tentang Kami – FindU</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
* { box-sizing: border-box; }
body { margin: 0; font-family: 'Poppins', sans-serif; background: #DCE6FB; color: #111827; line-height: 1.6; }
a { text-decoration: none; }
.bungkus { max-width: 1200px; margin: 0 auto; padding: 24px 20px 56px; }

.nav { background: #fff; border-radius: 14px; padding: 14px 28px; display: flex; align-items: center; gap: 24px; box-shadow: 0 2px 10px rgba(30,64,175,.1); }
.logo { display: flex; align-items: center; }
.logo img { display: block; height: 36px; width: auto; }
.menu { flex: 1; display: flex; justify-content: center; gap: 36px; }
.menu a { color: #9CA3AF; font-weight: 500; font-size: 16px; transition: color .2s; }
.menu a:hover { color: #F97316; }
.menu a.aktif,
.menu a:active { color: #F97316; font-weight: 600; }
.btn-user { background: #F0951B; color: #fff; font-weight: 500; font-size: 16px; padding: 10px 24px; border-radius: 10px; }
.btn-user:hover { background: #D97E0D; }

.bagian { margin-top: 32px; }
.hero h1 { margin: 0 0 8px; font-size: 34px; font-weight: 700; }
.hero h1 span, .judul span { color: #2563EB; }
.hero p { margin: 0 0 22px; max-width: 600px; font-size: 14px; color: #4B5563; }
.judul { margin: 0 0 4px; font-size: 22px; font-weight: 600; }
.sub { margin: 0 0 16px; font-size: 13px; color: #6B7280; }

.kartu { background: #fff; border-radius: 14px; padding: 20px; box-shadow: 0 2px 12px rgba(30,64,175,.08); }
.kartu h4 { margin: 0 0 6px; font-size: 15px; font-weight: 600; }
.kartu p { margin: 0; font-size: 13px; color: #6B7280; }

.grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; }
.grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
.grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }

.stat { text-align: center; }
.stat h3 { margin: 0 0 4px; font-size: 24px; color: #2563EB; }

.label { display: inline-block; padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 600; margin-bottom: 10px; }
.merah { background: #FEE2E2; color: #DC2626; }
.hijau { background: #D7F5EE; color: #0FA58B; }

.ikon { width: 36px; height: 36px; border-radius: 10px; background: #EFF6FF; color: #2563EB; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; }
.langkah { display: flex; gap: 12px; align-items: flex-start; }
.no { width: 32px; height: 32px; border-radius: 50%; background: #FFEFE0; color: #F0951B; font-weight: 700; font-size: 13px; display: flex; align-items: center; justify-content: center; flex: none; }

.status-bar { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; margin-top: 14px; font-size: 12.5px; color: #4B5563; }
.pill { padding: 4px 12px; border-radius: 99px; font-size: 12px; font-weight: 600; }
.s-tunggu { background: #FEF3C7; color: #92400E; }
.s-proses { background: #DBEAFE; color: #1D4ED8; }
.s-temu { background: #D7F5EE; color: #0FA58B; }
.s-klaim { background: #E0E7FF; color: #4338CA; }
.s-selesai { background: #D1FAE5; color: #047857; }

.avatar { width: 40px; height: 40px; border-radius: 50%; color: #fff; font-weight: 700; font-size: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
.biru { background: #2563EB; }
.kuning { background: #F0951B; }
.dosen { margin: 12px 0 0; font-size: 12px; color: #6B7280; }

.tags { display: flex; flex-wrap: wrap; gap: 10px; }
.tag { background: #fff; padding: 7px 15px; border-radius: 99px; font-size: 12.5px; font-weight: 600; box-shadow: 0 2px 8px rgba(30,64,175,.08); }

.catatan { background: #FFEFDB; border-radius: 14px; padding: 18px 22px; font-size: 13.5px; color: #374151; }

.cta { background: linear-gradient(135deg, #2563EB, #1E40AF); border-radius: 18px; padding: 34px 20px; text-align: center; color: #fff; }
.cta h2 { margin: 0 0 6px; font-size: 22px; }
.cta p { margin: 0 0 22px; font-size: 13.5px; color: #DBEAFE; }
.cta-btn { display: flex; justify-content: center; gap: 14px; flex-wrap: wrap; }
.btn-putih { background: #fff; color: #2563EB; font-weight: 600; font-size: 14px; padding: 12px 22px; border-radius: 10px; }
.btn-oranye { background: #F0951B; color: #fff; font-weight: 600; font-size: 14px; padding: 12px 22px; border-radius: 10px; }

footer { text-align: center; margin-top: 34px; font-size: 12.5px; color: #6B7280; }

@media (max-width: 900px) {
  .grid-4, .grid-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 640px) {
  .nav { padding: 12px 16px; gap: 10px; flex-wrap: wrap; }
  .menu { order: 3; flex: 0 0 100%; justify-content: space-between; gap: 10px; overflow-x: auto; }
  .menu a { font-size: 14px; white-space: nowrap; }
  .grid-4, .grid-3, .grid-2 { grid-template-columns: 1fr; }
}
</style>
</head>
<body>
<div class="bungkus">

  <nav class="nav">
    <a class="logo" href="<?= e($url['beranda']) ?>">
      <img src="assets/logo.png" alt="Logo FindU">
    </a>
    <div class="menu">
      <a href="<?= e($url['beranda']) ?>" class="<?= aktif($url['beranda'], $currentPage) ?>">Beranda</a>
      <a href="<?= e($url['cari']) ?>" class="<?= aktif($url['cari'], $currentPage) ?>">Cari</a>
      <a href="<?= e($url['riwayat']) ?>" class="<?= aktif($url['riwayat'], $currentPage) ?>">Riwayat</a>
      <a href="<?= e($url['tentang']) ?>" class="<?= aktif($url['tentang'], $currentPage) || $currentPage === 'index.php' ? 'aktif' : '' ?>">Tentang Kami</a>
    </div>
    <a class="btn-user" href="<?= e($url['profil']) ?>"><?= e($namaUser) ?></a>
  </nav>

  <section class="bagian hero">
    <h1>Yuk Kenali <span>FindU</span></h1>
    <p>Website Lost &amp; Found untuk membantu mahasiswa melaporkan, mencari, dan menemukan kembali barang yang hilang maupun ditemukan di lingkungan kampus.</p>
    <div class="grid-4">
      <?php foreach ($statistik as [$angka, $ket]): ?>
        <div class="kartu stat">
          <h3><?= e($angka) ?></h3>
          <p><?= e($ket) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="bagian">
    <h2 class="judul">Kenapa <span>FindU</span> ada?</h2>
    <p class="sub">Dari informasi yang tercecer menjadi satu sistem yang rapi.</p>
    <div class="grid-2">
      <div class="kartu">
        <span class="label merah">Masalah</span>
        <h4>Informasi mudah tertumpuk</h4>
        <p>Barang yang tertinggal sulit dikembalikan karena pencarian hanya lewat bertanya ke orang lain atau grup chat yang pesannya cepat tenggelam.</p>
      </div>
      <div class="kartu">
        <span class="label hijau">Solusi</span>
        <h4>Satu media terpusat</h4>
        <p>FindU mengumpulkan laporan barang hilang dan ditemukan dalam satu website agar lebih mudah dicari, dipantau, dan dikembalikan ke pemiliknya.</p>
      </div>
    </div>
  </section>

  <section class="bagian">
    <h2 class="judul">Apa yang bisa kamu <span>lakukan</span></h2>
    <p class="sub">Fitur yang tersedia di FindU.</p>
    <div class="grid-4">
      <?php foreach ($fitur as [$ikon, $judul, $desk]): ?>
        <div class="kartu">
          <div class="ikon"><i class="fa-solid <?= e($ikon) ?>"></i></div>
          <h4><?= e($judul) ?></h4>
          <p><?= e($desk) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="bagian">
    <h2 class="judul">Cara <span>kerjanya</span></h2>
    <p class="sub">Dari melapor sampai barang kembali.</p>
    <div class="grid-3">
      <?php foreach ($langkah as [$no, $judul, $desk]): ?>
        <div class="kartu langkah">
          <div class="no"><?= e($no) ?></div>
          <div>
            <h4><?= e($judul) ?></h4>
            <p><?= e($desk) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="status-bar">
      <span>Status Barang:</span>
      <?php foreach ($statusList as [$label, $kelas]): ?>
        <span class="pill <?= e($kelas) ?>"><?= e($label) ?></span>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="bagian">
    <h2 class="judul">Tim <span>Pengembang</span></h2>
    <p class="sub">Mahasiswa Pendidikan Teknologi Informasi, Fakultas Ilmu Komputer, Universitas Brawijaya</p>
    <div class="grid-4">
      <?php foreach ($tim as [$inisial, $nama, $peran, $warna]): ?>
        <div class="kartu">
          <div class="avatar <?= e($warna) ?>"><?= e($inisial) ?></div>
          <h4><?= e($nama) ?></h4>
          <p><?= e($peran) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="dosen">Dosen pengampu: Ir. Satriawan Rasyid Purnama, S.T., M.T. • Asisten: Yustina Agustina E. S. &amp; Zahra Amelia</p>
  </section>

  <section class="bagian">
    <h2 class="judul">Dibangun <span>dengan</span></h2>
    <div class="tags" style="margin-top:12px">
      <?php foreach ($teknologi as $tech): ?>
        <span class="tag"><?= e($tech) ?></span>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="bagian">
    <h2 class="judul">Batasan <span>layanan</span></h2>
    <div class="catatan" style="margin-top:12px">
      FindU tidak mencakup pelacakan lokasi barang lewat GPS, layanan pengiriman barang, atau integrasi otomatis dengan sistem keamanan kampus. Verifikasi kepemilikan dan penyerahan barang tetap memerlukan konfirmasi.
    </div>
  </section>

  <section class="bagian">
    <div class="cta">
      <h2>Kehilangan atau menemukan sesuatu?</h2>
      <p>Laporkan sekarang dan bantu barang kembali ke pemiliknya.</p>
      <div class="cta-btn">
        <a class="btn-putih" href="<?= e($url['hilang']) ?>">Laporkan Barang Hilang</a>
        <a class="btn-oranye" href="<?= e($url['ditemukan']) ?>">Laporkan Barang Ditemukan</a>
      </div>
    </div>
  </section>

  <footer>&copy; <?= date('Y') ?> FindU • Pemrograman Web C • Universitas Brawijaya</footer>

</div>
<script>
document.querySelectorAll('.menu a').forEach(a => {
  a.addEventListener('click', () => {
    document.querySelectorAll('.menu a').forEach(x => x.classList.remove('aktif'));
    a.classList.add('aktif');
  });
});
</script>
</body>
</html>