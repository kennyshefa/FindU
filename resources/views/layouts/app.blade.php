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

    <!-- Floating Navbar Card Sesuai Figma -->
    <header class="max-w-6xl mx-auto w-full px-4 sm:px-6 pt-4 sticky top-0 z-50">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-6 sm:px-8 py-3.5 flex items-center justify-between">
            <!-- Brand Logo FindU Sesuai Figma -->
            <a href="{{ route('claims.index') }}" class="flex items-center gap-2.5 text-slate-900 font-extrabold text-2xl tracking-tight">
                <div class="w-8 h-8 rounded-full bg-blue-900 flex items-center justify-center text-white shadow-xs">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                    </svg>
                </div>
                <span class="text-blue-950 font-black text-xl tracking-tight">FindU</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Beranda
                </a>
                <a href="#" class="text-slate-500 hover:text-slate-900 transition-colors">
                    Cari
                </a>
                <a href="{{ route('claims.index') }}" class="{{ request()->routeIs('claims.index') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Riwayat
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-[#EAA023]' : 'text-slate-500 hover:text-slate-900' }} transition-colors">
                    Tentang Kami
                </a>
            </nav>

            <!-- User Button (Nadia) Sesuai Figma -->
            <div>
                <a href="{{ route('profile') }}" class="inline-flex items-center justify-center bg-[#EAA023] hover:bg-[#D97706] text-white text-sm font-bold px-7 py-2.5 rounded-xl transition-all shadow-xs">
                    Nadia
                </a>
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
