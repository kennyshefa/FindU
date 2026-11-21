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

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Langsung autentikasi dan buka akun
        session([
            'is_logged_in' => true,
            'user_email' => $request->email,
            'user_name' => ($request->email === 'nadia@student.ub.ac.id' || str_contains(strtolower($request->email), 'nadia')) ? 'Nadia' : 'Nama Pengguna'
        ]);

        return redirect()->route('home')->with('success', 'Berhasil masuk ke akun!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Langsung simpan dan buka akun
        session([
            'is_logged_in' => true,
            'user_email' => $request->email,
            'user_name' => $request->name,
            'user_role' => $request->role ?? 'Mahasiswa'
        ]);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil!');
    }

    public function logout()
    {
        session(['is_logged_in' => false]);
        return redirect()->route('home', ['auth' => '0']);
    }
}
