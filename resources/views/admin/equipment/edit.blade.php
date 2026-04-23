<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('admin.equipment.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors group">
                    <div class="p-2.5 bg-white rounded-full shadow-sm mr-3 group-hover:bg-indigo-50 border border-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Kembali ke Daftar Perlengkapan
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10 lg:p-14">
                <h2 class="text-3xl font-black text-gray-900 mb-8 tracking-tight">Edit Perlengkapan</h2>

                <form action="{{ route('admin.equipment.update', $equipment->id) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-8">
                        <div class="space-y-3">
                            <label class="text-sm font-extrabold text-gray-700 uppercase tracking-widest pl-1">Nama Item</label>
                            <input type="text" name="name" value="{{ $equipment->name }}" class="w-full h-16 rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold px-6" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-sm font-extrabold text-gray-700 uppercase tracking-widest pl-1">Harga (Rp)</label>
                                <input type="number" name="price" value="{{ intval($equipment->price) }}" class="w-full h-16 rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold px-6" required>
                            </div>
                            <div class="space-y-3">
                                <label class="text-sm font-extrabold text-gray-700 uppercase tracking-widest pl-1">Tipe</label>
                                <select name="type" class="w-full h-16 rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold px-6">
                                    <option value="rental" {{ $equipment->type == 'rental' ? 'selected' : '' }}>Sewa (Per Item)</option>
                                    <option value="purchase" {{ $equipment->type == 'purchase' ? 'selected' : '' }}>Beli (Per Item)</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-sm font-extrabold text-gray-700 uppercase tracking-widest pl-1">Deskripsi Singkat</label>
                            <textarea name="description" rows="3" class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold px-6 py-4">{{ $equipment->description }}</textarea>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-5 rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 transform active:scale-95">
                            Perbarui Perlengkapan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
