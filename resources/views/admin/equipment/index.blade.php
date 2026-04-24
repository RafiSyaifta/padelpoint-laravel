<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen" x-data="{}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
                <div>
                    <div class="flex items-center gap-4 mb-2">
                        <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Kelola Perlengkapan</h2>
                    </div>
                    <p class="text-gray-500 font-medium text-lg">Atur harga sewa raket, harga bola, dan layanan tambahan lainnya.</p>
                </div>
                <a href="{{ route('admin.equipment.create') }}"
                    class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-lg shadow-indigo-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Perlengkapan
                </a>
            </div>

            <x-alert />

            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Nama Item</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Tipe</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Harga</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($equipment as $item)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="font-black text-gray-900 text-lg">{{ $item->name }}</div>
                                    <div class="text-sm text-gray-400 font-medium mt-1">{{ $item->description ?? 'Tidak ada deskripsi' }}</div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($item->type == 'rental')
                                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-indigo-100">Sewa</span>
                                    @else
                                        <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-100">Beli</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right font-black text-gray-900">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.equipment.edit', $item->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form id="delete-equip-{{ $item->id }}" action="{{ route('admin.equipment.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click="$dispatch('open-confirm-modal', { 
                                                message: 'Hapus perlengkapan {{ $item->name }} ini? Tindakan ini tidak dapat dibatalkan.', 
                                                title: 'Hapus Perlengkapan', 
                                                confirmText: 'Ya, Hapus Item', 
                                                formId: 'delete-equip-{{ $item->id }}' 
                                            })" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
