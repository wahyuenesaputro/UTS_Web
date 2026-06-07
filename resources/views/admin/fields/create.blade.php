<x-admin-layout>
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.fields.index') }}" class="text-sm text-slate-400 hover:text-emerald-400 transition flex items-center mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Lapangan
            </a>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Tambah Lapangan</h1>
            <p class="text-slate-400 text-sm mt-1">Tambahkan lapangan badminton baru ke dalam sistem.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 md:p-8 shadow-2xl">
            <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="nama_lapangan" class="block text-sm font-semibold text-slate-300 mb-2">Nama Lapangan</label>
                    <input type="text" name="nama_lapangan" id="nama_lapangan" value="{{ old('nama_lapangan') }}" placeholder="Contoh: Lapangan A, Lapangan VIP" required
                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('nama_lapangan') border-rose-500 @enderror">
                    @error('nama_lapangan')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis_lapangan" class="block text-sm font-semibold text-slate-300 mb-2">Jenis Lapangan</label>
                        <input type="text" name="jenis_lapangan" id="jenis_lapangan" value="{{ old('jenis_lapangan') }}" placeholder="Contoh: Vinyl, Karpet, Sintetis" required
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('jenis_lapangan') border-rose-500 @enderror">
                        @error('jenis_lapangan')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga_per_jam" class="block text-sm font-semibold text-slate-300 mb-2">Harga Per Jam (Rp)</label>
                        <input type="number" name="harga_per_jam" id="harga_per_jam" value="{{ old('harga_per_jam') }}" placeholder="Contoh: 50000" required min="0"
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('harga_per_jam') border-rose-500 @enderror">
                        @error('harga_per_jam')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-slate-300 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Tuliskan spesifikasi lengkap, fasilitas, atau keunggulan lapangan..."
                              class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('deskripsi') border-rose-500 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-slate-300 mb-2">Foto Lapangan</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-slate-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-950 file:text-emerald-400 hover:file:bg-emerald-900 focus:outline-none focus:border-emerald-500 transition @error('gambar') border-rose-500 @enderror">
                        @error('gambar')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">Status Lapangan</label>
                        <select name="status" id="status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                            <option value="tersedia" {{ old('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance (Perawatan)</option>
                            <option value="tidak_aktif" {{ old('status') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.fields.index') }}" class="py-3 px-6 rounded-xl font-semibold bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-300 transition text-sm">Batal</a>
                    <button type="submit" class="py-3 px-8 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-xl shadow-emerald-950/20 transition text-sm">Simpan Lapangan</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
