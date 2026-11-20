<?php
// laporan-berhasil.php — menampilkan laporan yang baru disimpan
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$id = $_GET['id'] ?? '';
$laporan = null;
if (preg_match('/^[a-f0-9]{8}$/', $id)) {
    $fileJson = __DIR__ . '/data/laporan.json';
    if (is_file($fileJson)) {
        $semua = json_decode(file_get_contents($fileJson), true);
        if (is_array($semua)) {
            foreach ($semua as $row) {
                if (($row['id'] ?? '') === $id) { $laporan = $row; break; }
            }
        }
    }
}
if (!$laporan) {
    header('Location: post-barang-ditemukan.php');
    exit;
}

$bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$t = DateTime::createFromFormat('Y-m-d', $laporan['tanggal']);
$tanggalIndo = $t ? ((int)$t->format('j') . ' ' . $bulan[(int)$t->format('n')] . ' ' . $t->format('Y')) : $laporan['tanggal'];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FindU – Laporan Berhasil Dikirim</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<style>
:root{--blue:#2563EB;--ink:#0F172A;--muted:#475569;--line:#E2E8F0;--soft:#E8F0FE}
*{box-sizing:border-box}
body{margin:0;font-family:'Inter',system-ui,sans-serif;background:#fff;color:var(--ink)}
a{color:var(--blue);text-decoration:none}a:hover{color:#1E40AF}
.page{padding:24px;display:flex;flex-direction:column;gap:28px;min-height:100vh}
.hero{background:var(--soft);border:1px solid #D5E3FB;border-radius:20px;padding:20px 28px 36px;display:flex;flex-direction:column;gap:36px}
.nav{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:12px 20px;background:#fff;border-radius:12px}
.logo{display:flex;align-items:center;gap:8px;font-weight:800;font-size:22px}
.logo b{color:var(--blue)}
.menu{display:flex;gap:36px;flex-wrap:wrap;font-size:14px;font-weight:600}
.menu a{color:var(--ink)}.menu a.active{color:#B45309}
.user{height:40px;padding:0 20px;border:0;border-radius:10px;background:#FFF1DB;color:#92400E;font:600 14px inherit;font-family:inherit;cursor:pointer}
.hero-text{display:flex;flex-direction:column;gap:12px;padding:0 12px}
h1{margin:0;font-size:44px;line-height:1.15;font-weight:800}
h1 span{color:var(--blue)}
.hero-text p{margin:0;color:var(--muted);font-size:16px;max-width:600px;line-height:1.5}
.layout{display:flex;gap:28px;flex-wrap:wrap;align-items:flex-start;width:100%}
.card{background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 2px 10px rgba(15,23,42,.06)}
form{flex:2 1 560px;min-width:0;padding:32px;display:flex;flex-direction:column;gap:24px}
aside{flex:1 1 280px;min-width:0;display:flex;flex-direction:column;gap:20px}
.field{display:flex;flex-direction:column;gap:8px}
.row{display:flex;gap:20px;flex-wrap:wrap}.row .field{flex:1 1 240px}
label,.lbl{font-weight:600;font-size:14px}
input[type=text],input[type=date],select,textarea{width:100%;border:1px solid #CBD5E1;border-radius:10px;padding:0 14px;font:400 15px 'Inter',sans-serif;background:#fff;color:var(--ink)}
input[type=text],input[type=date],select{height:48px}
textarea{padding:12px 14px;resize:vertical}
input:focus,select:focus,textarea:focus,button:focus-visible{outline:2px solid var(--blue);outline-offset:2px}
.drop{position:relative;border:2px dashed #93B4F0;border-radius:12px;background:#F3F7FF;min-height:200px;display:flex;align-items:center;justify-content:center;text-align:center;overflow:hidden}
.drop.drag{background:#E0EBFF;border-color:var(--blue)}
.drop-empty{display:flex;flex-direction:column;align-items:center;gap:8px;padding:32px 16px}
.drop-empty small{color:var(--muted);font-size:13px}
.pick{margin-top:4px;height:40px;padding:0 18px;border:1px solid var(--blue);background:#fff;color:var(--blue);border-radius:10px;font:600 14px 'Inter',sans-serif;cursor:pointer}
.drop img{display:none;width:100%;max-height:320px;object-fit:contain;background:#fff}
.drop.has img{display:block}.drop.has .drop-empty{display:none}
.remove{display:none;position:absolute;top:10px;right:10px;height:36px;padding:0 14px;border:0;border-radius:8px;background:rgba(15,23,42,.82);color:#fff;font:600 13px 'Inter',sans-serif;cursor:pointer}
.drop.has .remove{display:block}
.err{color:#B91C1C;font-size:13px;min-height:16px}
.actions{display:flex;justify-content:flex-end;gap:12px;flex-wrap:wrap;padding-top:20px;border-top:1px solid var(--line)}
.btn{height:48px;padding:0 30px;border-radius:10px;font:600 15px 'Inter',sans-serif;cursor:pointer}
.btn.ghost{border:1px solid var(--blue);background:#fff;color:var(--blue)}
.btn.main{border:0;background:var(--blue);color:#fff}.btn.main:hover{background:#1D4ED8}
.pv{padding:20px;display:flex;flex-direction:column;gap:14px}
.pv h2,.tips h2{margin:0;font-size:16px;font-weight:700}
.item{border:1px solid var(--line);border-radius:12px;padding:10px;display:flex;flex-direction:column;gap:10px}
.thumb{height:140px;border-radius:8px;background:#E2E8F0;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:13px;overflow:hidden}
.thumb img{width:100%;height:100%;object-fit:cover;display:none}
.thumb.has img{display:block}.thumb.has span{display:none}
.tags{display:flex;gap:6px;flex-wrap:wrap}
.badge{background:#DDF5F0;color:#0F766E;font-size:11px;font-weight:600;padding:4px 10px;border-radius:999px}
.badge.cat{background:#EEF2FF;color:#3730A3}
.name{font-weight:700;font-size:15px;overflow-wrap:anywhere}
.meta{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);overflow-wrap:anywhere}
.tips{background:#F3F7FF;border:1px solid #D5E3FB;border-radius:16px;padding:20px;display:flex;flex-direction:column;gap:10px}
.tips h2{color:#1E3A8A}
.tips ul{margin:0;padding-left:18px;display:flex;flex-direction:column;gap:8px;font-size:13px;color:#334155;line-height:1.5}
footer{border-top:1px solid var(--line);padding-top:16px;display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;font-size:12px;color:var(--muted)}
.toast{position:fixed;left:50%;bottom:24px;transform:translateX(-50%);background:#0F766E;color:#fff;padding:14px 22px;border-radius:12px;font-weight:600;font-size:14px;display:none;z-index:10}
.toast.show{display:block}
@media(max-width:640px){h1{font-size:30px}.menu{gap:18px}form{padding:20px}}
.fe{display:flex;align-items:center;gap:6px;color:#B91C1C;font-size:13px;font-weight:500}
.fe[hidden]{display:none}
.invalid{border:1.5px solid #B91C1C!important}
.drop.invalid{border:2px dashed #B91C1C!important;background:#FEF2F2}
.banner{display:flex;gap:12px;align-items:flex-start;background:#FEF2F2;border:1px solid #FCA5A5;border-radius:12px;padding:14px 16px;color:#7F1D1D}
.banner[hidden]{display:none}
.banner strong{display:block;font-size:15px}.banner span{font-size:14px}
.ok{width:100%;max-width:640px;margin:0 auto;background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 2px 10px rgba(15,23,42,.06);padding:40px 32px;display:flex;flex-direction:column;align-items:center;gap:20px;text-align:center}
.ok h1{font-size:32px}
.ok p{margin:0;color:var(--muted);font-size:16px;line-height:1.5;max-width:460px}
.check{width:72px;height:72px;border-radius:50%;background:#DDF5F0;display:flex;align-items:center;justify-content:center}
.sum{width:100%;max-width:420px;border:1px solid var(--line);border-radius:12px;padding:12px;display:flex;gap:14px;text-align:left;align-items:center}
.sum .pic{flex:none;width:88px;height:88px;border-radius:8px;background:#E2E8F0;overflow:hidden;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:12px}
.sum .pic img{width:100%;height:100%;object-fit:cover}
.sum .info{display:flex;flex-direction:column;gap:6px;min-width:0}
.btns{display:flex;gap:12px;flex-wrap:wrap;justify-content:center;padding-top:8px}
.btns a.btn{display:inline-flex;align-items:center}
.btns a.btn.main{color:#fff}
.hero.ok-hero{padding-bottom:56px;gap:48px}

</style>
</head>
<body>
<div class="page">
<div class="hero ok-hero">
<header class="nav">
<div class="logo">
<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.4" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
<span>Find<b>U</b></span>
</div>
<nav class="menu"><a href="dashboard.php">Beranda</a><a href="#">Cari</a><a href="post-barang-ditemukan.php" class="active">Upload</a><a href="#">Tentang Kami</a></nav>
<button type="button" class="user">Nadia ▾</button>
</header>
<main class="ok">
<div class="check"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#0F766E" stroke-width="2.4" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></div>
<h1>Laporan berhasil <span>dikirim</span></h1>
<p>Terima kasih sudah membantu. Laporanmu sudah tersimpan dan tampil di Barang Terbaru. Kami akan memberi tahu kamu lewat Notifikasi saat ada yang mengajukan klaim.</p>
<div class="sum">
<div class="pic"><img src="uploads/<?= e($laporan['foto']) ?>" alt="Foto barang yang dilaporkan"></div>
<div class="info">
<div class="tags"><span class="badge">Ditemukan</span><span class="badge cat"><?= e($laporan['kategori']) ?></span></div>
<div class="name"><?= e($laporan['nama']) ?></div>
<div class="meta"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg><span><?= e($laporan['lokasi']) ?></span></div>
<div class="meta"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><span><?= e($tanggalIndo) ?></span></div>
</div>
</div>
<div class="btns">
<a class="btn main" href="#">Lihat laporan saya</a>
<a class="btn ghost" href="post-barang-ditemukan.php">Laporkan barang lain</a>
</div>
<a href="dashboard.php" style="font-size:14px;font-weight:600">Kembali ke Beranda</a>
</main>
</div>
<footer>
<span>FindU — saling berbagi, saling menemukan barang di sekitar UB.</span>
<a href="#" style="font-weight:600">Butuh bantuan?</a>
</footer>
</div>
</body>
</html>
