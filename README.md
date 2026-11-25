# FindU 🔍

**FindU** adalah aplikasi web berbasis Laravel untuk membantu pengguna melaporkan, mencari, dan mengklaim barang hilang maupun barang temuan. Pengguna dapat melaporkan barang yang ditemukan atau hilang, mencari barang melalui halaman pencarian, mengajukan klaim, dan memantau status klaim mereka.

## ✨ Fitur Utama

- **Beranda (Dashboard)**: ringkasan barang hilang dan temuan.
- **Pencarian Barang**: cari barang berdasarkan kata kunci.
- **Detail Barang & Klaim**: lihat detail barang dan ajukan klaim kepemilikan.
- **Lapor Barang Ditemukan**: form pelaporan barang yang ditemukan.
- **Lapor Barang Hilang**: form pelaporan barang yang hilang.
- **Riwayat Klaim**: pantau klaim aktif (`menunggu`) dan riwayat (`selesai`, `ditolak`, `kedaluwarsa`), serta batalkan klaim.
- **Profil Pengguna**: lihat dan ubah profil serta kata sandi.
- **Autentikasi**: registrasi, login, dan logout.
- **Tentang Kami**: informasi mengenai FindU.

## 🛠️ Teknologi

| Komponen | Versi |
|----------|-------|
| PHP      | ^8.2  |
| Laravel  | ^12.0 |
| Template | Blade |

## 📁 Struktur Proyek

```
FindU/
├── app/
│   ├── Http/Controllers/   # Home, Item, Claim, Profile, Auth, About
│   └── Models/             # User, Claim
├── database/migrations/    # Migrasi tabel (claims, dll.)
├── resources/views/        # Blade: auth, claims, home, items, layouts, pages, profile
├── routes/web.php          # Definisi route aplikasi
└── public/                 # Aset publik
```

## 🚀 Instalasi

### Prasyarat

- PHP >= 8.2
- Composer
- Database (MySQL/SQLite)

### Langkah-langkah

```bash
# 1. Clone repository
git clone -b Laravel-Final-Findu https://github.com/kennyshefa/FindU.git
cd FindU

# 2. Install dependency
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Atur koneksi database di file .env, lalu jalankan migrasi
php artisan migrate

# 6. (Opsional) Buat symbolic link untuk storage
php artisan storage:link

# 7. Jalankan server development
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

> Jika file `.env.example` tidak tersedia, buat file `.env` secara manual dan isi konfigurasi `APP_KEY`, `DB_CONNECTION`, `DB_DATABASE`, dan lainnya.

## 🗺️ Daftar Route

| Method | URL | Deskripsi |
|--------|-----|-----------|
| GET | `/` | Beranda |
| GET | `/cari` | Pencarian barang |
| GET | `/barang/{id?}` | Detail barang |
| POST | `/barang/{id}/klaim` | Kirim klaim barang |
| GET/POST | `/lapor-ditemukan` | Lapor barang ditemukan |
| GET/POST | `/lapor-hilang` | Lapor barang hilang |
| GET | `/klaim` | Riwayat klaim |
| POST | `/klaim/{id}/batal` | Batalkan klaim |
| GET | `/tentang-kami` | Tentang kami |
| GET | `/profile` | Profil pengguna |
| GET/PUT | `/profile/edit`, `/profile` | Edit profil |
| PUT | `/profile/password` | Ubah kata sandi |
| GET/POST | `/login` | Login |
| GET/POST | `/register` | Registrasi |
| GET | `/logout` | Logout |

## 👤 Author

**Kenny Shefa** — [@kennyshefa](https://github.com/kennyshefa)

## 📄 Lisensi

Proyek ini dibuat untuk keperluan tugas akhir/pembelajaran. Framework Laravel dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
