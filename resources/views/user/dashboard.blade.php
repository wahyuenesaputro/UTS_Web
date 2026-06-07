<x-user-layout>
    <!-- Welcome Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-slate-400 text-sm mt-1">Pantau reservasi lapangan badminton Anda secara real-time di sini.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('user.bookings.create') }}" class="inline-flex items-center px-5 py-3 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Pesan Lapangan Baru
            </a>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Card 1: Active Bookings -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl"></div>
            <div>
                <p class="text-sm font-medium text-slate-500">Booking Aktif</p>
                <p class="text-3xl font-extrabold mt-2 text-slate-100">{{ $bookingAktif }}</p>
                <p class="text-xs text-slate-500 mt-2">Menunggu bermain atau konfirmasi pembayaran</p>
            </div>
            <div class="p-4 bg-emerald-950/50 rounded-2xl border border-emerald-800/30 text-emerald-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <!-- Card 2: Total Spending -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-teal-500/5 rounded-full blur-2xl"></div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Transaksi Selesai</p>
                <p class="text-3xl font-extrabold mt-2 text-emerald-400">Rp {{ number_format($totalTransaksi, 0, ',', '.') }}</p>
                <p class="text-xs text-slate-500 mt-2">Akumulasi sewa lapangan yang sukses</p>
            </div>
            <div class="p-4 bg-teal-950/50 rounded-2xl border border-teal-800/30 text-teal-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-lg">
        <div class="px-6 py-5 border-b border-slate-800 flex justify-between items-center bg-slate-900/50">
            <h2 class="text-lg font-bold text-slate-200">Riwayat Booking Terakhir</h2>
            <a href="{{ route('user.bookings.index') }}" class="text-sm font-medium text-emerald-400 hover:text-emerald-300">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Kode Booking</th>
                        <th class="px-6 py-4">Lapangan</th>
                        <th class="px-6 py-4">Jadwal Main</th>
                        <th class="px-6 py-4 text-right">Total Harga</th>
                        <th class="px-6 py-4 text-center">Status Booking</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($riwayatBooking as $booking)
                        <tr class="hover:bg-slate-850/30 transition">
                            <td class="px-6 py-4 font-mono font-bold text-slate-300">
                                {{ $booking->kode_booking }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-200">{{ $booking->field->nama_lapangan }}</div>
                                <div class="text-xs text-slate-500">{{ $booking->field->jenis_lapangan }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <div>{{ $booking->tanggal->translatedFormat('d F Y') }}</div>
                                <div class="text-xs text-emerald-500">{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} WIB ({{ $booking->durasi }} Jam)</div>
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-200">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($booking->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-950 text-amber-400 border border-amber-800">Pending</span>
                                @elseif ($booking->status === 'disetujui')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-950 text-emerald-400 border border-emerald-800">Disetujui</span>
                                @elseif ($booking->status === 'selesai')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-950 text-blue-400 border border-blue-800">Selesai</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-950 text-rose-400 border border-rose-800">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('user.bookings.show', $booking->id) }}" class="text-xs font-semibold px-3 py-1.5 bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-200 rounded-lg transition">Detail</a>
                                    
                                    @if ($booking->status === 'pending')
                                        @if (!$booking->payment || !$booking->payment->bukti_pembayaran)
                                            <a href="{{ route('user.payments.show', $booking->id) }}" class="text-xs font-semibold px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg transition shadow-md shadow-emerald-950/20">Bayar</a>
                                        @elseif ($booking->payment->status === 'ditolak')
                                            <a href="{{ route('user.payments.show', $booking->id) }}" class="text-xs font-semibold px-3 py-1.5 bg-rose-600 hover:bg-rose-500 text-white rounded-lg transition">Tolak / Re-upload</a>
                                        @else
                                            <span class="text-xs text-slate-500">Dicek</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <span>Belum ada riwayat pemesanan lapangan.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-user-layout>
