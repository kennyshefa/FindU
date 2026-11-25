<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            ['count' => '10', 'label' => 'Fitur tersedia'],
            ['count' => '4', 'label' => 'Fitur utama'],
            ['count' => '6', 'label' => 'Anggota tim'],
            ['count' => '1', 'label' => 'Tempat terpusat'],
        ];

        $features = [
            [
                'title' => 'Login & Register',
                'desc' => 'Masuk atau buat akun dengan email dan password.',
                'icon' => 'key',
            ],
            [
                'title' => 'Dashboard',
                'desc' => 'Lihat daftar barang hilang dan ditemukan lengkap dengan foto, kategori, lokasi, dan tanggal.',
                'icon' => 'layout',
            ],
            [
                'title' => 'Profile',
                'desc' => 'Kelola informasi akun dan lihat riwayat laporan yang pernah dibuat.',
                'icon' => 'user',
            ],
            [
                'title' => 'Lapor Barang Hilang',
                'desc' => 'Buat laporan kehilangan dengan deskripsi, lokasi, tanggal, dan foto.',
                'icon' => 'megaphone',
            ],
            [
                'title' => 'Lapor Barang Ditemukan',
                'desc' => 'Bantu pemilik mengenali barangnya dengan melaporkan temuanmu.',
                'icon' => 'package',
            ],
            [
                'title' => 'Cari & Filter',
                'desc' => 'Cari lewat kata kunci, lalu saring berdasarkan kategori atau status.',
                'icon' => 'search',
            ],
            [
                'title' => 'Klaim Barang',
                'desc' => 'Ajukan klaim kepemilikan beserta informasi pendukung untuk diverifikasi.',
                'icon' => 'check-circle',
            ],
            [
                'title' => 'Riwayat',
                'desc' => 'Pantau perkembangan laporan lewat badge status real-time.',
                'icon' => 'tag',
            ],
            [
                'title' => 'Notifikasi',
                'desc' => 'Dapat kabar saat status berubah atau klaimmu direspons.',
                'icon' => 'bell',
            ],
        ];

        $steps = [
            [
                'step' => '1',
                'title' => 'Buat laporan',
                'desc' => 'Laporkan barang hilang atau ditemukan, lengkap dengan foto.',
            ],
            [
                'step' => '2',
                'title' => 'Cari barangmu',
                'desc' => 'Gunakan pencarian dan filter kategori atau status.',
            ],
            [
                'step' => '3',
                'title' => 'Ajukan klaim',
                'desc' => 'Kirim klaim kepemilikan dengan informasi pendukung.',
            ],
            [
                'step' => '4',
                'title' => 'Verifikasi & serah terima',
                'desc' => 'Barang diserahkan setelah pengecekan, statusnya terbarui otomatis.',
            ],
        ];

        $team = [
            [
                'initials' => 'RI',
                'bg_color' => 'bg-blue-600',
                'name' => 'Rohmaniyyatul Islamiyyah',
                'role' => 'Riwayat · Profile',
            ],
            [
                'initials' => 'KSD',
                'bg_color' => 'bg-amber-500',
                'name' => 'Kanny Shefa Dinarti',
                'role' => 'Klaim Barang · Login · Back End',
            ],
            [
                'initials' => 'NNAR',
                'bg_color' => 'bg-blue-600',
                'name' => 'Nabila Nur Awwalia R',
                'role' => 'Post Barang Ditemukan · Dashboard',
            ],
            [
                'initials' => 'HPGP',
                'bg_color' => 'bg-amber-500',
                'name' => 'Hana Paulina G. Purba',
                'role' => 'Post Barang Hilang · Tentang Kami',
            ],
            [
                'initials' => 'SZPC',
                'bg_color' => 'bg-blue-600',
                'name' => 'Syahda Zaahirah Putri C.',
                'role' => 'Search & Filter · Register',
            ],
            [
                'initials' => 'PP',
                'bg_color' => 'bg-amber-500',
                'name' => 'Primada Purnama',
                'role' => 'Full Stack · Dashboard',
            ],
        ];

        $techStack = ['Laravel', 'PHP', 'HTML / CSS', 'JavaScript', 'Figma', 'GitHub'];

        return view('pages.about', compact('stats', 'features', 'steps', 'team', 'techStack'));
    }
}
