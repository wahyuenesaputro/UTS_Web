<x-app-layout>
    <div class="flex h-screen overflow-hidden bg-slate-950 text-slate-100">
        <!-- Sidebar -->
        <aside class="hidden md:flex flex-col w-64 bg-slate-900 border-r border-slate-800 shrink-0">
            <!-- Brand Logo -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <span class="text-xl font-bold bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">SMART-SMASH</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.fields.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.fields.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Data Lapangan
                </a>

                <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.bookings.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Data Booking
                </a>

                <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.payments.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Verifikasi Pembayaran
                </a>

                <a href="{{ route('admin.reviews.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.reviews.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                    Kelola Ulasan
                </a>

                <a href="{{ route('admin.vouchers.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.vouchers.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    Kelola Voucher
                </a>

                <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition {{ Route::is('admin.reports.*') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Laporan Keuangan
                </a>
            </nav>

            <!-- Sidebar User Profile Footer -->
            <div class="p-4 border-t border-slate-800 bg-slate-900/50">
                <div class="flex items-center space-x-3">
                    <img class="w-10 h-10 rounded-full object-cover border border-emerald-500" 
                         src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff' }}" 
                         alt="Avatar">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-200 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 w-full overflow-hidden">
            <!-- Top Navbar -->
            <header class="flex items-center justify-between px-6 py-4 bg-slate-900 border-b border-slate-800">
                <!-- Mobile Sidebar Toggle -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-btn" class="text-slate-400 hover:text-slate-100 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <span class="ml-3 text-lg font-semibold bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">SMART-SMASH</span>
                </div>

                <div class="hidden md:flex items-center">
                    <span class="text-sm text-slate-400">Panel Administrator</span>
                </div>

                <!-- Profile Dropdown and Actions -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('welcome') }}" target="_blank" class="text-sm text-slate-400 hover:text-slate-100 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Lihat Website
                    </a>
                    
                    <span class="h-4 w-px bg-slate-800"></span>

                    <a href="{{ route('profile.edit') }}" class="text-sm text-slate-400 hover:text-slate-100">Profil</a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-rose-400 hover:text-rose-300 font-medium">
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Panel View Slot -->
            <main class="flex-1 overflow-y-auto bg-slate-950 p-6 md:p-8">
                <!-- Page Header (If any) -->
                @if (isset($header))
                    <div class="mb-6">
                        {{ $header }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Mobile Drawer Script -->
    <div id="mobile-sidebar" class="fixed inset-0 z-50 flex hidden">
        <!-- Backdrop -->
        <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm"></div>
        
        <!-- Sidebar Content -->
        <aside class="relative flex flex-col w-64 bg-slate-900 h-full border-r border-slate-800">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-800">
                <span class="text-xl font-bold bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">SMART-SMASH</span>
                <button id="close-mobile-menu" class="text-slate-400 hover:text-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Dashboard</a>
                <a href="{{ route('admin.fields.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Data Lapangan</a>
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Data Booking</a>
                <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Verifikasi Pembayaran</a>
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Kelola Ulasan</a>
                <a href="{{ route('admin.vouchers.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Kelola Voucher</a>
                <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-slate-400 hover:bg-slate-800 hover:text-slate-100">Laporan Keuangan</a>
            </nav>
        </aside>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const closeBtn = document.getElementById('close-mobile-menu');
            const sidebar = document.getElementById('mobile-sidebar');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');

            if (menuBtn && sidebar && backdrop && closeBtn) {
                menuBtn.addEventListener('click', () => sidebar.classList.remove('hidden'));
                closeBtn.addEventListener('click', () => sidebar.classList.add('hidden'));
                backdrop.addEventListener('click', () => sidebar.classList.add('hidden'));
            }
        });
    </script>
</x-app-layout>
