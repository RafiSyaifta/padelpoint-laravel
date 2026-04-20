<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F1F5F9] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('admin.courts.index') }}" class="text-indigo-600 font-bold flex items-center gap-2 hover:underline">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h2 class="font-black text-3xl text-gray-900 mt-4">Tambah Lapangan Baru</h2>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl">
                    <p class="font-bold">Aduh! Ada yang salah:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
                <form action="{{ route('admin.courts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Nama Lapangan</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full h-14 rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 font-bold" placeholder="Contoh: Court VIP Emerald" required>
                    </div>

                    <div>
                        <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Harga Per Jam (Rp)</label>
                        <input type="number" name="price_per_hour" value="{{ old('price_per_hour') }}" class="w-full h-14 rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 font-bold" placeholder="Contoh: 150000" required>
                    </div>

                    <div>
                        <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2">Foto Lapangan</label>
                        <div class="relative">
                            <input type="file" name="image" id="image" class="w-full p-4 rounded-2xl border-2 border-dashed border-gray-200 hover:border-indigo-400 transition-all font-bold file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-black file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        </div>
                        <p class="text-xs text-gray-400 mt-2 font-medium">Format: JPG, PNG, atau JPEG (Max 2MB).</p>
                    </div>

                    <button type="submit" class="w-full h-16 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-lg transition-all transform hover:-translate-y-1 text-lg">
                        Simpan Lapangan & Foto
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
