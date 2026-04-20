<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F1F5F9] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex justify-between items-center">
                <div>
                    <h2 class="font-black text-3xl text-gray-900 tracking-tight">Kelola Lapangan</h2>
                    <p class="text-gray-500 mt-1 font-medium">Tambah, edit, atau nonaktifkan lapangan PadelPoint.</p>
                </div>
                <a href="{{ route('admin.courts.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-2xl transition-all shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Lapangan
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courts as $court)
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="relative h-48 bg-indigo-600">
                        @if($court->image)
                            <img src="{{ asset('storage/' . $court->image) }}" class="w-full h-full object-cover opacity-80" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white/20">
                                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-black text-indigo-600 shadow-sm">
                            Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}/jam
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <h3 class="text-xl font-black text-gray-900 mb-4">{{ $court->name }}</h3>
                        <div class="flex gap-3">
                            <a href="{{ route('admin.courts.edit', $court->id) }}" class="flex-1 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold rounded-xl transition-colors text-sm text-center">
                                Edit
                            </a>

                            <form action="{{ route('admin.courts.destroy', $court->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin mau hapus lapangan ini? Semua riwayat booking lapangan ini mungkin terdampak.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2.5 bg-white border border-red-100 hover:bg-red-50 text-red-500 font-bold rounded-xl transition-colors text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
