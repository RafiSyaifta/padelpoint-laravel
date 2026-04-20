<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F1F5F9] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <div class="flex items-center gap-4 mb-2">
                    <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Admin Control Panel</h2>
                </div>
                <p class="text-gray-500 font-medium text-lg">Pantau seluruh aktivitas booking lapangan PadelPoint di sini.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm">
                    <span class="font-bold">Berhasil:</span> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900">Rekap Semua Jadwal</h3>
                    <span class="px-4 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-black uppercase tracking-widest">
                        Total: {{ $allBookings->count() }} Data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                                <th class="px-8 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Lapangan</th>
                                <th class="px-8 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Tanggal & Waktu</th>
                                <th class="px-8 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Total Bayar</th>
                                <th class="px-8 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-8 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($allBookings as $booking)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-gray-900">{{ $booking->user->name ?? 'User Terhapus' }}</div>
                                    <div class="text-xs text-gray-400 font-medium">{{ $booking->user->email ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-6 text-gray-700 font-bold">
                                    {{ $booking->court->name ?? 'Lapangan Tidak Ditemukan' }}
                                </td>
                                <td class="px-8 py-6 text-gray-600">
                                    <div class="text-sm font-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                                    <div class="text-xs font-medium text-gray-400">{{ $booking->start_time }} - {{ $booking->end_time }} WIB</div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-indigo-600 font-black">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-green-100 text-green-700 border border-green-200">
                                        Confirmed
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus booking ini? Data bakal hilang selamanya dari database!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($allBookings->isEmpty())
                <div class="p-20 text-center">
                    <p class="text-gray-400 font-medium">Belum ada data bookingan masuk.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
