<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Pemesanan Lapangan (Booking)</h1>
        <p class="text-slate-400 text-sm mt-1">Kelola seluruh aktivitas penyewaan lapangan oleh customer.</p>
    </div>

    <!-- Search & Filters -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 mb-8 shadow-xl">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
            <!-- Search field -->
            <div class="relative w-full md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode Booking atau Nama User..." 
                       class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                <div class="absolute left-3.5 top-3.5 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Field filter -->
            <div>
                <select name="field_id" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">Semua Lapangan</option>
                    @foreach ($fields as $field)
                        <option value="{{ $field->id }}" {{ request('field_id') == $field->id ? 'selected' : '' }}>
                            {{ $field->nama_lapangan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status filter -->
            <div>
                <select name="status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <div class="md:col-span-4 flex justify-end gap-2 pt-2 border-t border-slate-850">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-emerald-600 hover:bg-emerald-500 text-white transition shadow-md">Terapkan Filter</button>
                @if (request('search') || request('field_id') || request('status'))
                    <a href="{{ route('admin.bookings.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-slate-850 hover:bg-slate-800 text-slate-400 text-center transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Bookings Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Kode Booking</th>
                        <th class="px-6 py-4">Nama Pelanggan</th>
                        <th class="px-6 py-4">Lapangan</th>
                        <th class="px-6 py-4">Jadwal Sewa</th>
                        <th class="px-6 py-4 text-right">Total Harga</th>
                        <th class="px-6 py-4 text-center">Status Booking</th>
                        <th class="px-6 py-4 text-center">Pembayaran</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-slate-850/30 transition">
                            <td class="px-6 py-4 font-mono font-bold text-slate-350">
                                {{ $booking->kode_booking }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-200">{{ $booking->user->name }}</div>
                                <div class="text-xs text-slate-500">{{ $booking->user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-200">{{ $booking->field->nama_lapangan }}</div>
                                <div class="text-xs text-slate-500">{{ $booking->field->jenis_lapangan }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-350">
                                <div>{{ $booking->tanggal->translatedFormat('d F Y') }}</div>
                                <div class="text-xs text-emerald-400 font-semibold">{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} WIB ({{ $booking->durasi }} Jam)</div>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-200">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($booking->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-950 text-amber-400 border border-amber-800">Pending</span>
                                @elseif ($booking->status === 'disetujui')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800">Disetujui</span>
                                @elseif ($booking->status === 'selesai')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-950 text-blue-400 border border-blue-800">Selesai</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-950 text-rose-400 border border-rose-800">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if (!$booking->payment || !$booking->payment->bukti_pembayaran)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-950 text-slate-500 border border-slate-850">No Proof</span>
                                @else
                                    <div class="flex flex-col items-center">
                                        <a href="{{ asset('storage/' . $booking->payment->bukti_pembayaran) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:underline">Lihat Bukti</a>
                                        <span class="text-[10px] text-slate-500">Method: {{ $booking->payment->metode_pembayaran }}</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($booking->status === 'pending')
                                    <div class="flex items-center justify-center space-x-2">
                                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" onsubmit="return confirm('Setujui pemesanan lapangan ini?')">
                                            @csrf
                                            <button type="submit" class="text-xs font-semibold px-2.5 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg transition">Setujui</button>
                                        </form>
                                        
                                        <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Batalkan pemesanan lapangan ini?')">
                                            @csrf
                                            <button type="submit" class="text-xs font-semibold px-2.5 py-1.5 bg-rose-950 text-rose-400 hover:bg-rose-900 border border-rose-900 rounded-lg transition">Batal</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                Booking tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($bookings->hasPages())
            <div class="px-6 py-4 border-t border-slate-850 bg-slate-900/50">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
