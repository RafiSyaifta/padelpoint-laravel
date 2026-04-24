<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen" x-data="{}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <div class="flex items-center gap-4 mb-2">
                    <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Admin Control Panel</h2>
                </div>
                <p class="text-gray-500 font-medium text-lg">Pantau seluruh aktivitas pemesanan lapangan PadelPoint secara real-time.</p>
            </div>

            <x-alert />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Total Pendapatan</p>
        <h4 class="text-3xl font-black text-indigo-600 relative z-10">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Booking Hari Ini</p>
        <h4 class="text-3xl font-black text-green-600 relative z-10">{{ $todayBookings }} <span class="text-sm font-bold text-gray-400">Jadwal</span></h4>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Total Pelanggan</p>
        <h4 class="text-3xl font-black text-orange-600 relative z-10">{{ $totalUsers }} <span class="text-sm font-bold text-gray-400">Orang</span></h4>
    </div>
</div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900">Rekap Seluruh Jadwal</h3>
                    <span class="px-4 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-black uppercase tracking-widest">
                        Total: {{ $allBookings->count() }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px] md:min-w-full">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-4 md:px-8 py-4 text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                                <th class="px-4 md:px-8 py-4 text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest">Lapangan</th>
                                <th class="px-4 md:px-8 py-4 text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest">Tanggal & Waktu</th>
                                <th class="px-4 md:px-8 py-4 text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest">Total Bayar</th>
                                <th class="px-4 md:px-8 py-4 text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-4 md:px-8 py-4 text-[10px] md:text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">

                            @foreach($allBookings as $booking)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-gray-900">{{ $booking->user->name ?? 'User Terhapus' }}</div>
                                    <div class="text-xs text-gray-400 font-medium">{{ $booking->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-6 text-gray-700 font-bold">
                                    {{ $booking->court->name ?? 'Lapangan Tidak Ditemukan' }}
                                    <div class="mt-1 flex flex-wrap gap-1">
                                        @foreach($booking->equipment as $item)
                                            <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] rounded-md border border-indigo-100 italic">
                                                {{ $item->name }}: {{ $item->pivot->quantity }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-gray-600">
                                    <div class="text-sm font-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                    <div class="text-xs font-medium text-gray-400">{{ $booking->start_time }} - {{ $booking->end_time }} WIB</div>
                                </td>
                                <td class="px-4 md:px-8 py-4 md:py-6">
                                    <span class="text-indigo-600 font-black">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    @if($booking->status == 'success')
                                        <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-green-100 text-green-700 border border-green-200">Success</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-orange-100 text-orange-700 border border-orange-200">Pending</span>
                                    @else
                                        <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-red-100 text-red-700 border border-red-200">Cancelled</span>
                                    @endif
                                </td>

                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end items-center gap-2">

                                        @if($booking->payment_proof && $booking->status == 'pending')
                                            <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors" title="Lihat Bukti">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>

                                            <form id="confirm-payment-{{ $booking->id }}" action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" @click="$dispatch('open-confirm-modal', { 
                                                    message: 'Konfirmasi pembayaran untuk pesanan ini?', 
                                                    title: 'Konfirmasi Pembayaran', 
                                                    confirmText: 'Ya, Konfirmasi', 
                                                    formId: 'confirm-payment-{{ $booking->id }}' 
                                                })" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-colors" title="Konfirmasi Pembayaran">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        @endif

                                        <form id="delete-form-{{ $booking->id }}" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click="$dispatch('open-confirm-modal', { 
                                                message: 'Apakah Anda yakin ingin menghapus data ini? Semua data terkait akan ikut terhapus.', 
                                                title: 'Hapus Pesanan', 
                                                confirmText: 'Ya, Hapus Data', 
                                                formId: 'delete-form-{{ $booking->id }}' 
                                            })" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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
                <div class="p-20 text-center">
                    <p class="text-gray-400 font-medium">Belum ada data pemesanan yang tersedia.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
