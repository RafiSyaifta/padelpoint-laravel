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
                            <img src="{{ asset('storage/' . $court->image) }}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                        @else
                            <svg class="w-24 h-24 text-white opacity-20 transform -rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A4 4 0 002 9.87v4.263a4 4 0 005.555 3.334l1.125-.75m4.268-3.08l4.416 2.944a1 1 0 001.543-.805V8.212a1 1 0 00-1.543-.804l-4.416 2.944zM15 12h.01"></path>
                            </svg>
                            <span class="absolute bottom-4 left-4 bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full text-white text-xs font-bold tracking-wider uppercase border border-white/30">
                                Padel Court
                            </span>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between bg-white">
                        <div>
                            <h3 class="text-2xl font-extrabold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ $court->name }}</h3>
                            <p class="text-gray-500 text-sm font-medium mb-3">Harga sewa</p>

                            <div class="flex items-baseline text-indigo-600 mb-6">
                                <span class="text-3xl font-black tracking-tight">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                                <span class="text-gray-500 ml-1 text-sm font-medium">/jam</span>
                            </div>
                        </div>

                        <a href="{{ route('booking.create', $court->id) }}" class="w-full flex items-center justify-center bg-gray-900 hover:bg-indigo-600 text-white font-bold py-3.5 px-4 rounded-2xl transition-colors duration-300 shadow-md group-hover:shadow-lg">
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
