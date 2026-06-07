<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Dashboard Analisis</h1>
        <p class="text-slate-400 text-sm mt-1">Ikhtisar performa bisnis reservasi lapangan badminton Anda secara live.</p>
    </div>

    <!-- Analytics Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Card 1: Total Users -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Total Customer</p>
                <p class="text-3xl font-extrabold mt-2 text-slate-200">{{ $totalUser }}</p>
                <span class="text-[10px] text-emerald-400 font-semibold block mt-1">Customer Terdaftar</span>
            </div>
            <div class="p-4 bg-emerald-950/40 border border-emerald-800/30 text-emerald-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>

        <!-- Card 2: Total Courts -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Total Lapangan</p>
                <p class="text-3xl font-extrabold mt-2 text-slate-200">{{ $totalField }}</p>
                <span class="text-[10px] text-teal-400 font-semibold block mt-1">Badminton Court</span>
            </div>
            <div class="p-4 bg-teal-950/40 border border-teal-800/30 text-teal-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>

        <!-- Card 3: Total Bookings -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Total Booking</p>
                <p class="text-3xl font-extrabold mt-2 text-slate-200">{{ $totalBooking }}</p>
                <span class="text-[10px] text-indigo-400 font-semibold block mt-1">Akumulasi Seluruh Sewa</span>
            </div>
            <div class="p-4 bg-indigo-950/40 border border-indigo-800/30 text-indigo-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>

        <!-- Card 4: Bookings Today -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Booking Hari Ini</p>
                <p class="text-3xl font-extrabold mt-2 text-slate-200">{{ $bookingHariIni }}</p>
                <span class="text-[10px] text-amber-400 font-semibold block mt-1">Untuk Tanggal Hari Ini</span>
            </div>
            <div class="p-4 bg-amber-950/40 border border-amber-800/30 text-amber-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <!-- Card 5: Income Today -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Pendapatan Hari Ini</p>
                <p class="text-3xl font-extrabold mt-2 text-emerald-400">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                <span class="text-[10px] text-slate-400 block mt-1">Sewa Sukses Hari Ini</span>
            </div>
            <div class="p-4 bg-emerald-950/40 border border-emerald-800/30 text-emerald-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- Card 6: Income This Month -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-lg relative overflow-hidden">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-500 tracking-wider">Pendapatan Bulan Ini</p>
                <p class="text-3xl font-extrabold mt-2 text-emerald-400">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
                <span class="text-[10px] text-teal-400 font-semibold block mt-1">Bulan Operasional Ini</span>
            </div>
            <div class="p-4 bg-teal-950/40 border border-teal-800/30 text-teal-400 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
        </div>
    </div>

    <!-- Graphical Panel -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-xl">
        <h2 class="text-lg font-bold text-slate-200 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Grafik Transaksi Bulanan (6 Bulan Terakhir)
        </h2>
        
        <div class="h-[350px]">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <!-- Script to Init Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyChart').getContext('2d');
            
            const months = {!! json_encode($months) !!};
            const revenues = {!! json_encode($revenues) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Pendapatan (Rupiah)',
                        data: revenues,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#94a3b8',
                                font: {
                                    family: 'Inter',
                                    size: 12
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: '#1e293b'
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    family: 'Inter'
                                },
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: '#1e293b'
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    family: 'Inter'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>
