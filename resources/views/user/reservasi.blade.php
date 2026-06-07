<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-slate-100 flex flex-col">
        {{-- Top Navbar --}}
        <nav class="bg-slate-900 border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                                <span class="text-xl font-bold bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">SMART-SMASH</span>
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="{{ route('user.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium transition text-slate-300 hover:bg-slate-800 hover:text-white">Dashboard</a>
                                <a href="{{ route('user.reservasi.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition {{ Route::is('user.reservasi.*') ? 'bg-slate-800 text-emerald-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Reservasi Meja</a>
                                <a href="{{ route('user.bookings.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition text-slate-300 hover:bg-slate-800 hover:text-white">Reservasi Saya</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="relative flex items-center space-x-3">
                            <img class="w-8 h-8 rounded-full object-cover border border-emerald-500"
                                 src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff' }}"
                                 alt="Avatar">
                            <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-200 hover:text-emerald-400 truncate max-w-[120px]">{{ Auth::user()->name }}</a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-rose-400 hover:text-rose-300 font-medium">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Main Content --}}
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Success Alert --}}
            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center space-x-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Reservasi Meja</h1>
                <p class="mt-1 text-slate-400">Pilih meja, tentukan tanggal & waktu, lalu kirim reservasi Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT: Table Selection + Form --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Table Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="table-grid">
                        @foreach ($tables as $table)
                            <label class="table-card cursor-pointer group block rounded-xl border border-slate-800 bg-slate-900/50 p-5 transition-all duration-200 hover:border-emerald-500/50 hover:bg-slate-800/60 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/10 has-[:checked]:ring-1 has-[:checked]:ring-emerald-500/50">
                                <input type="radio" name="table_id" value="{{ $table->id }}" form="reservasi-form" class="hidden peer" required {{ old('table_id') == $table->id ? 'checked' : '' }}>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-100 group-hover:text-emerald-400 peer-checked:group-[]:text-emerald-400 transition">{{ $table->name }}</h3>
                                        <p class="text-sm text-slate-400 mt-1">
                                            <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            Kapasitas: <span class="font-medium text-slate-200">{{ $table->capacity }} orang</span>
                                        </p>
                                    </div>
                                    <div class="w-10 h-10 rounded-full border-2 border-slate-700 flex items-center justify-center transition peer-checked:group-[]:border-emerald-500 peer-checked:group-[]:bg-emerald-500">
                                        <svg class="w-5 h-5 text-transparent peer-checked:group-[]:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    @error('table_id')
                        <p class="text-rose-400 text-sm">{{ $message }}</p>
                    @enderror

                    {{-- Reservation Form --}}
                    <form id="reservasi-form" method="POST" action="{{ route('user.reservasi.store') }}" class="rounded-xl border border-slate-800 bg-slate-900/50 p-6 space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            {{-- Date --}}
                            <div>
                                <label for="date" class="block text-sm font-medium text-slate-300 mb-1.5">Tanggal</label>
                                <input type="date" id="date" name="date" value="{{ old('date') }}" required min="{{ date('Y-m-d') }}"
                                       class="w-full rounded-lg border border-slate-700 bg-slate-800 text-slate-100 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                @error('date') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- Time --}}
                            <div>
                                <label for="time" class="block text-sm font-medium text-slate-300 mb-1.5">Waktu</label>
                                <input type="time" id="time" name="time" value="{{ old('time') }}" required
                                       class="w-full rounded-lg border border-slate-700 bg-slate-800 text-slate-100 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                @error('time') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- Pax --}}
                            <div>
                                <label for="pax" class="block text-sm font-medium text-slate-300 mb-1.5">Jumlah Orang</label>
                                <input type="number" id="pax" name="pax" value="{{ old('pax') }}" required min="1" placeholder="1"
                                       class="w-full rounded-lg border border-slate-700 bg-slate-800 text-slate-100 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                                @error('pax') <p class="text-rose-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 rounded-lg bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-semibold shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:from-emerald-400 hover:to-teal-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-950">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Reservasi
                        </button>
                    </form>
                </div>

                {{-- RIGHT: My Reservations --}}
                <div class="lg:col-span-1">
                    <div class="rounded-xl border border-slate-800 bg-slate-900/50 p-6">
                        <h2 class="text-lg font-semibold text-slate-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Reservasi Saya
                        </h2>

                        @forelse ($reservations as $r)
                            <div class="mb-3 p-4 rounded-lg bg-slate-800/50 border border-slate-700/50 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-slate-200">{{ $r->table->name }}</span>
                                    @php
                                        $statusColors = [
                                            'pending_admin' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                                            'confirmed'     => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                            'cancelled'     => 'bg-rose-500/10 text-rose-400 border-rose-500/30',
                                        ];
                                        $statusLabels = [
                                            'pending_admin' => 'Menunggu',
                                            'confirmed'     => 'Dikonfirmasi',
                                            'cancelled'     => 'Dibatalkan',
                                        ];
                                    @endphp
                                    <span class="text-xs px-2 py-0.5 rounded-full border {{ $statusColors[$r->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/30' }}">
                                        {{ $statusLabels[$r->status] ?? ucfirst($r->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-slate-400 flex items-center space-x-3">
                                    <span>
                                        <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ \Carbon\Carbon::parse($r->date)->format('d M Y') }}
                                    </span>
                                    <span>
                                        <svg class="w-3.5 h-3.5 inline -mt-0.5 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ \Carbon\Carbon::parse($r->time)->format('H:i') }}
                                    </span>
                                    <span>{{ $r->pax }} org</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto text-slate-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                <p class="text-slate-500 text-sm">Belum ada reservasi.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </main>

        {{-- Footer --}}
        <footer class="bg-slate-900 border-t border-slate-800 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} SMART-SMASH Badminton Court Reservation System. All rights reserved.
            </div>
        </footer>
    </div>
</x-app-layout>
