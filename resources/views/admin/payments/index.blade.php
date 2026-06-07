<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Verifikasi Pembayaran</h1>
        <p class="text-slate-400 text-sm mt-1">Verifikasi bukti transfer atau pembayaran yang diunggah oleh customer.</p>
    </div>

    <!-- Filters -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 mb-8 shadow-xl">
        <form action="{{ route('admin.payments.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
            <div class="w-full md:w-64">
                <label for="status" class="block text-xs text-slate-500 mb-1">Filter Status Pembayaran</label>
                <select name="status" id="status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi)</option>
                    <option value="berhasil" {{ request('status') === 'berhasil' ? 'selected' : '' }}>Berhasil (Diterima)</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            
            <div class="flex gap-2 w-full md:w-auto mt-4 md:mt-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold bg-emerald-600 hover:bg-emerald-500 text-white transition">Filter</button>
                @if (request('status'))
                    <a href="{{ route('admin.payments.index') }}" class="w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold bg-slate-850 hover:bg-slate-800 text-slate-400 text-center transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Payments Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Booking</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4 text-right">Nominal</th>
                        <th class="px-6 py-4 text-center">Bukti Transfer</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($payments as $payment)
                        <tr class="hover:bg-slate-850/30 transition">
                            <td class="px-6 py-4 font-mono font-bold text-slate-350">
                                {{ $payment->booking->kode_booking }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-200">{{ $payment->booking->user->name }}</div>
                                <div class="text-xs text-slate-500">{{ $payment->booking->user->phone }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-300 font-medium">
                                {{ $payment->metode_pembayaran }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-200">
                                Rp {{ number_format($payment->booking->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($payment->bukti_pembayaran)
                                    <div class="flex items-center justify-center">
                                        <a href="{{ asset('storage/' . $payment->bukti_pembayaran) }}" target="_blank" class="group relative block w-14 h-14 border border-slate-800 rounded-lg overflow-hidden shadow-inner">
                                            <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" alt="Bukti" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <span class="text-slate-600 text-xs italic">Belum diupload</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($payment->status === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-950 text-amber-400 border border-amber-900">Pending</span>
                                @elseif ($payment->status === 'berhasil')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-950 text-emerald-400 border border-emerald-900">Diterima</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-900">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($payment->status === 'pending' && $payment->bukti_pembayaran)
                                    <div class="flex items-center justify-center space-x-2">
                                        <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST" onsubmit="return confirm('Verifikasi pembayaran ini sebagai Berhasil?')">
                                            @csrf
                                            <button type="submit" class="text-xs font-semibold px-2.5 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg transition shadow-md">Terima</button>
                                        </form>
                                        
                                        <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST" onsubmit="return confirm('Tolak pembayaran ini?')">
                                            @csrf
                                            <button type="submit" class="text-xs font-semibold px-2.5 py-1.5 bg-rose-950 text-rose-400 hover:bg-rose-900 border border-rose-900 rounded-lg transition">Tolak</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500">No Action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                Pembayaran tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($payments->hasPages())
            <div class="px-6 py-4 border-t border-slate-850 bg-slate-900/50">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
