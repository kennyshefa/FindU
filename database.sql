-- Database: findu_db
-- Dibuat untuk Proyek Pemrograman Web (Kelompok 1)

CREATE DATABASE IF NOT EXISTS `findu_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `findu_db`;

-- 1. Tabel Users (Mahasiswa & Petugas/Admin)
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nim` VARCHAR(20) UNIQUE NOT NULL,
    `nama` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('mahasiswa', 'petugas', 'admin') DEFAULT 'mahasiswa',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Tabel Barang Hilang / Ditemukan
CREATE TABLE IF NOT EXISTS `barang` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_barang` VARCHAR(150) NOT NULL,
    `kategori` VARCHAR(50) NOT NULL,
    `lokasi_penyimpanan` VARCHAR(150) NOT NULL,
    `foto` VARCHAR(255) NULL,
    `status` ENUM('tersedia', 'diklaim', 'diserahkan') DEFAULT 'tersedia',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Tabel Klaim Barang
CREATE TABLE IF NOT EXISTS `klaim` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `barang_id` INT NOT NULL,
    `kode_klaim` VARCHAR(50) UNIQUE NOT NULL,
    `status` ENUM('menunggu_verifikasi', 'selesai', 'ditolak', 'kedaluwarsa') DEFAULT 'menunggu_verifikasi',
    `is_active` TINYINT(1) DEFAULT 1,
    `tahap` INT DEFAULT 2, -- 1: Klaim diajukan, 2: Ke pos satpam, 3: Verifikasi petugas, 4: Diserahkan
    `deadline` DATE NOT NULL,
    `masa_berlaku_hari` INT DEFAULT 7,
    `tanggal_pengajuan` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `tanggal_selesai` DATETIME NULL,
    `petugas_penyerah` VARCHAR(100) NULL,
    `alasan_petugas` TEXT NULL,
    `catatan_klaim` TEXT NULL,
    `foto_serah_terima` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`barang_id`) REFERENCES `barang`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Tabel Jejak Aktivitas / Log Klaim
CREATE TABLE IF NOT EXISTS `jejak_klaim` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `klaim_id` INT NOT NULL,
    `waktu` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `deskripsi` TEXT NOT NULL,
    FOREIGN KEY (`klaim_id`) REFERENCES `klaim`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ========================================================
-- DATA DUMMY SESUAI TAMPILAN MOCKUP UI FINDU
-- ========================================================

INSERT INTO `users` (`id`, `nim`, `nama`, `email`, `password`, `role`) VALUES
(1, '230101001', 'Ahmad Mahasiswa', 'ahmad@campus.ac.id', MD5('password123'), 'mahasiswa');

INSERT INTO `barang` (`id`, `nama_barang`, `kategori`, `lokasi_penyimpanan`, `foto`) VALUES
(1, 'Kunci Motor', 'Kendaraan', 'Pos Satpam Gedung F', NULL),
(2, 'Kotak Pensil', 'Alat Tulis', 'Pos Satpam Gedung B', NULL),
(3, 'Tumbler Biru', 'Perlengkapan', 'Pos Satpam Rektorat', NULL),
(4, 'Kacamata', 'Aksesoris', 'Pos Satpam Gedung A', NULL);

INSERT INTO `klaim` (`id`, `user_id`, `barang_id`, `kode_klaim`, `status`, `is_active`, `tahap`, `deadline`, `tanggal_pengajuan`, `tanggal_selesai`, `petugas_penyerah`, `alasan_petugas`, `catatan_klaim`, `foto_serah_terima`) VALUES
(1, 1, 1, 'FU-2611-0038', 'menunggu_verifikasi', 1, 2, '2026-11-27', '2026-11-20 09:15:00', NULL, NULL, NULL, 'Bawa KTM dan ingat kapan (jam) serta di mana kamu merasa kehilangan barang ini. Kode hanya nomor antrean, bukan bukti kepemilikan.', NULL),
(2, 1, 2, 'FU-2611-0042', 'selesai', 0, 4, '2026-11-27', '2026-11-20 10:15:00', '2026-11-20 14:32:00', 'Pak Joko', NULL, NULL, 'bukti_serah_0042.jpg'),
(3, 1, 3, 'FU-2611-0031', 'ditolak', 0, 3, '2026-11-19', '2026-11-12 08:30:00', '2026-11-12 11:20:00', 'Pak Budi', 'ciri tidak sesuai', NULL, NULL),
(4, 1, 4, 'FU-2611-0027', 'kedaluwarsa', 0, 1, '2026-11-10', '2026-11-03 14:00:00', '2026-11-10 23:59:00', NULL, 'Tidak datang ke pos dalam 7 hari', NULL, NULL);

INSERT INTO `jejak_klaim` (`klaim_id`, `waktu`, `deskripsi`) VALUES
(2, '2026-11-20 14:32:00', 'Diserahkan oleh [Nama Petugas] setelah verifikasi'),
(2, '2026-11-20 14:30:00', 'Foto serah terima dicatat server'),
(2, '2026-11-20 10:15:00', 'Klaim diajukan');
