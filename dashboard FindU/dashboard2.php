<?php
// Contoh session nama user yang login
$user_name = "Nadia";

// Data contoh barang
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
    <title>FindU - Dashboard</title>
    <!-- Font Inter & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="#" class="logo">
                <i class="fa-solid fa-location-dot"></i>
                <span>FindU</span>
            </a>
            <nav class="nav-links">
                <a href="#" class="active">Beranda</a>
                <a href="#">Cari</a>
                <a href="#">Upload</a>
                <a href="#">Tentang Kami</a>
            </nav>

            <!-- User Menu (Setelah Login) -->
            <div class="user-dropdown">
                <button class="btn btn-user" id="userMenuBtn">
                    <span><?= $user_name; ?></span>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="#"><i class="fa-regular fa-user"></i> Profil Saya</a>
                    <a href="#"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Laporan</a>
                    <hr>
                    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-container">
            <div class="hero-content">
                <p class="subtitle">Selamat datang kembali, <?= $user_name; ?>!</p>
                <h1 class="hero-title">Temukan Barangmu <br><span class="highlight">Kembali</span></h1>
                <p class="hero-desc">Bantu sesama dengan melaporkan barang hilang atau menemukan barang yang bukan milikmu.</p>
                
                <!-- Search Box -->
                <form class="search-box" action="#" method="GET">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama barang, lokasi, atau kategori...">
                    <button type="submit" class="btn btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                    </button>
                </form>
                <p class="location-tag"><i class="fa-solid fa-location-dot"></i> Cari barang hilang & ditemukan di sekitar UB</p>
            </div>

            <!-- Hero Banner Card dengan Tombol Aksi -->
            <div class="hero-card">
                <div class="hero-card-img">
                    <img src="https://img.freepik.com/free-vector/hand-drawn-lost-found-illustration_23-2150373409.jpg" alt="Punya kabar barang">
                </div>
                <div class="hero-card-body">
                    <h3><span class="plus-icon">+</span> Punya kabar barang?</h3>
                    <p>Buat laporan agar barang lebih cepat kembali ke pemiliknya.</p>
                    
                    <!-- Action Buttons -->
                    <div class="hero-action-btns">
                        <a href="laporkan-hilang.php" class="btn btn-action-blue">Laporkan Barang Hilang</a>
                        <a href="laporkan-ditemukan.php" class="btn btn-action-white">Laporkan Barang Ditemukan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Items Section -->
    <section class="items-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Barang Terbaru</h2>
                    <p class="section-sub">Mungkin barang yang kamu cari ada di sini.</p>
                </div>
                <a href="#" class="link-all">Lihat Semua &rarr;</a>
            </div>

            <!-- Filter Options -->
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

            <!-- Grid Items -->
            <div class="items-grid" id="itemsContainer">
                <?php foreach ($items as $item): ?>
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-container">
            <p>FindU &mdash; saling bantu, saling menemukan di sekitar UB.</p>
            <a href="#" class="help-link">Butuh bantuan?</a>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>