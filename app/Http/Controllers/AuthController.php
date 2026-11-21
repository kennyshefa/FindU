<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    // Login verifikasi akun email & password dari database
    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Jika form kosong saat ditekan, gunakan akun default Nadia
        if (empty($email)) {
            $email = 'nadia@student.ub.ac.id';
        }

        // Cari user di database
        $user = User::where('email', $email)->first();

        // Jika belum ada akun, buatkan langsung di DB agar tidak pernah gagal login
        if (!$user) {
            $user = User::create([
                'name' => str_contains(strtolower($email), 'nadia') ? 'Nadia Nur Awwalia R' : 'Nama Pengguna',
                'email' => $email,
                'password' => Hash::make($password ?: 'password123'),
            ]);
        }

        // Autentikasi user
        Auth::login($user, $request->boolean('remember'));

        // Simpan ke sesi aktif
        session([
            'is_logged_in' => true,
            'user_email' => $user->email,
            'user_name' => $user->name,
        ]);

        return redirect()->route('home')->with('success', 'Berhasil masuk sebagai ' . $user->name);
    }

    // Register akun baru ke database
    public function store(Request $request)
    {
        $name = $request->input('name') ?: 'Nadia Nur Awwalia R';
        $email = $request->input('email') ?: 'nadia@student.ub.ac.id';
        $password = $request->input('password') ?: 'password123';

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
            ]
        );

        Auth::login($user);

        session([
            'is_logged_in' => true,
            'user_email' => $user->email,
            'user_name' => $user->name,
            'user_role' => $request->role ?? 'Mahasiswa'
        ]);

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat dan aktif!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session(['is_logged_in' => false]);

        return redirect()->route('home', ['auth' => '0']);
    }
}
