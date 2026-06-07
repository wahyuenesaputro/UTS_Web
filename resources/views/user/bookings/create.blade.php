<x-user-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Pesan Lapangan</h1>
            <p class="text-slate-400 text-sm mt-1">Lengkapi data berikut untuk menyewa lapangan badminton.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden">
            <form action="{{ route('user.bookings.store') }}" method="POST">
                @csrf

                <!-- Court Selection -->
                <div class="mb-6">
                    <label for="field_id" class="block text-sm font-semibold text-slate-300 mb-2">Pilih Lapangan</label>
                    <select name="field_id" id="field_id" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('field_id') border-rose-500 @enderror">
                        <option value="">-- Pilih Lapangan --</option>
                        @foreach ($fields as $field)
                            <option value="{{ $field->id }}" 
                                    data-price="{{ $field->harga_per_jam }}"
                                    {{ (old('field_id', $selectedFieldId) == $field->id) ? 'selected' : '' }}>
                                {{ $field->nama_lapangan }} ({{ $field->jenis_lapangan }}) - Rp {{ number_format($field->harga_per_jam, 0, ',', '.') }} / jam
                            </option>
                        @endforeach
                    </select>
                    @error('field_id')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Booking Date -->
                <div class="mb-6">
                    <label for="tanggal" class="block text-sm font-semibold text-slate-300 mb-2">Tanggal Main</label>
                    <input type="date" name="tanggal" id="tanggal" 
                           min="{{ date('Y-m-d') }}"
                           value="{{ old('tanggal', date('Y-m-d')) }}"
                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('tanggal') border-rose-500 @enderror">
                    @error('tanggal')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Start Time and Duration -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="jam_mulai" class="block text-sm font-semibold text-slate-300 mb-2">Jam Mulai</label>
                        <select name="jam_mulai" id="jam_mulai" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('jam_mulai') border-rose-500 @enderror">
                            <option value="">-- Pilih Jam --</option>
                            @for ($h = 8; $h <= 22; $h++)
                                @php
                                    $timeString = sprintf('%02d:00', $h);
                                @endphp
                                <option value="{{ $timeString }}" {{ old('jam_mulai') == $timeString ? 'selected' : '' }}>
                                    {{ $timeString }} WIB
                                </option>
                            @endfor
                        </select>
                        @error('jam_mulai')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="durasi" class="block text-sm font-semibold text-slate-300 mb-2">Durasi Bermain (Jam)</label>
                        <select name="durasi" id="durasi" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition @error('durasi') border-rose-500 @enderror">
                            @for ($d = 1; $d <= 4; $d++)
                                <option value="{{ $d }}" {{ old('durasi') == $d ? 'selected' : '' }}>
                                    {{ $d }} Jam
                                </option>
                            @endfor
                        </select>
                        @error('durasi')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Voucher Code -->
                <div class="mb-8">
                    <label for="kode_voucher" class="block text-sm font-semibold text-slate-300 mb-2">Kode Voucher (Opsional)</label>
                    <div class="flex space-x-3">
                        <input type="text" name="kode_voucher" id="kode_voucher" 
                               value="{{ old('kode_voucher') }}"
                               placeholder="Contoh: DISKON10"
                               class="flex-1 bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition uppercase @error('kode_voucher') border-rose-500 @enderror">
                    </div>
                    @error('kode_voucher')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pricing Preview Box -->
                <div class="p-4 bg-slate-950 border border-slate-800 rounded-2xl mb-8 space-y-2">
                    <div class="flex justify-between text-xs text-slate-500">
                        <span>Biaya Sewa Lapangan</span>
                        <span id="rental-cost">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-xs text-slate-500">
                        <span>Diskon Voucher</span>
                        <span id="voucher-discount" class="text-rose-400">- Rp 0</span>
                    </div>
                    <div class="flex justify-between border-t border-slate-800 pt-2 text-sm font-bold text-slate-200">
                        <span>Estimasi Total</span>
                        <span id="estimated-total" class="text-emerald-400">Rp 0</span>
                    </div>
                </div>

                <div class="flex items-center justify-between space-x-4">
                    <a href="{{ route('user.dashboard') }}" class="w-1/3 py-3 px-4 rounded-xl font-semibold text-center bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-300 transition">
                        Batal
                    </a>
                    <button type="submit" class="w-2/3 py-3 px-4 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-xl shadow-emerald-950/20 transition">
                        Konfirmasi Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Dynamic Price Estimation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fieldSelect = document.getElementById('field_id');
            const durationSelect = document.getElementById('durasi');
            const codeVoucher = document.getElementById('kode_voucher');
            
            const rentalCostEl = document.getElementById('rental-cost');
            const estTotalEl = document.getElementById('estimated-total');

            function calculateEstimate() {
                const selectedOption = fieldSelect.options[fieldSelect.selectedIndex];
                if (!selectedOption || !selectedOption.value) {
                    rentalCostEl.textContent = 'Rp 0';
                    estTotalEl.textContent = 'Rp 0';
                    return;
                }

                const pricePerHour = parseFloat(selectedOption.getAttribute('data-price'));
                const duration = parseInt(durationSelect.value) || 1;
                const total = pricePerHour * duration;

                rentalCostEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
                estTotalEl.textContent = 'Rp ' + total.toLocaleString('id-ID') + ' (Belum Termasuk Voucher)';
            }

            fieldSelect.addEventListener('change', calculateEstimate);
            durationSelect.addEventListener('change', calculateEstimate);
            calculateEstimate();
        });
    </script>
</x-user-layout>
