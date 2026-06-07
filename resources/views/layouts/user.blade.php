<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-slate-100 flex flex-col">
        <!-- Top Navbar -->
        <nav class="bg-slate-900 border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo and Main Navigation -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                                <span class="text-xl font-bold bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">SMART-SMASH</span>
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="{{ route('user.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium transition {{ Route::is('user.dashboard') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('user.bookings.create') }}" class="px-3 py-2 rounded-md text-sm font-medium transition {{ Route::is('user.bookings.create') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                    Pesan Lapangan
                                </a>
                                <a href="{{ route('user.bookings.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition {{ Route::is('user.bookings.index') || Route::is('user.bookings.show') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                    Reservasi Saya
                                </a>
                                <a href="{{ route('user.reservasi.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition {{ Route::is('user.reservasi.*') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                                    Reservasi Meja
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- User Actions (Desktop) -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('welcome') }}" class="text-sm text-slate-400 hover:text-slate-100 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Halaman Utama
                        </a>
                        
                        <span class="h-4 w-px bg-slate-800"></span>

                        <div class="relative flex items-center space-x-3">
                            <img class="w-8 h-8 rounded-full object-cover border border-emerald-500" 
                                 src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff' }}" 
                                 alt="Avatar">
                            
                            <div class="flex flex-col text-left">
                                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-200 hover:text-emerald-400 truncate max-w-[120px]">{{ Auth::user()->name }}</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-rose-400 hover:text-rose-300 font-medium">
                                Keluar
                            </button>
                        </form>
                    </div>

                    <!-- Mobile Menu button -->
                    <div class="flex md:hidden">
                        <button id="mobile-nav-toggle" class="bg-slate-800 inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none">
                            <svg class="h-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-nav-menu" class="hidden md:hidden bg-slate-900 border-t border-slate-800">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800 hover:text-white">Dashboard</a>
                    <a href="{{ route('user.bookings.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800 hover:text-white">Pesan Lapangan</a>
                    <a href="{{ route('user.bookings.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800 hover:text-white">Reservasi Saya</a>
                    <a href="{{ route('user.reservasi.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800 hover:text-white">Reservasi Meja</a>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800 hover:text-white">Profil Saya</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="block w-full">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-rose-400 hover:bg-slate-800">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main User Panel Slot -->
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Alert Banner (If any) -->
            @if (isset($header))
                <div class="mb-6">
                    {{ $header }}
                </div>
            @endif

            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-slate-900 border-t border-slate-800 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} SMART-SMASH Badminton Court Reservation System. All rights reserved.
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-nav-toggle');
            const menu = document.getElementById('mobile-nav-menu');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</x-app-layout>
