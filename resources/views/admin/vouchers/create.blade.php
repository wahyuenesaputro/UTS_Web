<x-admin-layout>
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.vouchers.index') }}" class="text-sm text-slate-400 hover:text-emerald-400 transition flex items-center mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Voucher
            </a>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Buat Voucher Baru</h1>
            <p class="text-slate-400 text-sm mt-1">Tambahkan kode diskon baru yang dapat digunakan oleh customer.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 md:p-8 shadow-2xl">
            <form action="{{ route('admin.vouchers.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="kode_voucher" class="block text-sm font-semibold text-slate-300 mb-2">Kode Voucher</label>
                        <input type="text" name="kode_voucher" id="kode_voucher" value="{{ old('kode_voucher') }}" placeholder="Contoh: PROMOHEBAT" required
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition uppercase @error('kode_voucher') border-rose-500 @enderror">
                        @error('kode_voucher')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="diskon" class="block text-sm font-semibold text-slate-300 mb-2">Potongan Diskon (Rp)</label>
                        <input type="number" name="diskon" id="diskon" value="{{ old('diskon') }}" placeholder="Contoh: 15000" required min="0"
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('diskon') border-rose-500 @enderror">
                        @error('diskon')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-semibold text-slate-300 mb-2">Tanggal Mulai Berlaku</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('tanggal_mulai') border-rose-500 @enderror">
                        @error('tanggal_mulai')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_berakhir" class="block text-sm font-semibold text-slate-300 mb-2">Tanggal Kedaluwarsa</label>
                        <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" required
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('tanggal_berakhir') border-rose-500 @enderror">
                        @error('tanggal_berakhir')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">Status Voucher</label>
                    <select name="status" id="status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                        <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ old('status') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('admin.vouchers.index') }}" class="py-3 px-6 rounded-xl font-semibold bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-300 transition text-sm">Batal</a>
                    <button type="submit" class="py-3 px-8 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-xl shadow-emerald-950/20 transition text-sm">Buat Voucher</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
