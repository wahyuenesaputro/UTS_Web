<x-admin-layout>
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Laporan Keuangan & Reservasi</h1>
            <p class="text-slate-400 text-sm mt-1">Unduh laporan pendapatan dan booking dalam format dokumen PDF.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 md:p-8 shadow-2xl">
            <form action="{{ route('admin.reports.generate') }}" method="POST" target="_blank" class="space-y-6">
                @csrf

                <div>
                    <label for="tipe_laporan" class="block text-sm font-semibold text-slate-300 mb-2">Tipe Periode Laporan</label>
                    <select name="tipe_laporan" id="tipe_laporan" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                        <option value="harian" {{ old('tipe_laporan') === 'harian' ? 'selected' : '' }}>Harian (Tanggal Spesifik)</option>
                        <option value="bulanan" {{ old('tipe_laporan') === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="tahunan" {{ old('tipe_laporan') === 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>

                <!-- Daily Option -->
                <div id="container-harian" class="space-y-2">
                    <label for="tanggal" class="block text-sm font-semibold text-slate-300">Pilih Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                           class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                    @error('tanggal')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Monthly & Yearly options -->
                <div id="container-bulanan-tahunan" class="grid grid-cols-2 gap-6 hidden">
                    <div id="wrapper-bulan">
                        <label for="bulan" class="block text-sm font-semibold text-slate-300 mb-2">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ old('bulan', date('n')) == $m ? 'selected' : '' }}>
                                    {{ Carbon\Carbon::createFromDate(null, $m, 1)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                        @error('bulan')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="wrapper-tahun">
                        <label for="tahun" class="block text-sm font-semibold text-slate-300 mb-2">Pilih Tahun</label>
                        <select name="tahun" id="tahun" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-emerald-500 transition">
                            @for ($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ old('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                        @error('tahun')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 rounded-xl font-bold bg-emerald-600 hover:bg-emerald-500 text-white shadow-xl shadow-emerald-950/20 transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Ekspor Laporan PDF
                </button>
            </form>
        </div>
    </div>

    <!-- Toggle scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('tipe_laporan');
            const dailyContainer = document.getElementById('container-harian');
            const monthlyYearlyContainer = document.getElementById('container-bulanan-tahunan');
            const monthWrapper = document.getElementById('wrapper-bulan');

            function toggleFields() {
                const val = typeSelect.value;
                if (val === 'harian') {
                    dailyContainer.classList.remove('hidden');
                    monthlyYearlyContainer.classList.add('hidden');
                } else if (val === 'bulanan') {
                    dailyContainer.classList.add('hidden');
                    monthlyYearlyContainer.classList.remove('hidden');
                    monthWrapper.classList.remove('hidden');
                } else if (val === 'tahunan') {
                    dailyContainer.classList.add('hidden');
                    monthlyYearlyContainer.classList.remove('hidden');
                    monthWrapper.classList.add('hidden');
                }
            }

            typeSelect.addEventListener('change', toggleFields);
            toggleFields(); // Init
        });
    </script>
</x-admin-layout>
