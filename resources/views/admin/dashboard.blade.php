<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen" x-data="{}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <div class="flex items-center gap-4 mb-2">
                    <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Admin Control Panel</h2>
                </div>
                <p class="text-gray-500 font-medium text-lg">Pantau seluruh aktivitas pemesanan lapangan PadelPoint secara real-time.</p>
            </div>

            <x-alert />

            <!-- Stats Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Pendapatan</p>
                            <h4 class="text-3xl font-black text-indigo-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl hover:shadow-green-500/5 transition-all duration-300">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Booking Hari Ini</p>
                            <h4 class="text-3xl font-black text-green-600">{{ $todayBookings }} <span class="text-sm font-bold text-gray-400 uppercase">Jadwal</span></h4>
                        </div>
                        <div class="p-3 bg-green-50 rounded-xl text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl hover:shadow-orange-500/5 transition-all duration-300">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div class="flex items-start justify-between relative z-10">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Pelanggan</p>
                            <h4 class="text-3xl font-black text-orange-600">{{ $totalUsers }} <span class="text-sm font-bold text-gray-400 uppercase">Orang</span></h4>
                        </div>
                        <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                <!-- Line Chart: Monthly Revenue -->
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-gray-900 tracking-tight">Pendapatan Bulanan</h3>
                        <div class="h-8 w-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                    </div>
                    <div class="h-[300px]">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Doughnut Chart: Court Popularity -->
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-gray-900 tracking-tight">Popularitas Lapangan</h3>
                        <div class="h-8 w-8 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        </div>
                    </div>
                    <div class="h-[300px] flex items-center justify-center">
                        <canvas id="popularityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Schedule Recap Table -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-black text-gray-900 tracking-tight">Rekap Seluruh Jadwal</h3>
                        <p class="text-gray-400 text-sm font-medium">Data pemesanan terbaru yang masuk ke sistem.</p>
                    </div>
                    <span class="px-6 py-2 bg-indigo-50 text-indigo-700 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                        Total: {{ $allBookings->count() }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px] md:min-w-full">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Lapangan</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal & Waktu</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Bayar</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($allBookings as $booking)
                            <tr class="hover:bg-indigo-50/20 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="font-black text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $booking->user->name ?? 'User Terhapus' }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">{{ $booking->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-gray-700 font-black text-sm">{{ $booking->court->name ?? 'Lapangan Tidak Ditemukan' }}</div>
                                    <div class="mt-2 flex flex-wrap gap-1">
                                        @foreach($booking->equipment as $item)
                                            <span class="px-2 py-0.5 bg-white text-indigo-600 text-[9px] font-bold rounded-lg border border-indigo-100 shadow-sm">
                                                {{ $item->name }} ({{ $item->pivot->quantity }})
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-black text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                    <div class="text-[10px] font-bold text-gray-400 uppercase">{{ $booking->start_time }} - {{ $booking->end_time }} WIB</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-indigo-600 font-black text-sm">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($booking->status == 'success')
                                        <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-green-50 text-green-600 border border-green-100">Success</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-orange-50 text-orange-600 border border-orange-100 animate-pulse">Pending</span>
                                    @else
                                        <span class="px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest bg-red-50 text-red-600 border border-red-100">Cancelled</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        @if($booking->payment_proof && $booking->status == 'pending')
                                            <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="p-2.5 text-indigo-600 bg-indigo-50 hover:bg-indigo-600 hover:text-white rounded-xl transition-all duration-300" title="Lihat Bukti">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <form id="confirm-payment-{{ $booking->id }}" action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" @click="$dispatch('open-confirm-modal', { 
                                                    message: 'Konfirmasi pembayaran untuk pesanan ini?', 
                                                    title: 'Konfirmasi Pembayaran', 
                                                    confirmText: 'Ya, Konfirmasi', 
                                                    formId: 'confirm-payment-{{ $booking->id }}' 
                                                })" class="p-2.5 text-green-600 bg-green-50 hover:bg-green-600 hover:text-white rounded-xl transition-all duration-300" title="Konfirmasi">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        @endif

                                        <form id="delete-form-{{ $booking->id }}" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click="$dispatch('open-confirm-modal', { 
                                                message: 'Hapus data booking ini secara permanen?', 
                                                title: 'Hapus Data', 
                                                confirmText: 'Ya, Hapus', 
                                                formId: 'delete-form-{{ $booking->id }}' 
                                            })" class="p-2.5 text-gray-400 bg-gray-50 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($allBookings->isEmpty())
                <div class="p-24 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <p class="text-gray-400 font-bold">Belum ada data pemesanan.</p>
                </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup Revenue Chart
            const ctxRev = document.getElementById('revenueChart').getContext('2d');
            const revenueGradient = ctxRev.createLinearGradient(0, 0, 0, 300);
            revenueGradient.addColorStop(0, 'rgba(79, 70, 229, 0.2)');
            revenueGradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

            new Chart(ctxRev, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: @json($revenueData),
                        borderColor: '#4F46E5',
                        borderWidth: 4,
                        backgroundColor: revenueGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#4F46E5',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.03)' },
                            ticks: { 
                                font: { weight: 'bold' },
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { weight: 'bold' } }
                        }
                    }
                }
            });

            // Setup Popularity Chart
            const ctxPop = document.getElementById('popularityChart').getContext('2d');
            new Chart(ctxPop, {
                type: 'doughnut',
                data: {
                    labels: @json(array_keys($courtPopularity)),
                    datasets: [{
                        data: @json(array_values($courtPopularity)),
                        backgroundColor: [
                            '#4F46E5', // Indigo 600
                            '#8B5CF6', // Violet 500
                            '#C084FC', // Purple 400
                            '#E879F9', // Fuchsia 400
                        ],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: { weight: 'black', size: 11 }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
