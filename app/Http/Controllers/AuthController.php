<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // Login langsung sukses & buka akun (fleksibel: kosong / diisi apapun langsung masuk)
    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        if (empty($email)) {
            $email = 'email@student.ub.ac.id';
        }

        session([
            'is_logged_in' => true,
            'user_email' => $email,
            'user_name' => 'Nadia'
        ]);

        return redirect()->route('home');
    }

    // Register langsung sukses & buka akun
    public function store(Request $request)
    {
        $name = $request->input('name') ?: 'Nadia Nur Awwalia R';
        $email = $request->input('email') ?: 'email@student.ub.ac.id';

        session([
            'is_logged_in' => true,
            'user_email' => $email,
            'user_name' => $name,
            'user_role' => $request->role ?? 'Mahasiswa'
        ]);

        return redirect()->route('home');
    }

    public function logout()
    {
        session(['is_logged_in' => false]);
        return redirect()->route('home', ['auth' => '0']);
    }
}
