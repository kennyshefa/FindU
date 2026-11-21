@extends('layouts.app')

@section('title', 'Profile')

@section('container-class', 'max-w-5xl mx-auto px-4 sm:px-6 py-8')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Kolom Kiri (Utama - 2 Kolom) -->
    <div class="lg:col-span-2 space-y-6">

        <!-- User Profile Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <!-- Background Banner with Avatar & Edit Button -->
            <div class="bg-gradient-to-r from-amber-100/70 via-orange-50 to-amber-50 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <!-- Avatar N -->
                    <div class="w-16 h-16 rounded-full bg-amber-500 text-white font-extrabold text-2xl flex items-center justify-center shadow-sm shrink-0">
                        N
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">{{ $user->display_name }}</h2>
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="mt-2">
                            <span class="inline-block bg-amber-100 text-amber-800 text-[11px] font-semibold px-3 py-0.5 rounded-full">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="inline-flex items-center gap-1.5 border border-amber-300 hover:bg-amber-50 text-amber-700 text-xs font-semibold px-4 py-1.5 rounded-xl transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Edit Profil
                    </button>
                </div>
            </div>

            <!-- Tab Navigasi Profil -->
            <div class="border-b border-slate-100 px-6 flex items-center gap-6 overflow-x-auto text-xs font-semibold">
                <a href="{{ route('profile') }}" class="py-3 text-amber-600 border-b-2 border-amber-500">
                    Informasi Akun
                </a>
                <a href="#" class="py-3 text-slate-500 hover:text-slate-800 transition">
                    Riwayat Laporan
                </a>
                <a href="{{ route('claims.index') }}" class="py-3 text-slate-500 hover:text-slate-800 transition">
                    Klaim Saya
                </a>
                <a href="#" class="py-3 text-slate-500 hover:text-slate-800 transition">
                    Notifikasi
                </a>
            </div>

            <!-- Data Diri Detail -->
            <div class="p-6 space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-800 pb-1">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Data Diri</span>
                </div>

                <div class="divide-y divide-slate-100 text-xs">
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">Nama Lengkap</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">{{ $user->display_name }}</span>
                    </div>
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">Email</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">{{ $user->email }}</span>
                    </div>
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">Nomor Telepon</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">+62 xxx xxxx xxxx</span>
                    </div>
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">NIM</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">XXXXXXXXXXXXXXX</span>
                    </div>
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">Program Studi</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">{{ $user->prodi }}</span>
                    </div>
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">Fakultas</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">{{ $user->fakultas }}</span>
                    </div>
                    <div class="py-2.5 flex flex-col sm:flex-row sm:justify-between">
                        <span class="text-slate-400 font-medium sm:w-1/3">Angkatan</span>
                        <span class="text-slate-800 font-semibold sm:w-2/3">{{ $user->angkatan }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ubah Password Card -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Ubah Password</span>
                </div>
                <p class="text-xs text-slate-500 mt-1">Pastikan password kamu kuat dan mudah diingat.</p>
            </div>
            <div>
                <button class="border border-amber-300 hover:bg-amber-50 text-amber-700 text-xs font-semibold px-4 py-2 rounded-xl transition">
                    Ganti Password
                </button>
            </div>
        </div>

    </div>

    <!-- Kolom Kanan (Sidebar) -->
    <div class="space-y-6">

        <!-- Card: Aksi Cepat -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Aksi Cepat</h3>
            
            <div class="space-y-2">
                <a href="#" class="flex items-center justify-between p-3 rounded-2xl bg-slate-50/70 hover:bg-amber-50/50 border border-slate-100 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xs">
                            ✏️
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-amber-600 transition">Edit Profil</div>
                            <div class="text-[11px] text-slate-400">Ubah data diri dan informasi akun</div>
                        </div>
                    </div>
                    <span class="text-slate-400 text-xs font-bold">&rsaquo;</span>
                </a>

                <a href="#" class="flex items-center justify-between p-3 rounded-2xl bg-slate-50/70 hover:bg-amber-50/50 border border-slate-100 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xs">
                            📋
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-amber-600 transition">Lihat Riwayat Laporan</div>
                            <div class="text-[11px] text-slate-400">Cek barang yang pernah kamu laporkan</div>
                        </div>
                    </div>
                    <span class="text-slate-400 text-xs font-bold">&rsaquo;</span>
                </a>

                <a href="{{ route('claims.index') }}" class="flex items-center justify-between p-3 rounded-2xl bg-slate-50/70 hover:bg-amber-50/50 border border-slate-100 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xs">
                            🎫
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-amber-600 transition">Klaim Saya</div>
                            <div class="text-[11px] text-slate-400">Pantau status klaim barang</div>
                        </div>
                    </div>
                    <span class="text-slate-400 text-xs font-bold">&rsaquo;</span>
                </a>
            </div>
        </div>

        <!-- Card: Ringkasan Aktivitas -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Ringkasan Aktivitas</h3>

            <div class="grid grid-cols-2 gap-3">
                <!-- Total Laporan -->
                <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-100">
                    <div class="text-2xl font-black text-slate-800">{{ $stats['total_laporan'] }}</div>
                    <div class="text-[11px] font-medium text-slate-500 mt-1">Total Laporan</div>
                </div>

                <!-- Barang Ditemukan -->
                <div class="bg-emerald-50/70 rounded-2xl p-4 border border-emerald-100/60">
                    <div class="text-2xl font-black text-emerald-600">{{ $stats['barang_ditemukan'] }}</div>
                    <div class="text-[11px] font-medium text-slate-500 mt-1">Barang Ditemukan</div>
                </div>

                <!-- Klaim Aktif -->
                <div class="bg-indigo-50/70 rounded-2xl p-4 border border-indigo-100/60">
                    <div class="text-2xl font-black text-indigo-600">{{ $stats['klaim_aktif'] }}</div>
                    <div class="text-[11px] font-medium text-slate-500 mt-1">Klaim Aktif</div>
                </div>

                <!-- Notifikasi -->
                <div class="bg-amber-50/70 rounded-2xl p-4 border border-amber-100/60">
                    <div class="text-2xl font-black text-amber-600">{{ $stats['notifikasi'] }}</div>
                    <div class="text-[11px] font-medium text-slate-500 mt-1">Notifikasi</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
