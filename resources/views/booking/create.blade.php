<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors group">
                    <div class="p-2.5 bg-white rounded-full shadow-sm mr-3 group-hover:bg-indigo-50 transition-colors border border-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Kembali ke Katalog
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">

                <div class="md:w-5/12 bg-gradient-to-br from-gray-900 to-indigo-900 text-white p-10 lg:p-14 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <span class="inline-block py-2 px-5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-bold tracking-widest uppercase mb-8 text-indigo-100">
                            Detail Pesanan
                        </span>
                        <h2 class="text-4xl lg:text-5xl font-black mb-4 leading-tight">{{ $court->name }}</h2>
                        <p class="text-indigo-200 font-medium mb-12 text-lg">Padel Court Standar Internasional</p>

                        <div>
                            <p class="text-sm text-gray-400 font-bold uppercase tracking-wider mb-3">Tarif Sewa</p>
                            <div class="flex items-baseline text-white">
                                <span class="text-4xl font-black tracking-tight">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                                <span class="text-indigo-200 ml-2 font-medium">/ jam</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 mt-16 pt-8 border-t border-white/10 flex items-center text-sm text-indigo-200 font-medium">
                        <svg class="w-6 h-6 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Harap datang 15 menit sebelum jadwal.
                    </div>
                </div>

                <div class="md:w-7/12 p-10 lg:p-14 bg-white">
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-10">Tentukan Waktu</h3>

                    <form action="{{ route('booking.store', $court->id) }}" method="POST" class="space-y-6">
                        @csrf

                        @if(session('error'))
                            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-2xl shadow-sm">
                                <span class="font-bold">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="space-y-3">
                            <label class="text-sm font-extrabold text-gray-700 uppercase tracking-wide">Pilih Tanggal</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <input type="date" name="booking_date" class="pl-14 w-full h-16 rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold text-lg" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-2">
                            <div class="space-y-3">
                                <label class="text-sm font-extrabold text-gray-700 uppercase tracking-wide">Jam Mulai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <input type="time" name="start_time" class="pl-14 w-full h-16 rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold text-lg" required>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-extrabold text-gray-700 uppercase tracking-wide">Jam Selesai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <input type="time" name="end_time" class="pl-14 w-full h-16 rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold text-lg" required>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="total_price" value="{{ $court->price_per_hour }}">

                        <div class="pt-10">
                            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl hover:bg-indigo-700 transition-all shadow-lg transform active:scale-95">
                                Konfirmasi & Pesan Sekarang
                            </button>
                        </div>
                    </form> </div>
            </div>
        </div>
    </div>
</x-app-layout>
