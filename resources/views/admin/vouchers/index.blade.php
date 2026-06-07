<x-admin-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Kelola Voucher Diskon</h1>
            <p class="text-slate-400 text-sm mt-1">Buat dan kelola kode voucher diskon yang dapat digunakan customer saat booking.</p>
        </div>
        <div>
            <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Buat Voucher Baru
            </a>
        </div>
    </div>

    <!-- Search filter -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 mb-8 shadow-xl">
        <form action="{{ route('admin.vouchers.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode Voucher..." 
                       class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition uppercase">
                <div class="absolute left-3.5 top-3.5 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
            
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold bg-slate-800 hover:bg-slate-700 transition border border-slate-700">Cari</button>
                @if (request('search'))
                    <a href="{{ route('admin.vouchers.index') }}" class="w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold bg-slate-855 hover:bg-slate-800 text-slate-400 text-center transition">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Vouchers Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Kode Voucher</th>
                        <th class="px-6 py-4 text-right">Potongan Harga</th>
                        <th class="px-6 py-4">Tanggal Mulai</th>
                        <th class="px-6 py-4">Tanggal Kedaluwarsa</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($vouchers as $voucher)
                        <tr class="hover:bg-slate-850/30 transition">
                            <td class="px-6 py-4 font-mono font-bold text-slate-200">
                                {{ $voucher->kode_voucher }}
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-emerald-400">
                                Rp {{ number_format($voucher->diskon, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                {{ $voucher->tanggal_mulai->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                {{ $voucher->tanggal_berakhir->translatedFormat('d F Y') }}
                                @if ($voucher->tanggal_berakhir->isPast())
                                    <span class="ml-2 text-[10px] bg-rose-950 text-rose-400 px-1.5 py-0.5 rounded font-bold">Expired</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($voucher->status === 'aktif')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-950 text-emerald-400 border border-emerald-900">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-900">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="text-xs font-semibold px-2.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg transition border border-slate-750">Edit</a>
                                    
                                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus voucher ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold px-2.5 py-1.5 bg-rose-950 text-rose-400 hover:bg-rose-900 border border-rose-900 rounded-lg transition">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Voucher tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($vouchers->hasPages())
            <div class="px-6 py-4 border-t border-slate-850 bg-slate-900/50">
                {{ $vouchers->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
