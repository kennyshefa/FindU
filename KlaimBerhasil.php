<?php
session_start();

$url = [
    'beranda'   => 'index.php',
    'cari'      => 'cari.php',
    'riwayat'   => 'riwayat.php',
    'tentang'   => 'tentang.php',
    'profil'    => 'profile.php',
    'dashboard' => 'dashboard2.php',
];
$user = $_SESSION['user'] ?? ['nama' => 'Nadia'];

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function tanggal($t) {
    $b = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    return date('j', $t) . ' ' . $b[date('n', $t) - 1] . ' ' . date('Y', $t);
}
function waktu($t) {
    return tanggal($t) . ', ' . date('H.i', $t);
}

function getKlaim($kode) {
    if (isset($_SESSION['klaim'][$kode])) return $_SESSION['klaim'][$kode];
    if ($kode === 'FU-2611-0042') {
        return [
            'kode' => $kode,
            'nama' => 'Dompet',
            'foto' => 'assets/DompetKecil.png',
            'status' => 'selesai',
            'berlaku' => strtotime('2026-11-27'),
            'jejak' => [
                [strtotime('2026-11-20 14:32'), 'Diserahkan oleh [Nama Petugas] setelah 4 poin verifikasi terpenuhi'],
                [strtotime('2026-11-20 14:30'), 'Foto serah terima diambil dan dicatat server'],
                [strtotime('2026-11-20 10:15'), 'Klaim diajukan, kode FU-2611-0042 dibuat'],
            ],
        ];
    }
    return null;
}

$kode = $_GET['kode'] ?? 'FU-2611-0042';
$klaim = preg_match('/^FU-\d{4}-\d{4}$/', $kode) ? getKlaim($kode) : null;
if (!$klaim) {
    http_response_code(404);
    exit('Klaim tidak ditemukan.');
}

$selesai = $klaim['status'] === 'selesai';
$langkah = $selesai ? 4 : 1;
$labels = ['Dikonfirmasi', 'Ke pos satpam', 'Verifikasi', 'Diserahkan'];
$adaFoto = $klaim['foto'] !== '' && file_exists(__DIR__ . '/' . $klaim['foto']);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $selesai ? 'Klaim Berhasil' : 'Klaim Diajukan' ?> – FindU</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box}
body{margin:0;font-family:'Poppins',system-ui,sans-serif;background:#DCE6FB;color:#1F2937}
a{text-decoration:none}
.wrap{max-width:1280px;margin:0 auto;padding:24px 20px 56px}
.nav{background:#fff;border-radius:14px;padding:14px 28px;display:flex;align-items:center;gap:24px;box-shadow:0 2px 10px rgba(30,64,175,.1)}
.logo{display:flex;align-items:center}
.logo img{display:block;height:36px;width:auto}
.links{flex:1;display:flex;justify-content:center;gap:40px}
.links a{color:#9CA3AF;font-weight:500;font-size:17px}
.user{background:#F0951B;color:#fff;font-weight:500;font-size:17px;padding:12px 28px;border-radius:10px}
.frame{background:#E8EFFD;border-radius:18px;padding:36px 20px 64px;margin-top:20px}
.box{max-width:640px;margin:0 auto;background:#fff;border-radius:14px;padding:24px;text-align:center;box-shadow:0 2px 12px rgba(30,64,175,.08)}
.ic{width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px}
.ic.ok{background:#D1FAE5}
.ic.wt{background:#FEF3C7}
h1{margin:0 0 8px;font-size:34px;font-weight:700;letter-spacing:-.5px}
h1 span{color:#2563EB}
.sub{margin:0 auto 20px;font-size:15px;color:#4B5563;line-height:1.5}
.steps{display:flex;gap:8px;margin:0 0 18px;padding-bottom:18px;border-bottom:1px solid #E5E7EB}
.steps div{flex:1;font-size:12px;color:#4B5563}
.steps i{display:block;height:5px;border-radius:9px;background:#CBD5E1;margin-bottom:8px}
.steps .on i{background:#2563EB}
.item{display:flex;gap:16px;align-items:flex-start;text-align:left;padding-bottom:18px;border-bottom:1px solid #E5E7EB}
.pic{width:120px;height:120px;border-radius:10px;object-fit:cover;background:#CBD5E1;flex:none;display:flex;align-items:center;justify-content:center;font-size:11px;color:#64748B;text-align:center}
.tag{display:inline-block;font-size:12px;font-weight:600;padding:3px 12px;border-radius:99px;margin-top:6px}
.tag.ok{background:#D1FAE5;color:#047857}
.tag.wt{background:#FEF3C7;color:#92400E}
.item b.n{display:block;font-size:16px;font-weight:600;margin:8px 0 2px}
.meta{font-size:13px;color:#4B5563;line-height:1.6}
.jejak{text-align:left;padding-top:16px}
.jejak h2{margin:0 0 6px;font-size:16px;font-weight:600}
.jejak .r{border-top:1px solid #E5E7EB;padding:12px 0}
.jejak .r b{display:block;font-size:13px;font-weight:600;color:#374151}
.jejak .r span{font-size:14px;color:#4B5563}
.act{display:flex;justify-content:center;gap:12px;flex-wrap:wrap;margin-top:22px}
.btn{display:inline-flex;align-items:center;justify-content:center;border-radius:8px;padding:12px 20px;font:500 14px 'Poppins',sans-serif;min-height:48px}
.bp{background:#2563EB;color:#fff}
.bp:hover{background:#1D4ED8}
.bo{background:#fff;color:#1F2937;border:1px solid #CBD5E1}
.bo:hover{background:#F3F6FD}
@media(max-width:640px){
.wrap{padding:16px 14px 40px}
.nav{padding:12px 16px;gap:12px;flex-wrap:wrap}
.logo img{height:30px}
.user{margin-left:auto;padding:9px 18px;font-size:15px}
.links{order:3;flex:0 0 100%;justify-content:space-between;gap:8px;overflow-x:auto}
.links a{font-size:15px;white-space:nowrap}
.frame{padding:20px 10px 36px}
.box{padding:20px 16px}
h1{font-size:27px}
.steps div{font-size:10px}
.item{flex-direction:column;align-items:center;text-align:center}
.pic{width:100%;height:180px}
.act{flex-direction:column}
.btn{width:100%}
}
</style>
</head>
<body>
<div class="wrap">
  <nav class="nav" aria-label="Navigasi utama">
    <a class="logo" href="<?= e($url['beranda']) ?>">
      <img src="assets/logo.png" alt="Logo FindU">
    </a>
    <div class="links">
      <a href="<?= e($url['beranda']) ?>">Beranda</a>
      <a href="<?= e($url['cari']) ?>">Cari</a>
      <a href="<?= e($url['riwayat']) ?>">Riwayat</a>
      <a href="<?= e($url['tentang']) ?>">Tentang Kami</a>
    </div>
    <a class="user" href="<?= e($url['profil']) ?>"><?= e($user['nama']) ?></a>
  </nav>

  <div class="frame">
    <main class="box">
      <?php if ($selesai): ?>
        <div class="ic ok"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="3" aria-hidden="true"><path d="M5 12l5 5 9-10"/></svg></div>
        <h1>Klaim <span>Berhasil</span></h1>
        <p class="sub">Barang diserahkan setelah verifikasi petugas dan tercatat di riwayatmu.</p>
      <?php else: ?>
        <div class="ic wt"><svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#92400E" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
        <h1>Klaim <span>Diajukan</span></h1>
        <p class="sub">Datang ke Pos Satpam Gedung F sebelum <?= e(tanggal($klaim['berlaku'])) ?> dengan KTM dan tunjukkan kode klaim. Kode ini bukan bukti kepemilikan.</p>
      <?php endif; ?>

      <div class="steps">
        <?php foreach ($labels as $i => $teks): ?>
          <div class="<?= $i < $langkah ? 'on' : '' ?>"><i></i><?= e($teks) ?></div>
        <?php endforeach; ?>
      </div>

      <div class="item">
        <?php if ($adaFoto): ?>
          <img class="pic" src="<?= e($klaim['foto']) ?>" alt="<?= e($klaim['nama']) ?>">
        <?php else: ?>
          <div class="pic">Foto barang</div>
        <?php endif; ?>
        <div>
          <span class="tag <?= $selesai ? 'ok' : 'wt' ?>"><?= $selesai ? 'Selesai' : 'Menunggu verifikasi' ?></span>
          <b class="n"><?= e($klaim['nama']) ?></b>
          <div class="meta">Kode klaim: <strong><?= e($klaim['kode']) ?></strong></div>
        </div>
      </div>

      <section class="jejak">
        <h2>Jejak Serah Terima</h2>
        <?php foreach ($klaim['jejak'] as $j): ?>
          <div class="r"><b><?= e(waktu($j[0])) ?></b><span><?= e($j[1]) ?></span></div>
        <?php endforeach; ?>
      </section>

      <div class="act">
        <a class="btn bp" href="<?= e($url['dashboard']) ?>">Kembali ke Dashboard</a>
        <a class="btn bo" href="<?= e($url['riwayat']) ?>">Lihat Riwayat Klaim</a>
      </div>
    </main>
  </div>
</div>
</body>
</html>
