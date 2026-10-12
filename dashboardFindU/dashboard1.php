<?php
$items = [
    [
        'title' => 'Dompet',
        'status' => 'Ditemukan',
        'status_class' => 'badge-found',
        'location' => 'Perpus UB',
        'time' => '4 hari yang lalu',
        'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=500&q=80'
    ],
    [
        'title' => 'Kunci Motor',
        'status' => 'Ditemukan',
        'status_class' => 'badge-found',
        'location' => 'Parkiran FILKOM',
        'time' => '2 jam yang lalu',
        'image' => 'https://images.unsplash.com/photo-1582139329536-e7284fece509?w=500&q=80'
    ],
    [
        'title' => 'Tumbler Biru',
        'status' => 'Hilang',
        'status_class' => 'badge-lost',
        'location' => 'Gedung FISIP',
        'time' => '5 jam yang lalu',
        'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=500&q=80'
    ],
    [
        'title' => 'Kacamata',
        'status' => 'Ditemukan',
        'status_class' => 'badge-found',
        'location' => 'Kantin FEB',
        'time' => '1 hari yang lalu',
        'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&q=80'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindU - Temukan Barangmu Kembali</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
</head>
<body>

    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="logo">
                <i class="fa-solid fa-location-dot"></i>
                <span>FindU</span>
            </a>
            <nav class="nav-links">
                <a href="index.php" class="active">Beranda</a>
                <a href="#">Cari</a>
                <a href="#">Upload</a>
                <a href="#">Tentang Kami</a>
            </nav>
            <a href="login.php" class="btn-login-orange">Login ▾</a>
        </div>
    </header>

    <section class="hero-section">
        <div class="container hero-container">
            <div class="hero-content">
                <p class="subtitle">Selamat datang di FindU</p>
                <h1 class="hero-title">Temukan Barangmu <br><span class="highlight">Kembali</span></h1>
                <p class="hero-desc">Bantu sesama dengan melaporkan barang hilang atau menemukan barang yang bukan milikmu.</p>
                
                <form class="search-box" action="#" method="GET">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama barang, lokasi, atau kategori...">
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                </form>
                <p class="location-tag"><i class="fa-solid fa-location-dot"></i> Cari barang hilang & ditemukan di sekitar UB</p>
            </div>

            <div class="hero-card">
                <div class="hero-card-img">
                    <img src="asset/Community illustration.jpg" alt="Punya kabar barang">
                </div>
                <div class="hero-card-body">
                    <h3><span class="plus-icon">+</span> Punya kabar barang?</h3>
                    <p>Buat laporan agar barang lebih cepat kembali ke pemiliknya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="items-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Barang Terbaru</h2>
                    <p class="section-sub">Mungkin barang yang kamu cari ada di sini.</p>
                </div>
                <a href="#" class="link-all">Lihat Semua &rarr;</a>
            </div>

            <div class="filter-bar">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Semua</button>
                    <button class="filter-btn" data-filter="Hilang">Hilang</button>
                    <button class="filter-btn" data-filter="Ditemukan">Ditemukan</button>
                </div>
                <div class="sort-dropdown">
                    <select id="sortSelect">
                        <option value="terbaru">Terbaru</option>
                        <option value="lama">Terlama</option>
                    </select>
                </div>
            </div>

            <div class="items-grid" id="itemsContainer">
                <?php foreach ($items as$item): ?>
                    <div class="item-card" data-category="<?= $item['status']; ?>">
                        <div class="card-image">
                            <img src="<?= $item['image']; ?>" alt="<?= $item['title']; ?>">
                        </div>
                        <div class="card-body">
                            <span class="badge <?= $item['status_class']; ?>"><?= $item['status']; ?></span>
                            <h3 class="card-title"><?= $item['title']; ?></h3>
                            <div class="card-info">
                                <span><i class="fa-solid fa-location-dot"></i> <?= $item['location']; ?></span>
                                <span><i class="fa-regular fa-clock"></i> <?= $item['time']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container footer-container">
            <p>FindU &mdash; saling bantu, saling menemukan di sekitar UB.</p>
            <a href="#" class="help-link">Butuh bantuan?</a>
        </div>
    </footer>

    <script
