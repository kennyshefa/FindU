<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private function currentProfile()
    {
        $saved = session('user_profile', []);

        $loggedEmail = $saved['email'] ?? session('user_email', 'nadia@student.ub.ac.id');
        $loggedName = $saved['name'] ?? session('user_name', 'Nadia Nur Awwalia R');
        $prodi = $saved['prodi'] ?? ($saved['major'] ?? 'Pendidikan Teknologi Informasi (PTI)');
        $fakultas = $saved['fakultas'] ?? ($saved['faculty'] ?? 'Ilmu Komputer');
        $angkatan = $saved['angkatan'] ?? ($saved['batch'] ?? '2025');

        return [
            'name' => $loggedName,
            'display_name' => $saved['display_name'] ?? $loggedName,
            'email' => $loggedEmail,
            'role' => $saved['role'] ?? session('user_role', 'Mahasiswa'),
            'phone' => $saved['phone'] ?? '+62 812 3456 7890',
            'nim' => $saved['nim'] ?? '235150600111001',
            'prodi' => $prodi,
            'fakultas' => $fakultas,
            'angkatan' => $angkatan,
            'major' => $prodi,
            'faculty' => $fakultas,
            'batch' => $angkatan,
            'password_hash' => $saved['password_hash'] ?? Hash::make('password123'),
        ];
    }

    public function index()
    {
        $user = (object) $this->currentProfile();

        $stats = [
            'total_laporan' => 3,
            'barang_ditemukan' => 2,
            'klaim_aktif' => 1,
            'notifikasi' => 5,
        ];

        return view('profile.index', compact('user', 'stats'));
    }

    public function edit()
    {
        $user = (object) $this->currentProfile();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'nim' => ['required', 'string', 'max:40'],
            'faculty' => ['required', 'string', 'max:120'],
            'major' => ['required', 'string', 'max:150'],
            'batch' => ['required', 'string', 'max:20'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'nim.required' => 'NIM wajib diisi.',
            'faculty.required' => 'Fakultas wajib diisi.',
            'major.required' => 'Program studi wajib diisi.',
            'batch.required' => 'Angkatan wajib diisi.',
        ]);

        $current = $this->currentProfile();

        $updated = array_merge($current, [
            'name' => $validated['name'],
            'display_name' => $validated['name'],
            'phone' => $validated['phone'],
            'nim' => $validated['nim'],
            'fakultas' => $validated['faculty'],
            'prodi' => $validated['major'],
            'angkatan' => $validated['batch'],
            'faculty' => $validated['faculty'],
            'major' => $validated['major'],
            'batch' => $validated['batch'],
        ]);

        session([
            'user_profile' => $updated,
            'user_name' => $validated['name'],
        ]);

        return redirect()->route('profile.edit')
            ->with('success_profile', 'Perubahan profil berhasil disimpan.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $current = $this->currentProfile();

        if (!Hash::check($validated['current_password'], $current['password_hash'])) {
            return back()
                ->withErrors(['current_password' => 'Password lama tidak sesuai.'])
                ->withInput();
        }

        $current['password_hash'] = Hash::make($validated['password']);
        session(['user_profile' => $current]);

        return redirect()->route('profile.edit')
            ->with('success_password', 'Password berhasil diperbarui.');
    }
}