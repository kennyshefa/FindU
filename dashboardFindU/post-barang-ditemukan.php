<?php
// post-barang-ditemukan.php — form lapor barang ditemukan (validasi di server)
ob_start(); // supaya pengalihan halaman (header) tidak gagal karena ada output lebih dulu

$daftarKategori = ['Dompet & Tas', 'Elektronik', 'Kunci & Kendaraan', 'Dokumen & Kartu', 'Botol & Alat Makan', 'Aksesori', 'Lainnya'];
$label = ['foto' => 'foto', 'nama' => 'nama barang', 'kategori' => 'kategori', 'tanggal' => 'tanggal', 'lokasi' => 'lokasi', 'deskripsi' => 'deskripsi'];
$errors = [];
$gagal = '';
$old = ['nama' => '', 'kategori' => '', 'tanggal' => '', 'lokasi' => '', 'deskripsi' => ''];

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function panjang($s) { return function_exists('mb_strlen') ? mb_strlen($s) : strlen($s); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim($_POST[$k] ?? '');
    }

    // Validasi teks
    if ($old['nama'] === '') $errors['nama'] = 'Nama barang wajib diisi';
    elseif (panjang($old['nama']) > 60) $errors['nama'] = 'Nama barang maksimal 60 karakter';

    if (!in_array($old['kategori'], $daftarKategori, true)) $errors['kategori'] = 'Pilih salah satu kategori';

    $tgl = DateTime::createFromFormat('Y-m-d', $old['tanggal']);
    if ($old['tanggal'] === '') $errors['tanggal'] = 'Tanggal wajib diisi';
    elseif (!$tgl || $tgl->format('Y-m-d') !== $old['tanggal']) $errors['tanggal'] = 'Format tanggal tidak valid';
    elseif ($old['tanggal'] > date('Y-m-d')) $errors['tanggal'] = 'Tanggal tidak boleh di masa depan';

    if ($old['lokasi'] === '') $errors['lokasi'] = 'Lokasi ditemukan wajib diisi';
    elseif (panjang($old['lokasi']) > 80) $errors['lokasi'] = 'Lokasi maksimal 80 karakter';

    if (panjang($old['deskripsi']) > 500) $errors['deskripsi'] = 'Deskripsi maksimal 500 karakter';

    // Validasi foto
    $ext = '';
    $f = $_FILES['foto'] ?? null;
    if (!$f || $f['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['foto'] = 'Foto barang wajib diunggah';
    } elseif ($f['error'] !== UPLOAD_ERR_OK) {
        $errors['foto'] = ($f['error'] === UPLOAD_ERR_INI_SIZE || $f['error'] === UPLOAD_ERR_FORM_SIZE)
            ? 'Ukuran foto terlalu besar (maksimal 5 MB)' : 'Foto gagal diunggah, coba lagi';
    } elseif ($f['size'] > 5 * 1024 * 1024) {
        $errors['foto'] = 'Ukuran foto maksimal 5 MB';
    } else {
        $info = @getimagesize($f['tmp_name']);
        $mime = $info['mime'] ?? '';
        $boleh = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
        if (!isset($boleh[$mime])) $errors['foto'] = 'File harus berformat JPG atau PNG';
        else $ext = $boleh[$mime];
    }

    // Simpan jika semua valid
    if (!$errors) {
        $dirFoto = __DIR__ . '/uploads';
        $dirData = __DIR__ . '/data';
        if (!is_dir($dirFoto)) @mkdir($dirFoto, 0777, true);
        if (!is_dir($dirData)) @mkdir($dirData, 0777, true);

        $id = bin2hex(random_bytes(4));
        $namaFoto = $id . '.' . $ext;
        $fileJson = $dirData . '/laporan.json';

        if (!is_dir($dirFoto) || !is_dir($dirData)) {
            $gagal = 'Server tidak bisa membuat folder uploads dan data. Buat manual di samping file ini.';
        } elseif (!@move_uploaded_file($f['tmp_name'], $dirFoto . '/' . $namaFoto)) {
            $gagal = 'Foto gagal disimpan di server. Cek izin tulis folder uploads.';
        } else {
            $fp = @fopen($fileJson, 'c+');
            if (!$fp) {
                $gagal = 'Data gagal disimpan di server. Cek izin tulis folder data.';
            } else {
                flock($fp, LOCK_EX);
                $isi = stream_get_contents($fp);
                $semua = $isi ? json_decode($isi, true) : [];
                if (!is_array($semua)) $semua = [];
                $semua[] = [
                    'id' => $id,
                    'nama' => $old['nama'],
                    'kategori' => $old['kategori'],
                    'tanggal' => $old['tanggal'],
                    'lokasi' => $old['lokasi'],
                    'deskripsi' => $old['deskripsi'],
                    'foto' => $namaFoto,
                    'dibuat' => date('c'),
                ];
                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, json_encode($semua, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                fflush($fp);
                flock($fp, LOCK_UN);
                fclose($fp);

                // Berhasil: pindah ke halaman laporan berhasil
                $url = 'laporan-berhasil.php?id=' . $id;
                if (!headers_sent()) {
                    header('Location: ' . $url);
                } else {
                    echo '<meta http-equiv="refresh" content="0;url=' . $url . '">';
                }
                exit;
            }
        }
    }
}

function cls($k) { global $errors; return isset($errors[$k]) ? ' invalid' : ''; }
function pesan($k) {
    global $errors;
    if (!isset($errors[$k])) return;
    echo '<div class="fe" id="e-' . $k . '"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>' . e($errors[$k]) . '</div>';
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FindU – Post Barang Ditemukan</title>
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

<div class="hero">
<header class="nav">
<div class="logo">
<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.4" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
<span>Find<b>U</b></span>
</div>
<nav class="menu"><a href="dashboard.php">Beranda</a><a href="#">Cari</a><a href="post-barang-ditemukan.php" class="active">Upload</a><a href="#">Tentang Kami</a></nav>
<button type="button" class="user">Nadia ▾</button>
</header>
<div class="hero-text">
<a href="dashboard.php" style="font-size:14px;font-weight:500">← Kembali ke Beranda</a>
<h1>Laporkan Barang <span>Ditemukan</span></h1>
<p>Bantu sesama mengembalikan barang yang bukan milikmu. Isi detail barang selengkap mungkin agar pemiliknya mudah mengenali.</p>
</div>
</div>

<div class="layout">

<form id="form" class="card" method="post" action="post-barang-ditemukan.php" enctype="multipart/form-data" novalidate>

<?php if ($errors || $gagal): ?>
<div class="banner" role="alert">
<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.2" aria-hidden="true" style="flex:none;margin-top:1px"><path d="M12 3l10 18H2L12 3z"/><path d="M12 10v5M12 18v.5"/></svg>
<div><strong>Laporan belum bisa dikirim</strong><span><?php if ($gagal): ?><?= e($gagal) ?><?php else: ?><?= count($errors) ?> kolom masih perlu dilengkapi: <?= e(implode(', ', array_map(function ($k) use ($label) { return $label[$k]; }, array_keys($errors)))) ?>.<?php endif; ?></span></div>
</div>
<?php endif; ?>

<div class="field">
<span class="lbl" id="fotoLbl">Foto Barang</span>
<div class="drop<?= cls('foto') ?>" id="drop">
<div class="drop-empty">
<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2"/><path d="M21 16l-5-5-8 8"/></svg>
<strong>Unggah foto barang</strong>
<small>JPG atau PNG, maksimal 5 MB</small>
<input type="file" id="foto" name="foto" accept="image/png,image/jpeg" aria-labelledby="fotoLbl" style="font-size:13px;margin-top:4px;max-width:100%">
</div>
<img id="img" alt="Pratinjau foto yang dipilih">
<button type="button" class="remove" id="remove">Hapus foto</button>
</div>
<?php pesan('foto'); ?>
<div class="err" id="fotoErr" role="alert"></div>
</div>

<div class="field">
<label for="nama">Nama Barang</label>
<input id="nama" name="nama" type="text" maxlength="60" class="<?= trim(cls('nama')) ?>" value="<?= e($old['nama']) ?>" placeholder="Contoh: Dompet kulit warna cokelat">
<?php pesan('nama'); ?>
</div>

<div class="row">
<div class="field">
<label for="kategori">Kategori</label>
<select id="kategori" name="kategori" class="<?= trim(cls('kategori')) ?>">
<option value="">Pilih kategori</option>
<?php foreach ($daftarKategori as $k): ?>
<option value="<?= e($k) ?>"<?= $old['kategori'] === $k ? ' selected' : '' ?>><?= e($k) ?></option>
<?php endforeach; ?>
</select>
<?php pesan('kategori'); ?>
</div>
<div class="field">
<label for="tanggal">Tanggal Ditemukan</label>
<input id="tanggal" name="tanggal" type="date" max="<?= date('Y-m-d') ?>" class="<?= trim(cls('tanggal')) ?>" value="<?= e($old['tanggal']) ?>">
<?php pesan('tanggal'); ?>
</div>
</div>

<div class="field">
<label for="lokasi">Lokasi Ditemukan</label>
<input id="lokasi" name="lokasi" type="text" maxlength="80" class="<?= trim(cls('lokasi')) ?>" value="<?= e($old['lokasi']) ?>" placeholder="Contoh: Perpustakaan UB, lantai 2 dekat meja baca">
<?php pesan('lokasi'); ?>
</div>

<div class="field">
<label for="deskripsi">Deskripsi</label>
<textarea id="deskripsi" name="deskripsi" rows="4" maxlength="500" class="<?= trim(cls('deskripsi')) ?>" placeholder="Ciri-ciri barang: warna, merek, kondisi. Jangan tulis detail yang hanya diketahui pemilik asli."><?= e($old['deskripsi']) ?></textarea>
<?php pesan('deskripsi'); ?>
</div>

<div class="actions">
<a class="btn ghost" href="post-barang-ditemukan.php" style="display:inline-flex;align-items:center">Batal</a>
<button type="submit" class="btn main">Kirim Laporan</button>
</div>
</form>

<aside>
<div class="card pv">
<h2>Tampilan di Barang Terbaru</h2>
<div class="item">
<div class="thumb" id="thumb"><span>Foto barang</span><img id="pvImg" alt=""></div>
<div class="tags"><span class="badge">Ditemukan</span><span class="badge cat" id="pvKat" hidden></span></div>
<div class="name" id="pvNama">Nama barang</div>
<div class="meta">
<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
<span id="pvLokasi">Lokasi ditemukan</span></div>
<div class="meta">
<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
<span id="pvTanggal">Baru saja</span></div>
</div>
</div>
<div class="tips">
<h2>Tips melapor</h2>
<ul>
<li>Foto dari beberapa sisi agar mudah dikenali.</li>
<li>Tulis lokasi sespesifik mungkin.</li>
<li>Tutup info pribadi (nomor kartu, NIM) pada foto.</li>
<li>Simpan barang dengan aman sampai ada yang mengklaim.</li>
</ul>
</div>
</aside>

</div>

<footer>
<span>FindU — saling berbagi, saling menemukan barang di sekitar UB.</span>
<a href="#" style="font-weight:600">Butuh bantuan?</a>
</footer>
</div>

<script>
// JavaScript hanya untuk pratinjau langsung. Validasi dan penyimpanan dilakukan PHP di server.
const $ = id => document.getElementById(id);
let fotoUrl = null;

function tampilkanFoto(file){
  $('fotoErr').textContent = '';
  if (fotoUrl) URL.revokeObjectURL(fotoUrl);
  fotoUrl = URL.createObjectURL(file);
  $('img').src = fotoUrl;
  $('pvImg').src = fotoUrl;
  $('drop').classList.add('has');
  $('drop').classList.remove('invalid');
  $('thumb').classList.add('has');
  const e = $('e-foto'); if (e) e.hidden = true;
}
function hapusFoto(){
  if (fotoUrl) URL.revokeObjectURL(fotoUrl);
  fotoUrl = null;
  $('foto').value = '';
  $('img').removeAttribute('src');
  $('pvImg').removeAttribute('src');
  $('drop').classList.remove('has');
  $('thumb').classList.remove('has');
}
function cekFoto(file){
  if (!file) return;
  if (!/^image\/(png|jpeg)$/.test(file.type)) { $('fotoErr').textContent = 'File harus berformat JPG atau PNG.'; hapusFoto(); return; }
  if (file.size > 5 * 1024 * 1024) { $('fotoErr').textContent = 'Ukuran foto maksimal 5 MB.'; hapusFoto(); return; }
  tampilkanFoto(file);
}
$('foto').addEventListener('change', e => cekFoto(e.target.files[0]));
$('remove').addEventListener('click', hapusFoto);
['dragenter','dragover'].forEach(t => $('drop').addEventListener(t, e => { e.preventDefault(); $('drop').classList.add('drag'); }));
['dragleave','drop'].forEach(t => $('drop').addEventListener(t, e => { e.preventDefault(); $('drop').classList.remove('drag'); }));
$('drop').addEventListener('drop', e => {
  const file = e.dataTransfer.files[0];
  if (file) { try { $('foto').files = e.dataTransfer.files; } catch (err) {} cekFoto(file); }
});

function formatTanggal(t){
  return new Date(t + 'T00:00:00').toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'});
}
function updateText(){
  $('pvNama').textContent = $('nama').value.trim() || 'Nama barang';
  $('pvLokasi').textContent = $('lokasi').value.trim() || 'Lokasi ditemukan';
  const k = $('kategori').value;
  $('pvKat').textContent = k; $('pvKat').hidden = !k;
  const t = $('tanggal').value;
  $('pvTanggal').textContent = t ? formatTanggal(t) : 'Baru saja';
}
['nama','lokasi','kategori','tanggal'].forEach(id => $(id).addEventListener('input', () => {
  updateText();
  $(id).classList.remove('invalid');
  const e = $('e-' + id); if (e) e.hidden = true;
}));
updateText();
</script>
</body>
</html>
