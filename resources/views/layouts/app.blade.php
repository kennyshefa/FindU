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
                            blue: '#1D4ED8',
                            lightBlue: '#2563EB',
                            orange: '#EAA023',
                            orangeHover: '#D97706',
                            bg: '#EBF3FF',
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
<body class="min-h-screen text-slate-800 flex flex-col justify-between">
    <!-- Navbar Header -->
    <header class="bg-white border-b border-blue-50/70 sticky top-0 z-40 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('claims.index') }}" class="flex items-center gap-2 text-blue-600 font-bold text-xl tracking-tight">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                </svg>
                <span>FindU</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-7 text-sm font-medium">
                <a href="{{ route('claims.index') }}" class="{{ request()->routeIs('claims.index') && request()->is('/') ? 'text-amber-500 font-semibold' : 'text-slate-600 hover:text-blue-600' }} transition-colors">
                    Beranda
                </a>
                <a href="#" class="text-slate-600 hover:text-blue-600 transition-colors">
                    Cari
                </a>
                <a href="{{ route('claims.index') }}" class="{{ request()->routeIs('claims.index') ? 'text-amber-500 font-semibold' : 'text-slate-600 hover:text-blue-600' }} transition-colors">
                    Riwayat
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-blue-600 font-semibold relative after:content-[\'\'] after:absolute after:-bottom-[21px] after:left-0 after:right-0 after:h-0.5 after:bg-blue-600' : 'text-slate-600 hover:text-blue-600' }} transition-colors">
                    Tentang Kami
                </a>
            </nav>

            <!-- User Button (Nadia) -> Profile -->
            <div>
                <a href="{{ route('profile') }}" class="inline-flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-6 py-2 rounded-xl transition-all shadow-sm">
                    Nadia
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow @yield('container-class', 'max-w-4xl mx-auto px-4 sm:px-6 py-8')">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-6 text-center text-xs text-slate-400 border-t border-blue-50/50 mt-12 bg-white/50">
        <p>&copy; 2026 FindU &middot; Pemrograman Web C &middot; Universitas Brawijaya</p>
    </footer>
</body>
</html>
