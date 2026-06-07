<x-user-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('user.bookings.show', $booking->id) }}" class="text-sm text-slate-400 hover:text-emerald-400 transition flex items-center mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Detail Booking
            </a>
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Instruksi Pembayaran</h1>
            <p class="text-slate-400 text-sm mt-1">Selesaikan pembayaran Anda untuk konfirmasi pesanan lapangan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Payment Instructions -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl space-y-6">
                <h2 class="text-lg font-bold text-slate-200 pb-2 border-b border-slate-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pilihan Pembayaran
                </h2>

                <div class="space-y-4">
                    <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-2xl">
                        <p class="text-xs font-bold text-emerald-400 tracking-wider uppercase mb-1">Transfer Bank</p>
                        <p class="text-sm font-semibold text-slate-200">Bank BCA: 867-0091-222</p>
                        <p class="text-xs text-slate-500 mt-1">Atas Nama: SMART-SMASH BADMINTON</p>
                    </div>

                    <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-2xl">
                        <p class="text-xs font-bold text-emerald-400 tracking-wider uppercase mb-1">QRIS / E-Wallet</p>
                        <p class="text-sm font-semibold text-slate-200">GOPAY / OVO / DANA: 0812-3456-7890</p>
                        <div class="mt-3 w-36 h-36 bg-white p-2 rounded-xl flex items-center justify-center mx-auto">
                            <!-- Dummy QR Code placeholder using a neat clean styling -->
                            <div class="text-[10px] text-slate-950 font-bold border-2 border-slate-950 p-2 text-center select-none leading-none">
                                QRIS MERCHANT<br>
                                <span class="text-lg">SMART<br>SMASH</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-slate-950/40 border border-slate-800 rounded-2xl text-xs text-slate-400 leading-relaxed">
                    <strong>PENTING:</strong> Pastikan nominal transfer pas dengan jumlah tagihan: <span class="text-emerald-400 font-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>. Simpan bukti transfer Anda untuk diunggah di form sebelah.
                </div>
            </div>

            <!-- Upload Form -->
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
                <h2 class="text-lg font-bold text-slate-200 pb-2 border-b border-slate-800 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    Unggah Bukti Pembayaran
                </h2>

                <form action="{{ route('user.payments.upload', $booking->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="metode_pembayaran" class="block text-sm font-semibold text-slate-300 mb-2">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                            <option value="Transfer Bank" {{ (old('metode_pembayaran', $booking->payment->metode_pembayaran ?? '') == 'Transfer Bank') ? 'selected' : '' }}>Transfer Bank BCA</option>
                            <option value="QRIS" {{ (old('metode_pembayaran', $booking->payment->metode_pembayaran ?? '') == 'QRIS') ? 'selected' : '' }}>QRIS Code</option>
                            <option value="E-Wallet" {{ (old('metode_pembayaran', $booking->payment->metode_pembayaran ?? '') == 'E-Wallet') ? 'selected' : '' }}>E-Wallet (GoPay/OVO/Dana)</option>
                        </select>
                        @error('metode_pembayaran')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="bukti_pembayaran" class="block text-sm font-semibold text-slate-300 mb-2">File Bukti Pembayaran (JPG, PNG, max 2MB)</label>
                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" required
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-400 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-950 file:text-emerald-400 hover:file:bg-emerald-900 focus:outline-none focus:border-emerald-500 transition @error('bukti_pembayaran') border-rose-500 @enderror">
                        @error('bukti_pembayaran')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($booking->payment && $booking->payment->bukti_pembayaran)
                        <div class="p-4 bg-slate-950 border border-slate-800 rounded-2xl">
                            <p class="text-xs text-slate-500 mb-2">Bukti Pembayaran Saat Ini:</p>
                            <a href="{{ asset('storage/' . $booking->payment->bukti_pembayaran) }}" target="_blank" class="block text-center text-xs text-emerald-400 font-semibold hover:underline">
                                Lihat Bukti Unggahan &nearrow;
                            </a>
                        </div>
                    @endif

                    <button type="submit" class="w-full py-3 px-4 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-xl shadow-emerald-950/20 transition">
                        Kirim Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>
