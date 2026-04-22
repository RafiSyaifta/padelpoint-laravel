<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">
                    Pilih Lapangan Padel
                </h2>
                <p class="text-gray-500 mt-2 font-medium text-lg">Pilih lapangan favoritmu dan jadwalkan permainan sekarang.</p>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-2xl shadow-sm flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($courts as $court)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col cursor-pointer group">

                    <div class="relative h-56 bg-gradient-to-br from-indigo-500 to-purple-700 flex items-center justify-center overflow-hidden">
                        @if($court->image)
                            <img src="{{ asset('storage/' . $court->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                        @else
                            <svg class="w-24 h-24 text-white opacity-20 transform -rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A4 4 0 002 9.87v4.263a4 4 0 005.555 3.334l1.125-.75m4.268-3.08l4.416 2.944a1 1 0 001.543-.805V8.212a1 1 0 00-1.543-.804l-4.416 2.944zM15 12h.01"></path>
                            </svg>
                        @endif

                        <span class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-xl text-indigo-600 text-[10px] font-black uppercase tracking-widest shadow-sm">
                            Verified Court
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between bg-white">
                        <div>
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $court->name }}</h3>
                            </div>

                            <div class="flex items-center gap-2 mb-4">
                                @php
                                    $avgRating = $court->reviews->avg('rating');
                                    $totalReviews = $court->reviews->count();
                                @endphp

                                @if($totalReviews > 0)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="ml-1 text-sm font-black text-gray-900">{{ number_format($avgRating, 1) }}</span>
                                    </div>
                                    <span class="text-gray-400 text-xs font-medium">•</span>
                                    <span class="text-gray-500 text-xs font-bold uppercase tracking-tighter">{{ $totalReviews }} Ulasan</span>
                                @else
                                    <span class="text-gray-300 text-[10px] font-black uppercase tracking-widest italic">Belum ada ulasan</span>
                                @endif
                            </div>

                            <p class="text-gray-500 text-sm font-medium mb-1">Harga sewa</p>
                            <div class="flex items-baseline text-indigo-600 mb-6">
                                <span class="text-3xl font-black tracking-tight">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                                <span class="text-gray-500 ml-1 text-sm font-medium">/jam</span>
                            </div>
                        </div>

                        <a href="{{ route('booking.create', $court->id) }}" class="w-full flex items-center justify-center bg-gray-900 hover:bg-indigo-600 text-white font-black py-4 px-4 rounded-2xl transition-all duration-300 shadow-md group-hover:shadow-[0_8px_30px_rgb(79,70,229,0.3)] group-hover:scale-[1.02]">
                            <span>Booking Sekarang</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
