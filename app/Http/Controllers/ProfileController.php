<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $loggedEmail = session('user_email', 'nadia@student.ub.ac.id');
        $loggedName = session('user_name', 'Nadia Nur Awwalia R');

        $user = (object) [
            'name' => $loggedName,
            'display_name' => $loggedName,
            'email' => $loggedEmail,
            'role' => session('user_role', 'Mahasiswa'),
            'phone' => '+62 812 3456 7890',
            'nim' => '235150600111001',
            'prodi' => 'Pendidikan Teknologi Informasi (PTI)',
            'fakultas' => 'Ilmu Komputer',
            'angkatan' => '2025',
        ];

        $stats = [
            'total_laporan' => 3,
            'barang_ditemukan' => 2,
            'klaim_aktif' => 1,
            'notifikasi' => 5,
        ];

        return view('profile.index', compact('user', 'stats'));
    }
}
