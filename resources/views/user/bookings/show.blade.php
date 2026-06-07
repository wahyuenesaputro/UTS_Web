<x-user-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('user.bookings.index') }}" class="text-sm text-slate-400 hover:text-emerald-400 transition flex items-center mb-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Daftar Booking
                </a>
                <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Detail Reservasi</h1>
            </div>
            
            <div class="mt-4 sm:mt-0">
                <span class="font-mono text-sm px-4 py-2 bg-slate-900 border border-slate-800 rounded-xl font-bold text-slate-200">
                    {{ $booking->kode_booking }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Details Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Main Info Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                    <h2 class="text-lg font-bold text-slate-200 mb-4 pb-2 border-b border-slate-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Informasi Reservasi
                    </h2>
                    
                    <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                        <div>
                            <span class="text-xs text-slate-500 block">Lapangan</span>
                            <span class="text-sm font-semibold text-slate-200">{{ $booking->field->nama_lapangan }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block">Jenis Lapangan</span>
                            <span class="text-sm font-semibold text-slate-200">{{ $booking->field->jenis_lapangan }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block">Tanggal Bermain</span>
                            <span class="text-sm font-semibold text-slate-200">{{ $booking->tanggal->translatedFormat('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block">Durasi Sewa</span>
                            <span class="text-sm font-semibold text-slate-200">{{ $booking->durasi }} Jam</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block">Waktu Sewa</span>
                            <span class="text-sm font-semibold text-emerald-400">{{ substr($booking->jam_mulai, 0, 5) }} - {{ substr($booking->jam_selesai, 0, 5) }} WIB</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block">Total Biaya</span>
                            <span class="text-sm font-bold text-emerald-400">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between">
                        <span class="text-xs text-slate-500">Status Reservasi</span>
                        <div>
                            @if ($booking->status === 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-950 text-amber-400 border border-amber-800">Pending</span>
                            @elseif ($booking->status === 'disetujui')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-950 text-emerald-400 border border-emerald-800">Disetujui</span>
                            @elseif ($booking->status === 'selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-950 text-blue-400 border border-blue-800">Selesai</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-rose-950 text-rose-400 border border-rose-800">Dibatalkan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Review Section (If approved or completed) -->
                @if ($booking->status === 'selesai' || $booking->status === 'disetujui')
                    @php
                        $userReview = \App\Models\Review::where('user_id', Auth::id())
                            ->where('field_id', $booking->field_id)
                            ->first();
                    @endphp

                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
                        <h2 class="text-lg font-bold text-slate-200 mb-4 pb-2 border-b border-slate-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            Ulasan Lapangan
                        </h2>

                        @if ($userReview)
                            <div class="bg-slate-950/40 p-4 border border-slate-800 rounded-2xl">
                                <div class="flex items-center text-amber-400 mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $userReview->rating ? 'fill-current' : 'text-slate-700' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <p class="text-sm text-slate-300 italic">"{{ $userReview->komentar }}"</p>
                            </div>
                        @else
                            <form action="{{ route('user.reviews.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="field_id" value="{{ $booking->field_id }}">
                                
                                <div>
                                    <label for="rating" class="block text-xs text-slate-400 mb-1">Rating Lapangan (1 - 5)</label>
                                    <select name="rating" id="rating" class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-emerald-500 w-full md:w-1/3">
                                        <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                                        <option value="4">⭐⭐⭐⭐ (Puas)</option>
                                        <option value="3">⭐⭐⭐ (Biasa Aja)</option>
                                        <option value="2">⭐⭐ (Kurang Puas)</option>
                                        <option value="1">⭐ (Sangat Kecewa)</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="komentar" class="block text-xs text-slate-400 mb-1">Tulis Ulasan Anda</label>
                                    <textarea name="komentar" id="komentar" rows="3" required placeholder="Tulis masukan atau kesan Anda bermain di lapangan ini..." class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-emerald-500"></textarea>
                                </div>

                                <button type="submit" class="px-5 py-2.5 rounded-lg text-sm font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-md transition">
                                    Kirim Ulasan
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Payment Column -->
            <div class="space-y-6">
                <!-- Payment Status Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
                    <h2 class="text-lg font-bold text-slate-200 mb-4 pb-2 border-b border-slate-800 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Pembayaran
                    </h2>

                    @if (!$booking->payment || !$booking->payment->bukti_pembayaran)
                        <div class="text-center py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-950 text-rose-400 border border-rose-800 mb-4">Belum Dibayar</span>
                            <p class="text-xs text-slate-400 leading-relaxed mb-6">Untuk mengonfirmasi pesanan Anda, harap lakukan pembayaran penuh sebesar <span class="text-emerald-400 font-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>.</p>
                            
                            <a href="{{ route('user.payments.show', $booking->id) }}" class="block w-full py-3 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white text-center transition shadow-lg shadow-emerald-950/20 text-sm">
                                Lakukan Pembayaran
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500">Status Pembayaran:</span>
                                @if ($booking->payment->status === 'pending')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-950 text-amber-400 border border-amber-800">Menunggu Verifikasi</span>
                                @elseif ($booking->payment->status === 'berhasil')
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-950 text-emerald-400 border border-emerald-800">Pembayaran Sukses</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-950 text-rose-400 border border-rose-800">Pembayaran Ditolak</span>
                                @endif
                            </div>
                            
                            <div class="text-xs text-slate-500">
                                <div>Metode: {{ $booking->payment->metode_pembayaran }}</div>
                                <div class="mt-1">Diunggah: {{ $booking->payment->updated_at->translatedFormat('d F Y H:i') }} WIB</div>
                            </div>

                            <div class="border-t border-slate-800 pt-4">
                                <a href="{{ asset('storage/' . $booking->payment->bukti_pembayaran) }}" target="_blank" class="block w-full text-center py-2.5 rounded-lg border border-slate-700 text-xs text-slate-300 hover:bg-slate-800 font-semibold transition">
                                    Lihat Bukti Unggahan
                                </a>
                            </div>

                            @if ($booking->payment->status === 'ditolak')
                                <a href="{{ route('user.payments.show', $booking->id) }}" class="block w-full py-2.5 bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold text-center rounded-lg transition">
                                    Unggah Bukti Baru
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
