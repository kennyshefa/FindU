<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FindU – Laporan Berhasil Dikirim</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap">
<style>
:root{--blue:#2563EB;--ink:#0F172A;--muted:#475569;--line:#E2E8F0;--soft:#E8F0FE}
*{box-sizing:border-box}
body{margin:0;font-family:'Poppins',system-ui,sans-serif;background:#fff;color:var(--ink)}
a{color:var(--blue);text-decoration:none}a:hover{color:#1E40AF}
.page{padding:24px;display:flex;flex-direction:column;gap:28px;min-height:100vh}
.hero{background:var(--soft);border:1px solid #D5E3FB;border-radius:20px;padding:20px 28px 36px;display:flex;flex-direction:column;gap:36px}
.nav{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:12px 24px;background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(15,23,42,.04)}
.logo{display:flex;align-items:center}
.logo img{height:34px;width:auto;display:block}
.menu{display:flex;gap:36px;flex-wrap:wrap;font-size:14px;font-weight:600}
.menu a{color:#94A3B8}.menu a:hover,.menu a.active{color:var(--ink)}
.user{height:40px;padding:0 24px;border:0;border-radius:10px;background:#F59E0B;color:#fff;font:600 14px 'Poppins',sans-serif;cursor:pointer}
.btn{height:48px;padding:0 30px;border-radius:10px;font:600 14px 'Poppins',sans-serif;cursor:pointer}
.btn.ghost{border:1px solid var(--blue);background:#fff;color:var(--blue)}
.btn.main{border:0;background:var(--blue);color:#fff}.btn.main:hover{background:#1D4ED8}
.tags{display:flex;gap:6px;flex-wrap:wrap}
.badge{background:#DDF5F0;color:#0F766E;font-size:11px;font-weight:600;padding:4px 10px;border-radius:999px}
.badge.cat{background:#EEF2FF;color:#3730A3}
.name{font-weight:700;font-size:15px;overflow-wrap:anywhere}
.meta{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);overflow-wrap:anywhere}
footer{border-top:1px solid var(--line);padding-top:16px;display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;font-size:12px;color:var(--muted)}
.ok{width:100%;max-width:640px;margin:0 auto;background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 2px 10px rgba(15,23,42,.06);padding:40px 32px;display:flex;flex-direction:column;align-items:center;gap:20px;text-align:center}
.ok h1{margin:0;font-size:32px;line-height:1.15;font-weight:800}
.ok h1 span{color:var(--blue)}
.ok p{margin:0;color:var(--muted);font-size:15px;line-height:1.5;max-width:460px}
.check{width:72px;height:72px;border-radius:50%;background:#DDF5F0;display:flex;align-items:center;justify-content:center}
.sum{width:100%;max-width:420px;border:1px solid var(--line);border-radius:12px;padding:12px;display:flex;gap:14px;text-align:left;align-items:center}
.sum .pic{flex:none;width:88px;height:88px;border-radius:8px;background:#E2E8F0;overflow:hidden;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:12px}
.sum .pic img{width:100%;height:100%;object-fit:cover}
.sum .info{display:flex;flex-direction:column;gap:6px;min-width:0}
.btns{display:flex;gap:12px;flex-wrap:wrap;justify-content:center;padding-top:8px}
.btns a.btn{display:inline-flex;align-items:center}
.btns a.btn.main{color:#fff}
.hero.ok-hero{padding-bottom:56px;gap:48px}
@media(max-width:640px){.menu{gap:18px}}
</style>
</head>
<body>
<div class="page">
<div class="hero ok-hero">
<header class="nav">
<a href="{{ route('dashboard') }}" class="logo">
<img src="{{ asset('img/FindU.png') }}" alt="FindU">
</a>
<nav class="menu"><a href="{{ route('dashboard') }}">Beranda</a><a href="#">Cari</a><a href="#">Riwayat</a><a href="#">Tentang Kami</a></nav>
<button type="button" class="user">{{ Auth::user()->name ?? 'Nadia' }}</button>
</header>
<main class="ok">
<div class="check"><svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#0F766E" stroke-width="2.4" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg></div>
<h1>Laporan berhasil <span>dikirim</span></h1>
<p>Terima kasih sudah membantu. Laporanmu sudah tersimpan dan tampil di Barang Terbaru. Kami akan memberi tahu kamu lewat Notifikasi saat ada yang mengajukan klaim.</p>
<div class="sum">
<div class="pic"><img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto barang yang dilaporkan"></div>
<div class="info">
<div class="tags"><span class="badge">Ditemukan</span><span class="badge cat">{{ $laporan->kategori }}</span></div>
<div class="name">{{ $laporan->nama }}</div>
<div class="meta"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg><span>{{ $laporan->lokasi }}</span></div>
<div class="meta"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><span>{{ $laporan->tanggal->locale('id')->translatedFormat('j F Y') }}</span></div>
</div>
</div>
<div class="btns">
<a class="btn main" href="#">Lihat laporan saya</a>
<a class="btn ghost" href="{{ route('barang.ditemukan.create') }}">Laporkan barang lain</a>
</div>
<a href="{{ route('dashboard') }}" style="font-size:14px;font-weight:600">Kembali ke Beranda</a>
</main>
</div>
</div>
</body>
</html>