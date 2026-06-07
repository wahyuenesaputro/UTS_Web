<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistem Reservasi Lapangan Badminton - SMART-SMASH</title>

        <!-- Google Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="bg-slate-950 text-slate-100 antialiased min-h-screen">
        <!-- Hero Section & Header -->
        <header class="relative overflow-hidden bg-slate-900 border-b border-slate-800">
            <!-- Glassmorphism Navbar -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">
                    <div class="flex items-center">
                        <span class="text-2xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent tracking-wider">SMART-SMASH</span>
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-lg text-sm font-semibold bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-300 hover:text-white text-sm font-medium transition">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-lg text-sm font-semibold bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Hero Banner Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 relative z-10">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800 mb-6">
                            ⚡ Reservasi Mudah & Cepat
                        </span>
                        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                            Main Badminton Tanpa Ribet Antre!
                        </h1>
                        <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                            Sistem booking lapangan badminton modern. Pilih jadwal, lakukan pembayaran digital via QRIS, E-Wallet, atau Transfer Bank, dan lapangan siap Anda gunakan.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            @auth
                                <a href="{{ route('user.bookings.create') }}" class="px-8 py-4 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 transition shadow-xl shadow-emerald-900/40">
                                    Pesan Sekarang
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 transition shadow-xl shadow-emerald-900/40">
                                    Pesan Sekarang
                                </a>
                            @endauth
                            <a href="#lapangan" class="px-8 py-4 rounded-xl font-bold bg-slate-800 hover:bg-slate-700 transition border border-slate-700">
                                Lihat Lapangan
                            </a>
                        </div>
                    </div>
                    
                    <div class="relative flex justify-center">
                        <div class="absolute inset-0 bg-emerald-500/10 blur-[120px] rounded-full"></div>
                        <div class="relative w-full max-w-md bg-gradient-to-tr from-slate-900 to-slate-800 p-8 rounded-3xl border border-slate-800 shadow-2xl">
                            <!-- Badminton racket illustration or glass card styling -->
                            <div class="flex items-center justify-between mb-8">
                                <span class="text-xs text-slate-500">Status Operasional</span>
                                <span class="flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-950 text-emerald-400">BUKA</span>
                            </div>
                            <div class="space-y-4">
                                <div class="p-4 bg-slate-950/50 rounded-2xl border border-slate-800/80">
                                    <p class="text-xs text-slate-400 mb-1">Jam Operasional</p>
                                    <p class="text-sm font-semibold text-slate-100">08:00 - 23:00 WIB</p>
                                </div>
                                <div class="p-4 bg-slate-950/50 rounded-2xl border border-slate-800/80">
                                    <p class="text-xs text-slate-400 mb-1">Metode Pembayaran</p>
                                    <p class="text-sm font-semibold text-slate-100">QRIS, E-Wallet, Transfer Bank</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Fields Section -->
        <section id="lapangan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold mb-4">Daftar Lapangan Tersedia</h2>
                <p class="text-slate-400 max-w-xl mx-auto">Kami menyediakan beberapa jenis lapangan badminton dengan spesifikasi standar profesional.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($fields as $field)
                    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition duration-300 flex flex-col justify-between group shadow-xl">
                        <div>
                            <!-- Court Image -->
                            <div class="h-48 bg-slate-800 relative overflow-hidden">
                                @if ($field->gambar)
                                    <img src="{{ asset('storage/' . $field->gambar) }}" alt="{{ $field->nama_lapangan }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <!-- Fallback svg -->
                                    <div class="w-full h-full flex items-center justify-center bg-slate-800">
                                        <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                @endif
                                <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-semibold bg-slate-950/80 backdrop-blur-sm border border-slate-800 text-emerald-400">
                                    {{ $field->jenis_lapangan }}
                                </span>
                            </div>

                            <!-- Court Info -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold mb-2 text-slate-100">{{ $field->nama_lapangan }}</h3>
                                <p class="text-sm text-slate-400 mb-4 line-clamp-2">{{ $field->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>

                        <!-- Price and Action -->
                        <div class="px-6 pb-6 pt-0">
                            <div class="flex items-center justify-between border-t border-slate-800 pt-4 mb-4">
                                <span class="text-xs text-slate-500">Harga Per Jam</span>
                                <span class="text-lg font-extrabold text-emerald-400">Rp {{ number_format($field->harga_per_jam, 0, ',', '.') }}</span>
                            </div>
                            
                            @auth
                                <a href="{{ route('user.bookings.create', ['field_id' => $field->id]) }}" class="block w-full py-3 rounded-xl font-semibold text-center bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">
                                    Pesan Sekarang
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="block w-full py-3 rounded-xl font-semibold text-center bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">
                                    Pesan Sekarang
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Testimonials/Reviews Section -->
        <section class="bg-slate-900 border-t border-b border-slate-800 py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold mb-4">Ulasan Pelanggan</h2>
                    <p class="text-slate-400 max-w-xl mx-auto">Apa saja kata mereka yang sudah pernah bermain di lapangan badminton kami.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($reviews as $review)
                        <div class="bg-slate-950 border border-slate-800 p-6 rounded-2xl flex flex-col justify-between shadow-xl">
                            <div>
                                <!-- Rating Stars -->
                                <div class="flex items-center mb-4 text-amber-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-700' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <p class="text-slate-300 italic mb-6 leading-relaxed">
                                    "{{ $review->komentar }}"
                                </p>
                            </div>

                            <div class="flex items-center space-x-3 border-t border-slate-850 pt-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full border border-emerald-500" src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=10b981&color=fff" alt="">
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-200">{{ $review->user->name }}</h4>
                                    <span class="text-xs text-slate-500">Bermain di {{ $review->field->nama_lapangan }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-slate-500">
                            Belum ada ulasan yang ditambahkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-slate-950 py-12 text-center text-slate-500 border-t border-slate-900">
            <p class="text-sm">&copy; {{ date('Y') }} SMART-SMASH Badminton Court. All rights reserved.</p>
        </footer>
    </body>
</html>
