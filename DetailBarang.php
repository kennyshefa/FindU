
<?php
session_start();
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

$url = [
    'beranda' => 'index.php',
    'cari'    => 'cari.php',
    'riwayat' => 'riwayat.php',
    'tentang' => 'tentang.php',
    'profil'  => 'profile.php',
    'klaim'   => 'KlaimBerhasil.php',
];
$user = $_SESSION['user'] ?? ['nama' => 'Hana'];

function e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function getBarang($id) {
    $data = [
        1 => [
            'id' => 1,
            'nama' => 'Dompet',
            'status' => 'Ditemukan',
            'deskripsi' => 'Dompet Kulit warna Coklat Tua',
            'kategori' => 'Alat Tulis',
            'lokasi' => 'Gedung F',
            'tanggal' => '20 November 2026',
            'simpan' => 'Pos Satpam Gedung F',
            'jam' => 'Setiap hari, 07.00-18.00 WIB',
            'foto' => 'assets/Dompet.png',
            'sedang_diklaim' => false,
        ],
    ];
    return $data[$id] ?? null;
}

$id = (int)($_GET['id'] ?? 1);
$barang = getBarang($id);
if (!$barang) {
    http_response_code(404);
    exit('Barang tidak ditemukan.');
}

$klaimSaya = null;
foreach ($_SESSION['klaim'] ?? [] as $kode => $k) {
    if ($k['barang_id'] === $id && $k['status'] === 'menunggu') {
        $klaimSaya = $kode;
        break;
    }
}

$bisaKlaim = $barang['status'] === 'Ditemukan' && !$barang['sedang_diklaim'] && !$klaimSaya;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('Token tidak valid.');
    }
    if ($bisaKlaim) {
        $kode = 'FU-' . date('ym') . '-' . str_pad((string)random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        $_SESSION['klaim'][$kode] = [
            'kode' => $kode,
            'barang_id' => $id,
            'nama' => $barang['nama'],
            'foto' => $barang['foto'],
            'status' => 'menunggu',
            'berlaku' => strtotime('+7 days'),
            'jejak' => [[time(), 'Klaim diajukan, kode ' . $kode . ' dibuat']],
        ];
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        header('Location: ' . $url['klaim'] . '?kode=' . urlencode($kode));
        exit;
    }
}

$adaFoto = $barang['foto'] !== '' && file_exists(__DIR__ . '/' . $barang['foto']);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($barang['nama']) ?> – FindU</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box}
body{margin:0;font-family:'Poppins',system-ui,sans-serif;background:#DCE6FB;color:#111827}
a{text-decoration:none}
.wrap{max-width:1280px;margin:0 auto;padding:24px 20px 56px}
.nav{background:#fff;border-radius:14px;padding:14px 28px;display:flex;align-items:center;gap:24px;box-shadow:0 2px 10px rgba(30,64,175,.1)}
.logo{display:flex;align-items:center}
.logo img{display:block;height:36px;width:auto}
.links{flex:1;display:flex;justify-content:center;gap:40px}
.links a{color:#9CA3AF;font-weight:500;font-size:17px}
.links a.on{color:#F0951B}
.user{background:#F0951B;color:#fff;font-weight:500;font-size:17px;padding:12px 28px;border-radius:10px}
.back{display:inline-flex;align-items:center;gap:8px;color:#2563EB;font-size:17px;margin:28px 0 16px}
.layout{display:grid;grid-template-columns:minmax(0,1fr) 410px;gap:32px;align-items:start}
.col{display:flex;flex-direction:column;gap:26px}
.card{background:#fff;border-radius:14px;padding:18px;box-shadow:0 2px 12px rgba(30,64,175,.1)}
.foto{display:block;width:100%;aspect-ratio:2.3/1;object-fit:cover;border-radius:10px;background:#CBD5E1}
.nofoto{display:flex;align-items:center;justify-content:center;color:#64748B;font-size:14px}
.tag{display:inline-block;font-size:14px;font-weight:600;padding:6px 14px;border-radius:99px;margin-top:16px}
.tag.ok{background:#D7F5EE;color:#0FA58B}
.tag.wt{background:#FEF3C7;color:#92400E}
h1{margin:4px 0 6px;font-size:36px;font-weight:600;line-height:1.2}
.desc{margin:0 0 6px;font-size:14px;font-weight:500;color:#9CA3AF}
.card h2{margin:0 0 18px;font-size:24px;font-weight:600}
.info{padding:12px}
.kv{display:grid;grid-template-columns:190px 1fr;gap:12px;padding:12px 0;font-size:16px;align-items:center}
.kv span{color:#9CA3AF;font-weight:500}
.kv b{font-weight:600}
.kv small{display:block;font-size:11px;font-weight:500;color:#9CA3AF;margin-top:2px}
.klaim{padding:28px 30px}
.klaim h3{margin:0 0 6px;font-size:21px;font-weight:600}
.klaim p{margin:0 0 18px;font-size:14px;font-weight:500;color:#9CA3AF;line-height:1.5}
.btn-klaim{display:block;width:100%;border:0;border-radius:10px;background:#2563EB;color:#fff;font:500 16px 'Poppins',sans-serif;padding:15px;text-align:center;cursor:pointer;min-height:48px}
.btn-klaim:hover{background:#1D4ED8}
.btn-klaim[disabled]{background:#CBD5E1;color:#64748B;cursor:not-allowed}
.btn-lihat{background:#fff;color:#2563EB;border:1.5px solid #2563EB}
.btn-lihat:hover{background:#EFF4FF}
.step{display:flex;gap:16px;align-items:center;margin-top:18px;font-size:14px;font-weight:500;color:#6B7280;line-height:1.5}
.step i{width:36px;height:36px;border-radius:50%;background:#FFEFE0;color:#F0951B;font:600 13px 'Poppins',sans-serif;display:flex;align-items:center;justify-content:center;flex:none;font-style:normal}
.note{background:#FFEFDB;border-radius:14px;padding:22px 26px;text-align:center;font-size:15px;line-height:1.6;color:#374151}
@media(max-width:960px){
.layout{grid-template-columns:1fr}
.foto{aspect-ratio:16/9}
}
@media(max-width:640px){
.wrap{padding:16px 14px 40px}
.nav{padding:12px 16px;gap:12px;flex-wrap:wrap}
.logo img{height:30px}
.user{margin-left:auto;padding:9px 18px;font-size:15px}
.links{order:3;flex:0 0 100%;justify-content:space-between;gap:8px;overflow-x:auto}
.links a{font-size:15px;white-space:nowrap}
.back{font-size:15px;margin:20px 0 12px}
.foto{aspect-ratio:4/3}
h1{font-size:28px}
.card h2{font-size:20px}
.kv{grid-template-columns:120px 1fr;font-size:14px}
.klaim{padding:22px 18px}
.note{padding:18px;font-size:14px}
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

  <a class="back" href="<?= e($url['beranda']) ?>">← Kembali ke Beranda</a>

  <div class="layout">
    <div class="col">
      <div class="card">
        <?php if ($adaFoto): ?>
          <img class="foto" src="<?= e($barang['foto']) ?>" alt="<?= e($barang['nama']) ?>">
        <?php else: ?>
          <div class="foto nofoto">Foto barang</div>
        <?php endif; ?>
        <span class="tag ok"><?= e($barang['status']) ?></span>
        <h1><?= e($barang['nama']) ?></h1>
        <p class="desc"><?= e($barang['deskripsi']) ?></p>
      </div>

      <div class="card info">
        <h2>Informasi Barang</h2>
        <div class="kv"><span>Kategori</span><b><?= e($barang['kategori']) ?></b></div>
        <div class="kv"><span>Ditemukan di</span><b><?= e($barang['lokasi']) ?></b></div>
        <div class="kv"><span>Tanggal ditemukan</span><b><?= e($barang['tanggal']) ?></b></div>
        <div class="kv"><span>Disimpan di</span><b><?= e($barang['simpan']) ?><small><?= e($barang['jam']) ?></small></b></div>
        <div class="kv"><span>Status</span>
          <b><span class="tag <?= $bisaKlaim ? 'ok' : 'wt' ?>" style="margin:0;font-size:13px;color:inherit"><?= $bisaKlaim ? 'Tersedia untuk diklaim' : 'Sedang diklaim' ?></span></b>
        </div>
      </div>
    </div>

    <aside class="col">
      <div class="card klaim">
        <h3>Ini Barangmu?</h3>
        <p>Tekan klaim untuk dapatkan kode, lalu datang ke Pos Satpam</p>
        <?php if ($bisaKlaim): ?>
          <form method="post" onsubmit="return confirm('Buat kode klaim untuk barang ini?')">
            <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
            <button class="btn-klaim" type="submit">Klaim Barang ini</button>
          </form>
        <?php elseif ($klaimSaya): ?>
          <a class="btn-klaim btn-lihat" href="<?= e($url['klaim']) ?>?kode=<?= urlencode($klaimSaya) ?>" style="display:block;line-height:18px;padding:15px">Lihat klaim saya</a>
        <?php else: ?>
          <button class="btn-klaim" type="button" disabled>Sedang diklaim</button>
        <?php endif; ?>
        <div class="step"><i>1</i><div>Kode klaim dibuat setelah kamu menekan tombol klaim</div></div>
        <div class="step"><i>2</i><div>Datang ke pos satpam dalam 7 hari dengan KTM</div></div>
        <div class="step"><i>3</i><div>Satpam memverifikasi, lalu menyerahkan barang</div></div>
      </div>
      <div class="note">Satu barang hanya punya satu klaim aktif. Jika sedang diklaim orang lain, tombol berubah menjadi Sedang diklaim. Klaim palsu dapat membuat akunmu dibatasi.</div>
    </aside>
  </div>
</div>
</body>
</html>
