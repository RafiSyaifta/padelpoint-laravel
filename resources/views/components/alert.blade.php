@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mb-8 p-6 bg-white border border-green-100 rounded-[2rem] flex items-center gap-4 shadow-xl shadow-green-900/5 relative overflow-hidden group">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-500 opacity-[0.03] rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
        <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-green-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="flex-grow">
            <h4 class="text-xs font-black text-green-600 uppercase tracking-[0.2em] mb-1">Berhasil!</h4>
            <p class="font-bold text-gray-900 leading-tight">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="p-2 text-gray-300 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
@endif

@if(session('error') || $errors->any())
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mb-8 p-6 bg-white border border-red-100 rounded-[2rem] flex items-center gap-4 shadow-xl shadow-red-900/5 relative overflow-hidden group">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-red-500 opacity-[0.03] rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
        <div class="w-12 h-12 bg-red-500 rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-red-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
        <div class="flex-grow">
            <h4 class="text-xs font-black text-red-600 uppercase tracking-[0.2em] mb-1">Terjadi Kesalahan!</h4>
            <p class="font-bold text-gray-900 leading-tight">
                @if(session('error'))
                    {{ session('error') }}
                @else
                    Silakan periksa kembali inputan Anda.
                @endif
            </p>
        </div>
        <button @click="show = false" class="p-2 text-gray-300 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
@endif
