<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindU - @yield('title', 'Lost & Found Kampus')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: '#EAA023',
                            orangeHover: '#D97706',
                            orangeLight: '#FFF4EA',
                            orangeBorder: '#F59E0B',
                            blue: '#1E40AF',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #EBF3FF;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 flex flex-col justify-between antialiased">

    @php
        $authParam = request()->query('auth');
        if ($authParam !== null) {
            $userLoggedIn = ($authParam === '1');
            session(['is_logged_in' => $userLoggedIn]);
        } else {
            $userLoggedIn = session('is_logged_in', true);
        }
    @endphp

    <!-- Floating Navbar Card Sesuai Figma -->
    <header class="max-w-6xl mx-auto w-full px-4 sm:px-6 pt-4 sticky top-0 z-50">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-6 sm:px-8 py-3 flex items-center justify-between">
            <!-- Brand Logo FindU Asli dari Figma -->
            <a href="{{ route('home') }}" class="flex items-center py-1">
                <img src="{{ asset('images/logo_findu_clean.png') }}" alt="FindU" class="h-9 w-auto object-contain">
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Beranda
                </a>
                <a href="{{ route('items.search') }}" class="{{ request()->routeIs('items.search') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Cari
                </a>
                <a href="{{ route('claims.index') }}" class="{{ request()->routeIs('claims.index') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Riwayat
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Tentang Kami
                </a>
            </nav>

            <!-- User Button Sesuai Status Login (Login jika belum login, Nadia jika login) -->
            <div class="flex items-center gap-3">
                @if(!$userLoggedIn)
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-[#EAA023] hover:bg-[#D97706] text-white text-sm font-bold px-7 py-2.5 rounded-xl transition-all shadow-xs">
                        Login
                    </a>
                @else
                    <div class="relative group">
                        <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 bg-[#EAA023] hover:bg-[#D97706] text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all shadow-xs">
                            <span>{{ session('user_name', 'Nadia') }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <!-- Dropdown Menu Akun & Logout -->
                        <div class="absolute right-0 mt-1 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-1.5 hidden group-hover:block hover:block z-50">
                            <a href="{{ route('profile') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#EAA023] transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('claims.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#EAA023] transition-colors">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span>Riwayat & Klaim</span>
                            </a>
                            <div class="my-1 border-t border-slate-100"></div>
                            <a href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin keluar dari akun?')" class="flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Keluar (Logout)</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-6xl mx-auto w-full px-4 sm:px-6 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-6 text-center text-xs text-slate-400 mt-8">
        <p>&copy; 2026 FindU &middot; Pemrograman Web C &middot; Universitas Brawijaya</p>
    </footer>

</body>
</html>
