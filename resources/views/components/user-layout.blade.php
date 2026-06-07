<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SMART-SMASH') }}</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased min-h-screen flex flex-col">

    <!-- Top Navbar -->
    <nav class="bg-slate-900 border-b border-slate-800 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo + Nav Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('welcome') }}" class="text-xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent tracking-wider shrink-0">
                        SMART-SMASH
                    </a>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('user.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ Route::is('user.dashboard') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Dashboard</a>
                        <a href="{{ route('user.bookings.create') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ Route::is('user.bookings.create') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Pesan Lapangan</a>
                        <a href="{{ route('user.bookings.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ Route::is('user.bookings.index') || Route::is('user.bookings.show') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Reservasi Saya</a>
                    </div>
                </div>

                <!-- Right: User info + Logout -->
                <div class="hidden md:flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <img class="w-8 h-8 rounded-full object-cover ring-2 ring-emerald-500"
                             src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=10b981&color=fff' }}"
                             alt="Avatar">
                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-200 hover:text-emerald-400 transition max-w-[140px] truncate">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                    <span class="h-4 w-px bg-slate-700"></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300 transition">Keluar</button>
                    </form>
                </div>

                <!-- Mobile hamburger -->
                <button id="mobile-nav-btn" class="md:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-nav-menu" class="hidden md:hidden border-t border-slate-800 bg-slate-900">
            <div class="px-3 pt-2 pb-3 space-y-1">
                <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">Dashboard</a>
                <a href="{{ route('user.bookings.create') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">Pesan Lapangan</a>
                <a href="{{ route('user.bookings.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">Reservasi Saya</a>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-rose-400 hover:bg-slate-800 transition">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} SMART-SMASH Badminton Court Reservation System. All rights reserved.
        </div>
    </footer>

    <!-- SweetAlert2 Flash Messages -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('success')), background: '#1e293b', color: '#f8fafc', confirmButtonColor: '#10b981', timer: 3000, timerProgressBar: true });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: @json(session('error')), background: '#1e293b', color: '#f8fafc', confirmButtonColor: '#ef4444' });
        @endif

        const btn = document.getElementById('mobile-nav-btn');
        const menu = document.getElementById('mobile-nav-menu');
        if (btn && menu) btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    });
    </script>
</body>
</html>
