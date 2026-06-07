<x-user-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Reservasi Saya</h1>
            <p class="text-slate-400 text-sm mt-1">Daftar riwayat pemesanan lapangan Anda.</p>
        </div>
        <a href="{{ route('user.bookings.create') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-semibold bg-emerald-600 hover:bg-emerald-500 transition shadow-lg">
            Pesan Lapangan
        </a>
    </div>

    <!-- Bookings Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-lg mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Kode Booking</th>
                        <th class="px-6 py-4">Lapangan</th>
                        <th class="px-6 py-4">Jadwal Main</th>
                        <th class="px-6 py-4 text-right">Total Harga</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Pembayaran</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($bookings as $booking)
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
                                <div class="text-xs text-emerald-400 font-semibold">{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} WIB ({{ $booking->durasi }} Jam)</div>
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
                                @if (!$booking->payment || !$booking->payment->bukti_pembayaran)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-900">Belum Bayar</span>
                                @elseif ($booking->payment->status === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-950 text-amber-400 border border-amber-900">Diproses</span>
                                @elseif ($booking->payment->status === 'berhasil')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-950 text-emerald-400 border border-emerald-900">Berhasil</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-900">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('user.bookings.show', $booking->id) }}" class="text-xs font-semibold px-2.5 py-1.5 bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-200 rounded-lg transition">Detail</a>
                                    
                                    @if ($booking->status === 'pending')
                                        @if (!$booking->payment || !$booking->payment->bukti_pembayaran)
                                            <a href="{{ route('user.payments.show', $booking->id) }}" class="text-xs font-semibold px-2.5 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg transition shadow-md">Bayar</a>
                                        @elseif ($booking->payment->status === 'ditolak')
                                            <a href="{{ route('user.payments.show', $booking->id) }}" class="text-xs font-semibold px-2.5 py-1.5 bg-rose-600 hover:bg-rose-500 text-white rounded-lg transition">Re-upload</a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                Belum ada riwayat pemesanan lapangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        @if ($bookings->hasPages())
            <div class="px-6 py-4 border-t border-slate-850 bg-slate-900/50">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</x-user-layout>
