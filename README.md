# FindU - Halaman "Klaim Saya" (Pemrograman Web)

Implementasi antarmuka dan backend PHP untuk fitur **Klaim Saya** pada sistem pelaporan & klaim barang hilang **FindU**.

---

## 📁 Struktur File
- **`index.php`** : Halaman utama antarmuka "Klaim Saya" (Status & Riwayat Klaim), lengkap dengan QR Code, Stepper Tracker, Filter Status, Jejak Serah Terima, dan tombol aksi interaktif.
- **`koneksi.php`** : Konfigurasi koneksi database MySQL dengan PDO. Otomatis beralih (*graceful fallback*) ke data mock jika MySQL belum aktif/terhubung, sehingga halaman langsung siap ditampilkan.
- **`database.sql`** : Skrip pembuatan skema database MySQL (`findu_db`) dan data awal (*dummy data*) yang siap diimpor melalui phpMyAdmin atau MySQL CLI.

---

## 🚀 Cara Menjalankan

### Cara 1: Menggunakan PHP Built-in Server (Paling Cepat)
1. Buka Terminal / PowerShell di folder ini (`c:\kel.1 PEMWEB`).
2. Jalankan perintah:
   ```bash
   php -S localhost:8000
   ```
3. Buka browser dan akses:
   ```
   http://localhost:8000
   ```

### Cara 2: Menggunakan XAMPP
1. Pindahkan folder `kel.1 PEMWEB` ke dalam folder `htdocs` XAMPP (biasanya `C:\xampp\htdocs\findu`).
2. Aktifkan **Apache** dan **MySQL** di XAMPP Control Panel.
3. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`), buat database baru bernama `findu_db`, lalu impor file **`database.sql`**.
4. Akses melalui browser: `http://localhost/findu/`
