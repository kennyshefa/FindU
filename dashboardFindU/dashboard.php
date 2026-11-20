<?php
// dashboard.php — halaman Beranda FindU
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function waktuLalu($ts) {
    $d = time() - $ts;
    if ($d < 60) return 'Baru saja';
    if ($d < 3600) return floor($d / 60) . ' menit yang lalu';
    if ($d < 86400) return floor($d / 3600) . ' jam yang lalu';
    return floor($d / 86400) . ' hari yang lalu';
}

// Filter dari alamat (GET)
$status = $_GET['status'] ?? 'semua';
if (!in_array($status, ['semua', 'hilang', 'ditemukan'], true)) $status = 'semua';
$q = trim($_GET['q'] ?? '');
$urut = (($_GET['urut'] ?? 'terbaru') === 'terlama') ? 'terlama' : 'terbaru';
$semua = isset($_GET['semua']);

function link_ke($ubah) {
    global $status, $q, $urut, $semua;
    $p = ['status' => $status, 'q' => $q, 'urut' => $urut];
    if ($semua) $p['semua'] = 1;
    foreach ($ubah as $k => $v) {
        if ($v === null) unset($p[$k]); else $p[$k] = $v;
    }
    if (($p['status'] ?? '') === 'semua') unset($p['status']);
    if (($p['q'] ?? '') === '') unset($p['q']);
    if (($p['urut'] ?? '') === 'terbaru') unset($p['urut']);
    return 'dashboard.php' . ($p ? '?' . http_build_query($p) : '');
}

// Contoh barang (foto: taruh file di folder img/ dengan nama sesuai)
$barang = [
    ['nama' => 'Dompet',      'status' => 'ditemukan', 'lokasi' => 'Perpus UB',      'kategori' => 'Dompet & Tas',      'ts' => time() - 4 * 86400, 'foto' => 'img/dompet.jpg'],
    ['nama' => 'Kunci Motor', 'status' => 'ditemukan', 'lokasi' => 'Parkiran FILKOM', 'kategori' => 'Kunci & Kendaraan', 'ts' => time() - 2 * 3600,  'foto' => 'img/kunci.jpg'],
    ['nama' => 'Tumbler Biru', 'status' => 'hilang',    'lokasi' => 'Gedung FISIP',    'kategori' => 'Botol & Alat Makan', 'ts' => time() - 5 * 3600,  'foto' => 'img/tumbler.jpg'],
    ['nama' => 'Kacamata',    'status' => 'ditemukan', 'lokasi' => 'Kantin FEB',      'kategori' => 'Aksesori',          'ts' => time() - 86400,     'foto' => 'img/kacamata.jpg'],
];

// Laporan yang dikirim lewat form ikut tampil
$fileJson = __DIR__ . '/data/laporan.json';
if (is_file($fileJson)) {
    $tersimpan = json_decode(file_get_contents($fileJson), true);
    if (is_array($tersimpan)) {
        foreach ($tersimpan as $r) {
            $barang[] = [
                'nama' => $r['nama'] ?? '',
                'status' => 'ditemukan',
                'lokasi' => $r['lokasi'] ?? '',
                'kategori' => $r['kategori'] ?? '',
                'ts' => strtotime($r['dibuat'] ?? '') ?: time(),
                'foto' => 'uploads/' . ($r['foto'] ?? ''),
            ];
        }
    }
}

// Terapkan filter, pencarian, dan urutan
$barang = array_values(array_filter($barang, function ($b) use ($status, $q) {
    if ($status !== 'semua' && $b['status'] !== $status) return false;
    if ($q !== '' && stripos($b['nama'] . ' ' . $b['lokasi'] . ' ' . $b['kategori'], $q) === false) return false;
    return true;
}));
usort($barang, function ($a, $b) use ($urut) {
    return $urut === 'terbaru' ? $b['ts'] <=> $a['ts'] : $a['ts'] <=> $b['ts'];
});
if (!$semua) $barang = array_slice($barang, 0, 8);
$adaIlustrasi = is_file(__DIR__ . '/img/ilustrasi.png');
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FindU – Beranda</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<style>
:root{--blue:#2563EB;--ink:#0F172A;--muted:#475569;--line:#E2E8F0;--soft:#E8F0FE}
*{box-sizing:border-box}
body{margin:0;font-family:'Inter',system-ui,sans-serif;background:#fff;color:var(--ink)}
a{color:var(--blue);text-decoration:none}a:hover{color:#1E40AF}
button,input,select{font-family:inherit}
:focus-visible{outline:2px solid var(--blue);outline-offset:2px}
.page{padding:24px;display:flex;flex-direction:column;gap:32px;min-height:100vh}
.hero{background:var(--soft);border:1px solid #D5E3FB;border-radius:20px;padding:20px 28px 48px;display:flex;flex-direction:column;gap:48px}
.nav{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:12px 24px;background:#fff;border-radius:12px}
.logo{display:flex;align-items:center;gap:8px;font-weight:800;font-size:24px;color:var(--ink)}
.logo b{color:var(--blue)}
.menu{display:flex;gap:44px;flex-wrap:wrap;font-size:14px;font-weight:600}
.menu a{color:var(--ink)}.menu a.active{color:#B45309}
.user{height:40px;padding:0 20px;border:0;border-radius:10px;background:#FFF1DB;color:#92400E;font-size:14px;font-weight:600;cursor:pointer}
.hero-body{display:flex;gap:40px;flex-wrap:wrap;align-items:center;justify-content:space-between;padding:0 12px}
.left{flex:1 1 460px;min-width:0;display:flex;flex-direction:column;gap:16px}
.hi{color:var(--blue);font-size:16px;font-weight:500}
h1{margin:0;font-size:52px;line-height:1.1;font-weight:800}
h1 span{color:var(--blue);display:block}
.left p{margin:0;color:var(--muted);font-size:15px;line-height:1.55;max-width:480px}
.search{display:flex;align-items:center;gap:8px;background:#fff;border:1px solid var(--line);border-radius:12px;padding:6px 6px 6px 16px;max-width:560px}
.search input{flex:1;min-width:0;border:0;outline:0;font-size:14px;height:40px;color:var(--ink);background:transparent}
.search input::placeholder{color:#64748B}
.search:focus-within{outline:2px solid var(--blue)}
.search button{height:40px;padding:0 22px;border:0;border-radius:10px;background:var(--blue);color:#fff;font-size:14px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:8px}
.hint{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted)}
.right{flex:0 1 400px;min-width:260px;display:flex;flex-direction:column;gap:14px}
.ilus{border-radius:14px;overflow:hidden;background:#DCE8FB;line-height:0}
.ilus img,.ilus svg{width:100%;height:auto;display:block}
.right h2{margin:0;font-size:16px;font-weight:700;display:flex;align-items:center;gap:6px}
.right h2 i{color:var(--blue);font-style:normal;font-weight:700}
.right p{margin:0;color:var(--muted);font-size:13px;line-height:1.5}
.cta{display:flex;align-items:center;justify-content:center;height:42px;border-radius:10px;font-size:13px;font-weight:600;border:1px solid var(--blue)}
.cta.fill{background:var(--blue);color:#fff}.cta.fill:hover{background:#1D4ED8;color:#fff}
.cta.line{background:#fff;color:var(--blue)}
.sec-head{display:flex;justify-content:space-between;align-items:flex-end;gap:16px;flex-wrap:wrap;padding:0 4px}
.sec-head h2{margin:0;font-size:22px;font-weight:800}
.sec-head p{margin:4px 0 0;color:var(--muted);font-size:13px}
.all{font-size:14px;font-weight:600}
.tools{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:0 4px}
.pills{display:flex;gap:10px;flex-wrap:wrap}
.pill{padding:6px 16px;border-radius:999px;font-size:12px;font-weight:600;border:1px solid #CBD5E1;color:var(--muted);background:#fff}
.pill.on{background:var(--blue);border-color:var(--blue);color:#fff}
.pill.teal{border-color:#5EEAD4;color:#0F766E}
.pill.teal.on{background:#0F766E;border-color:#0F766E;color:#fff}
.sort select{height:34px;border:1px solid var(--line);border-radius:8px;padding:0 10px;font-size:12px;background:#fff;color:var(--ink)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:20px;padding:0 4px}
.card{background:#fff;border:1px solid var(--line);border-radius:12px;box-shadow:0 2px 10px rgba(15,23,42,.08);padding:10px;display:flex;flex-direction:column;gap:10px}
.thumb{aspect-ratio:16/10;border-radius:8px;background:#E2E8F0;overflow:hidden;display:flex;align-items:center;justify-content:center;color:#64748B}
.thumb img{width:100%;height:100%;object-fit:cover;display:block}
.badge{align-self:flex-start;font-size:11px;font-weight:600;padding:4px 12px;border-radius:999px;margin-top:4px}
.badge.ditemukan{background:#DDF5F0;color:#0F766E}
.badge.hilang{background:#FFEDD5;color:#9A3412}
.name{font-weight:700;font-size:15px;overflow-wrap:anywhere}
.meta{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);overflow-wrap:anywhere}
.kosong{grid-column:1/-1;text-align:center;color:var(--muted);padding:40px 0;font-size:14px}
footer{margin-top:auto;border-top:1px solid var(--line);padding-top:16px;display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;font-size:12px;color:var(--muted)}
@media(max-width:640px){h1{font-size:36px}.menu{gap:20px}}
</style>
</head>
<body>
<div class="page">

<div class="hero">
<header class="nav">
<div class="logo">
<svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.6" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
<span>Find<b>U</b></span>
</div>
<nav class="menu">
<a href="dashboard.php" class="active">Beranda</a>
<a href="dashboard.php?semua=1#barang-terbaru">Cari</a>
<a href="post-barang-ditemukan.php">Upload</a>
<a href="#">Tentang Kami</a>
</nav>
<button type="button" class="user">Nadia ▾</button>
</header>

<div class="hero-body">
<div class="left">
<div class="hi">Selamat datang kembali, Nadia!</div>
<h1>Temukan Barangmu <span>Kembali</span></h1>
<p>Bantu sesama dengan melaporkan barang hilang atau menemukan barang yang bukan milikmu.</p>
<form class="search" method="get" action="dashboard.php#barang-terbaru" role="search">
<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
<input type="text" name="q" value="<?= e($q) ?>" placeholder="Cari nama barang, lokasi, atau kategori..." aria-label="Cari barang">
<button type="submit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>Cari</button>
</form>
<div class="hint"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>Cari barang hilang &amp; ditemukan di sekitar UB</div>
</div>

<div class="right">
<div class="ilus">
<?php if ($adaIlustrasi): ?>
<img src="img/ilustrasi.png" alt="Ilustrasi dua orang mengembalikan barang">
<?php else: ?>
<svg viewBox="0 0 400 190" role="img" aria-label="Ilustrasi dua orang mengembalikan barang"><rect width="400" height="190" fill="#DCE8FB"/><rect x="20" y="100" width="40" height="90" fill="#C3D6F5"/><rect x="70" y="80" width="50" height="110" fill="#B5CBF0"/><rect x="290" y="90" width="45" height="100" fill="#C3D6F5"/><rect x="345" y="110" width="40" height="80" fill="#B5CBF0"/><circle cx="165" cy="70" r="14" fill="#F2C9A5"/><rect x="148" y="86" width="34" height="62" rx="10" fill="#2563EB"/><rect x="150" y="146" width="12" height="40" rx="5" fill="#1E3A8A"/><rect x="168" y="146" width="12" height="40" rx="5" fill="#1E3A8A"/><circle cx="240" cy="72" r="14" fill="#F2C9A5"/><rect x="223" y="88" width="34" height="60" rx="10" fill="#F5A524"/><rect x="225" y="146" width="12" height="40" rx="5" fill="#334155"/><rect x="243" y="146" width="12" height="40" rx="5" fill="#334155"/><rect x="190" y="112" width="40" height="28" rx="4" fill="#C98A4B"/><path d="M200 40s10-9 10-17a10 10 0 1 0-20 0c0 8 10 17 10 17z" fill="#2563EB"/><circle cx="200" cy="23" r="3.5" fill="#fff"/></svg>
<?php endif; ?>
</div>
<h2><i>+</i> Punya kabar barang?</h2>
<p>Buat laporan agar barang lebih cepat kembali ke pemiliknya.</p>
<a class="cta fill" href="#">Laporkan Barang Hilang</a>
<a class="cta line" href="post-barang-ditemukan.php">Laporkan Barang Ditemukan</a>
</div>
</div>
</div>

<section id="barang-terbaru" style="display:flex;flex-direction:column;gap:18px">
<div class="sec-head">
<div>
<h2>Barang Terbaru</h2>
<p>Mungkin barang yang kamu cari ada di sini.</p>
</div>
<a class="all" href="<?= e(link_ke(['semua' => 1])) ?>#barang-terbaru">Lihat Semua →</a>
</div>

<div class="tools">
<div class="pills">
<a class="pill<?= $status === 'semua' ? ' on' : '' ?>" href="<?= e(link_ke(['status' => 'semua'])) ?>#barang-terbaru">Semua</a>
<a class="pill<?= $status === 'hilang' ? ' on' : '' ?>" href="<?= e(link_ke(['status' => 'hilang'])) ?>#barang-terbaru">Hilang</a>
<a class="pill teal<?= $status === 'ditemukan' ? ' on' : '' ?>" href="<?= e(link_ke(['status' => 'ditemukan'])) ?>#barang-terbaru">Ditemukan</a>
</div>
<form class="sort" method="get" action="dashboard.php#barang-terbaru">
<?php if ($status !== 'semua'): ?><input type="hidden" name="status" value="<?= e($status) ?>"><?php endif; ?>
<?php if ($q !== ''): ?><input type="hidden" name="q" value="<?= e($q) ?>"><?php endif; ?>
<?php if ($semua): ?><input type="hidden" name="semua" value="1"><?php endif; ?>
<select name="urut" aria-label="Urutkan" onchange="this.form.submit()">
<option value="terbaru"<?= $urut === 'terbaru' ? ' selected' : '' ?>>Terbaru</option>
<option value="terlama"<?= $urut === 'terlama' ? ' selected' : '' ?>>Terlama</option>
</select>
</form>
</div>

<div class="grid">
<?php if (!$barang): ?>
<div class="kosong">Belum ada barang yang cocok dengan pencarianmu.</div>
<?php endif; ?>
<?php foreach ($barang as $b): ?>
<article class="card">
<div class="thumb">
<?php if (is_file(__DIR__ . '/' . $b['foto'])): ?>
<img src="<?= e($b['foto']) ?>" alt="Foto <?= e($b['nama']) ?>">
<?php else: ?>
<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="1.6" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2"/><path d="M21 16l-5-5-8 8"/></svg>
<?php endif; ?>
</div>
<span class="badge <?= e($b['status']) ?>"><?= $b['status'] === 'hilang' ? 'Hilang' : 'Ditemukan' ?></span>
<div class="name"><?= e($b['nama']) ?></div>
<div class="meta"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg><?= e($b['lokasi']) ?></div>
<div class="meta"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><?= e(waktuLalu($b['ts'])) ?></div>
</article>
<?php endforeach; ?>
</div>
</section>

<footer>
<span>FindU — saling berbagi, saling menemukan barang di sekitar UB.</span>
<a href="#" style="font-weight:600">Butuh bantuan?</a>
</footer>
</div>
</body>
</html>
