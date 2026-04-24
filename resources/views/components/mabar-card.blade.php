<div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl hover:shadow-indigo-100/50 transition-all duration-500 flex flex-col h-full">
    <div class="p-8 flex-grow">
        <!-- Header: Court & Date -->
        <div class="flex justify-between items-start mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 border border-indigo-100 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $match->court->name }}</h3>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($match->booking_date)->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
            <div class="px-4 py-2 bg-gray-900 rounded-full">
                <span class="text-[10px] font-black text-white uppercase tracking-widest">{{ \Carbon\Carbon::parse($match->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($match->end_time)->format('H:i') }}</span>
            </div>
        </div>

        <!-- Progress Bar: Slots -->
        <div class="mb-8 bg-gray-50 p-5 rounded-2xl border border-gray-100">
            <div class="flex justify-between items-end mb-3">
                <p class="text-xs font-black text-gray-500 uppercase tracking-widest">Ketersediaan Slot</p>
                <p class="text-lg font-black text-indigo-600 tracking-tighter">{{ $match->participants->count() }} <span class="text-xs text-gray-400 uppercase tracking-widest ml-1">/ 4 Pemain</span></p>
            </div>
            <div class="w-full h-3 bg-white rounded-full overflow-hidden border border-gray-100 p-0.5">
                <div class="h-full bg-indigo-600 rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: {{ ($match->participants->count() / 4) * 100 }}%"></div>
            </div>
        </div>

        <!-- Participants List -->
        <div class="space-y-4">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Partisipan</p>
            <div class="flex flex-wrap gap-2">
                @foreach($match->participants as $participant)
                <div class="flex items-center gap-2 px-3 py-1.5 bg-white border border-gray-100 rounded-xl shadow-sm">
                    <div class="w-5 h-5 bg-indigo-100 rounded-full flex items-center justify-center text-[10px] font-bold text-indigo-600 uppercase">
                        {{ substr($participant->name, 0, 1) }}
                    </div>
                    <span class="text-xs font-bold text-gray-700">{{ explode(' ', $participant->name)[0] }}</span>
                </div>
                @endforeach
                
                @for($i = 0; $i < (4 - $match->participants->count()); $i++)
                <div class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 border border-dashed border-gray-200 rounded-xl">
                    <div class="w-5 h-5 border border-dashed border-gray-300 rounded-full"></div>
                    <span class="text-xs font-bold text-gray-400 italic">Kosong</span>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Action Footer -->
    <div class="p-8 pt-0 mt-auto">
        @if($match->participants->contains(auth()->id()))
            @if($match->user_id === auth()->id())
                <button disabled class="w-full py-4 rounded-2xl bg-gray-100 text-gray-400 font-black text-xs uppercase tracking-widest border border-gray-200 cursor-not-allowed">
                    Anda Pemilik Mabar
                </button>
            @else
                <form action="{{ route('mabar.leave', $match->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 rounded-2xl bg-red-50 text-red-600 font-black text-xs uppercase tracking-widest border border-red-100 hover:bg-red-600 hover:text-white transition-all transform active:scale-95 shadow-sm">
                        Keluar dari Mabar
                    </button>
                </form>
            @endif
        @else
            @if($match->participants->count() < 4)
                <form action="{{ route('mabar.join', $match->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-4 rounded-2xl bg-indigo-600 text-white font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all transform active:scale-95 shadow-xl shadow-indigo-100 relative overflow-hidden group/btn">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300"></div>
                        <span class="relative z-10">Gabung Mabar</span>
                    </button>
                </form>
            @else
                <button disabled class="w-full py-4 rounded-2xl bg-gray-100 text-gray-400 font-black text-xs uppercase tracking-widest border border-gray-200 cursor-not-allowed">
                    Slot Sudah Penuh
                </button>
            @endif
        @endif
    </div>
</div>
