<x-app-layout>
    <div class="pt-12 pb-24 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="relative mb-16 p-8 md:p-12 lg:p-16 rounded-[2rem] md:rounded-[3rem] bg-gradient-to-br from-indigo-900 to-indigo-800 text-white overflow-hidden shadow-2xl shadow-indigo-200">
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-indigo-400 opacity-10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black tracking-[0.2em] uppercase mb-6 md:mb-8 text-indigo-100">
                        Community Feed
                    </span>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-black mb-4 md:mb-6 leading-[1.1] tracking-tight">
                        Cari Teman <br/><span class="text-indigo-300">Mabar Padel</span>
                    </h1>
                    <p class="text-base md:text-lg text-indigo-100/80 font-medium mb-8 md:mb-10 leading-relaxed">
                        Jangan biarkan slot kosong! Bergabunglah dengan pemain lain di komunitas PadelPoint dan tingkatkan permainan Anda bersama.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-white text-indigo-900 font-black rounded-2xl hover:bg-indigo-50 transition-all transform active:scale-95 shadow-lg flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            Buat Mabar Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <x-alert />

            <!-- Mabar Grid -->
            <div class="flex items-center justify-between mb-10 pl-2">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight">Tersedia Saat Ini</h2>
                    <p class="text-sm font-bold text-gray-400">Pilih pertandingan yang sesuai dengan jadwal Anda</p>
                </div>
                <div class="flex gap-2">
                    <span class="px-4 py-2 bg-white rounded-xl border border-gray-100 text-xs font-bold text-gray-500 shadow-sm">
                        {{ $openMatches->count() }} Pertandingan
                    </span>
                </div>
            </div>

            @if($openMatches->isEmpty())
                <div class="bg-white rounded-[3rem] p-20 border-2 border-dashed border-gray-100 flex flex-col items-center text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-[2.5rem] flex items-center justify-center text-gray-300 mb-8 border border-gray-100">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-3">Belum Ada Mabar</h3>
                    <p class="text-gray-400 font-medium max-w-sm mx-auto leading-relaxed">
                        Sepertinya belum ada yang membuka pertandingan mabar hari ini. Jadilah yang pertama!
                    </p>
                    <a href="{{ route('dashboard') }}" class="mt-10 px-10 py-5 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-700 transition-all transform active:scale-95 shadow-xl shadow-indigo-100">
                        Buat Booking Mabar
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($openMatches as $match)
                        <x-mabar-card :match="$match" />
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
