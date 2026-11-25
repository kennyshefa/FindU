@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Kolom Kiri: Profil & Data Diri (2/3) -->
    <div class="lg:col-span-2 space-y-6">

        <!-- Kartu Utama Profil -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <!-- Header Banner Krem dengan Dekorasi Lingkaran Sesuai Figma -->
            <div class="relative bg-[#FFF3EA] p-6 sm:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 overflow-hidden">
                <!-- Lingkaran Peach Dekoratif di Kanan Atas -->
                <div class="absolute -right-6 -top-8 w-36 h-36 rounded-full bg-[#FFE3CF] pointer-events-none"></div>

                <div class="flex items-center gap-4 relative z-10">
                    <!-- Avatar Lingkaran Oranye "N" -->
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#EAA023] text-white font-black text-2xl sm:text-3xl flex items-center justify-center shadow-xs shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">{{ $user->display_name }}</h2>
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="mt-2">
                            <span class="inline-block bg-[#FFE7D4] text-[#C27803] text-[11px] font-bold px-3.5 py-0.5 rounded-full">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Profil & Logout -->
                <div class="relative z-10 flex items-center gap-2">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1.5 border border-[#F59E0B] bg-white/90 hover:bg-white text-[#D97706] text-xs font-semibold px-4 py-1.5 rounded-xl transition shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Edit Profil
                    </a>
                    <!-- Tombol Logout Header -->
                    <a href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin keluar dari akun?')" class="inline-flex items-center gap-1.5 border border-rose-300 bg-white/90 hover:bg-rose-50 text-rose-600 text-xs font-semibold px-3.5 py-1.5 rounded-xl transition shadow-2xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar</span>
                    </a>
                </div>
            </div>

            <!-- Tab Navigasi Profil -->
            <div class="border-b border-slate-100 px-6 sm:px-8 flex items-center gap-8 overflow-x-auto text-xs font-bold">
                <a href="{{ route('profile') }}" class="py-3.5 text-[#EAA023] border-b-2 border-[#EAA023]">
                    Informasi Akun
                </a>
                <a href="{{ route('claims.index', ['tab' => 'laporan']) }}" class="py-3.5 text-slate-500 hover:text-slate-800 transition">
                    Riwayat Laporan
                </a>
                <a href="{{ route('claims.index') }}" class="py-3.5 text-slate-500 hover:text-slate-800 transition">
                    Klaim Saya
                </a>
                <a href="#" class="py-3.5 text-slate-500 hover:text-slate-800 transition">
                    Notifikasi
                </a>
            </div>

            <!-- Rincian Data Diri -->
            <div class="p-6 sm:p-8 space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-slate-900 pb-1">
                    <svg class="w-4 h-4 text-[#EAA023]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Data Diri</span>
                </div>

                <div class="divide-y divide-slate-100 text-xs">
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">Nama Lengkap</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->display_name }}</span>
                    </div>
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">Email</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->email }}</span>
                    </div>
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">Nomor Telepon</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->phone }}</span>
                    </div>
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">NIM</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->nim }}</span>
                    </div>
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">Program Studi</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->prodi }}</span>
                    </div>
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">Fakultas</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->fakultas }}</span>
                    </div>
                    <div class="py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                        <span class="text-slate-400 font-medium sm:w-1/3">Angkatan</span>
                        <span class="text-slate-900 font-bold sm:w-2/3">{{ $user->angkatan }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Ubah Password Sesuai Figma -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold text-slate-900">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Ubah Password</span>
                </div>
                <p class="text-xs text-slate-400 mt-1">Pastikan password kamu kuat dan mudah diingat.</p>
            </div>
            <div>
                <a href="{{ route('profile.edit') }}#ubah-password" class="inline-block border border-[#F59E0B] hover:bg-amber-50 text-[#D97706] text-xs font-semibold px-5 py-2.5 rounded-xl transition">
                    Ganti Password
                </a>
            </div>
        </div>

    </div>

    <!-- Kolom Kanan: Aksi Cepat & Ringkasan Aktivitas (1/3) -->
    <div class="space-y-6">

        <!-- Card: Aksi Cepat Sesuai Desain Figma -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-100 space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Aksi Cepat</h3>

            <div class="space-y-2.5">
                <!-- Edit Profil -->
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-3 rounded-2xl bg-white hover:bg-amber-50/50 border border-slate-100/90 transition group shadow-2xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#FFF3E8] text-[#EAA023] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-[#EAA023] transition">Edit Profil</div>
                            <div class="text-[11px] text-slate-400">Ubah data diri dan informasi akun</div>
                        </div>
                    </div>
                    <span class="text-slate-300 text-sm font-bold group-hover:text-slate-500 transition">&rsaquo;</span>
                </a>

                <!-- Lihat Riwayat Laporan -->
                <a href="{{ route('claims.index', ['tab' => 'laporan']) }}" class="flex items-center justify-between p-3 rounded-2xl bg-white hover:bg-amber-50/50 border border-slate-100/90 transition group shadow-2xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#FFF3E8] text-[#EAA023] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-[#EAA023] transition">Lihat Riwayat Laporan</div>
                            <div class="text-[11px] text-slate-400">Cek barang yang pernah kamu laporkan</div>
                        </div>
                    </div>
                    <span class="text-slate-300 text-sm font-bold group-hover:text-slate-500 transition">&rsaquo;</span>
                </a>

                <!-- Klaim Saya -->
                <a href="{{ route('claims.index') }}" class="flex items-center justify-between p-3 rounded-2xl bg-white hover:bg-amber-50/50 border border-slate-100/90 transition group shadow-2xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#FFF3E8] text-[#EAA023] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-[#EAA023] transition">Klaim Saya</div>
                            <div class="text-[11px] text-slate-400">Pantau status klaim barang</div>
                        </div>
                    </div>
                    <span class="text-slate-300 text-sm font-bold group-hover:text-slate-500 transition">&rsaquo;</span>
                </a>

                <!-- Fitur Keluar (Logout) di Aksi Cepat -->
                <a href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin keluar dari akun?')" class="flex items-center justify-between p-3 rounded-2xl bg-white hover:bg-rose-50 border border-slate-100/90 transition group shadow-2xs">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-rose-600 transition">Keluar Akun</div>
                            <div class="text-[11px] text-slate-400">Logout dari sesi ini</div>
                        </div>
                    </div>
                    <span class="text-slate-300 text-sm font-bold group-hover:text-rose-400 transition">&rsaquo;</span>
                </a>
            </div>
        </div>

        <!-- Card: Ringkasan Aktivitas (Grid 2x2 Warna Pastel Sesuai Figma) -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-100 space-y-4">
            <h3 class="text-sm font-bold text-slate-900">Ringkasan Aktivitas</h3>

            <div class="grid grid-cols-2 gap-3.5">
                <!-- Total Laporan (Putih Netral) -->
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-2xs">
                    <div class="text-2xl font-black text-slate-900">{{ $stats['total_laporan'] }}</div>
                    <div class="text-[11px] font-medium text-slate-400 mt-0.5">Total Laporan</div>
                </div>

                <!-- Barang Ditemukan (Mint Hijau Pastel) -->
                <div class="bg-[#EAF7EE] rounded-2xl p-4">
                    <div class="text-2xl font-black text-[#1F8A4C]">{{ $stats['barang_ditemukan'] }}</div>
                    <div class="text-[11px] font-semibold text-[#2E7D32] mt-0.5">Barang Ditemukan</div>
                </div>

                <!-- Klaim Aktif (Lavender Ungu Pastel) -->
                <div class="bg-[#EEF0FA] rounded-2xl p-4">
                    <div class="text-2xl font-black text-[#3B4CA8]">{{ $stats['klaim_aktif'] }}</div>
                    <div class="text-[11px] font-semibold text-[#4C5EBE] mt-0.5">Klaim Aktif</div>
                </div>

                <!-- Notifikasi (Peach Oranye Pastel) -->
                <div class="bg-[#FDF2E9] rounded-2xl p-4">
                    <div class="text-2xl font-black text-[#C27803]">{{ $stats['notifikasi'] }}</div>
                    <div class="text-[11px] font-semibold text-[#C27803] mt-0.5">Notifikasi</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection