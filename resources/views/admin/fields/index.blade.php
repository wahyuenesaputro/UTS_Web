<x-admin-layout>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Daftar Lapangan</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola lapangan badminton yang terdaftar di dalam sistem.</p>
        </div>
        <div>
            <a href="{{ route('admin.fields.create') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-bold bg-emerald-600 hover:bg-emerald-500 transition shadow-lg shadow-emerald-900/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Lapangan
            </a>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 mb-8 shadow-xl">
        <form action="{{ route('admin.fields.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
            <!-- Search field -->
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama lapangan atau jenis..." 
                       class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                <div class="absolute left-3.5 top-3.5 text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Status filter -->
            <div class="w-full md:w-48">
                <select name="status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="maintenance" {{ request('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="tidak_aktif" {{ request('status') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold bg-slate-800 hover:bg-slate-700 transition border border-slate-700">Filter</button>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.fields.index') }}" class="w-full md:w-auto px-6 py-3 rounded-xl text-sm font-semibold bg-slate-850 hover:bg-slate-800 transition text-slate-400 text-center">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden shadow-xl mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-semibold uppercase text-slate-500 bg-slate-950/50 border-b border-slate-850">
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Nama Lapangan</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4 text-right">Harga Per Jam</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 text-sm">
                    @forelse ($fields as $field)
                        <tr class="hover:bg-slate-850/30 transition">
                            <td class="px-6 py-4 shrink-0">
                                @if ($field->gambar)
                                    <img src="{{ asset('storage/' . $field->gambar) }}" alt="{{ $field->nama_lapangan }}" class="w-12 h-12 rounded-lg object-cover border border-slate-800">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-slate-950 border border-slate-850 flex items-center justify-center text-slate-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-200">{{ $field->nama_lapangan }}</div>
                                <div class="text-xs text-slate-500 line-clamp-1 max-w-[200px]">{{ $field->deskripsi ?? 'Tidak ada deskripsi.' }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-300">
                                {{ $field->jenis_lapangan }}
                            </td>
                            <td class="px-6 py-4 text-right font-semibold text-slate-200">
                                Rp {{ number_format($field->harga_per_jam, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($field->status === 'tersedia')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-950 text-emerald-400 border border-emerald-900">Tersedia</span>
                                @elseif ($field->status === 'maintenance')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-950 text-amber-400 border border-amber-900">Maintenance</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-900">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('admin.fields.edit', $field->id) }}" class="text-xs font-semibold px-2.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg transition border border-slate-750">Edit</a>
                                    
                                    <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini? Semua data booking terkait juga akan terpengaruh.')">
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
                                Lapangan tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($fields->hasPages())
            <div class="px-6 py-4 border-t border-slate-850 bg-slate-900/50">
                {{ $fields->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
