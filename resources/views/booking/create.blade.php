<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" 
            x-data="{ 
                courtPrice: {{ $court->price_per_hour }}, 
                startTime: '', 
                endTime: '', 
                showAddons: false,
                equipment: {
                    @foreach($equipment as $item)
                        '{{ $item->id }}': { name: '{{ $item->name }}', price: {{ $item->price }}, quantity: 0 },
                    @endforeach
                },
                get duration() {
                    if (!this.startTime || !this.endTime) return 0;
                    let start = new Date('2000-01-01T' + this.startTime);
                    let end = new Date('2000-01-01T' + this.endTime);
                    let diff = (end - start) / (1000 * 60 * 60);
                    return diff > 0 ? Math.ceil(diff) : 0;
                },
                get courtTotal() {
                    return (this.duration || 1) * this.courtPrice;
                },
                get equipmentTotal() {
                    let total = 0;
                    for (let id in this.equipment) {
                        total += this.equipment[id].price * this.equipment[id].quantity;
                    }
                    return total;
                },
                get grandTotal() {
                    return this.courtTotal + this.equipmentTotal;
                }
            }">

            <div class="mb-8 flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors group">
                    <div class="p-2.5 bg-white rounded-full shadow-sm mr-3 group-hover:bg-indigo-50 transition-colors border border-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </div>
                    Kembali ke Katalog
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Main Booking Card -->
                <div class="lg:col-span-8 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row">
                    <!-- Left: Court Info -->
                    <div class="md:w-5/12 bg-gradient-to-br from-gray-900 to-indigo-900 text-white p-10 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black tracking-widest uppercase mb-6 text-indigo-100">
                                Detail Pesanan
                            </span>
                            <h2 class="text-3xl font-black mb-3 leading-tight">{{ $court->name }}</h2>
                            <p class="text-indigo-200 font-medium mb-10 text-sm">Lapangan Padel Standar Internasional</p>

                            <div>
                                <p class="text-xs text-gray-400 font-black uppercase tracking-wider mb-2">Tarif Sewa</p>
                                <div class="flex items-baseline text-white">
                                    <span class="text-4xl font-black tracking-tight">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                                    <span class="text-indigo-200 ml-2 text-xs font-bold">/ jam</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Form Area -->
                    <div class="md:w-7/12 p-10 lg:p-12 bg-white">
                        <h3 class="text-2xl font-black text-gray-900 mb-8 tracking-tight">Pilih Jadwal</h3>

                        <form action="{{ route('booking.store', $court->id) }}" method="POST" id="booking-form" class="space-y-8">
                            @csrf

                            @if(session('error'))
                                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-2xl shadow-sm">
                                    <span class="font-bold">{{ session('error') }}</span>
                                </div>
                            @endif

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Tanggal</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                    <input type="date" name="booking_date" class="pl-12 w-full h-14 rounded-xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold text-base" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6 mt-2">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Jam Mulai</label>
                                    <input type="time" name="start_time" x-model="startTime" class="w-full h-14 rounded-xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold text-base" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Jam Selesai</label>
                                    <input type="time" name="end_time" x-model="endTime" class="w-full h-14 rounded-xl border-gray-200 focus:border-indigo-500 bg-gray-50 font-bold text-base" required>
                                </div>
                            </div>

                            <!-- Layanan Tambahan Accordion -->
                            <div class="pt-8 border-t border-gray-100">
                                <button type="button" @click="showAddons = !showAddons" class="w-full flex items-center justify-between group">
                                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Layanan Tambahan (Opsional)
                                    </h4>
                                    <div class="flex items-center gap-2 text-[10px] font-black text-indigo-600 uppercase tracking-widest">
                                        <span x-text="showAddons ? 'Sembunyikan' : 'Tampilkan'"></span>
                                        <svg class="w-4 h-4 transition-transform duration-300" :class="showAddons ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </button>
                                
                                <div x-show="showAddons" x-collapse x-cloak class="mt-8 space-y-4">
                                    @foreach($equipment as $item)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 group hover:border-indigo-200 transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-600 shadow-sm border border-gray-100">
                                                @if($item->type == 'rental')
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path></svg>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm">{{ $item->name }}</p>
                                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <input type="number" name="equipment[{{ $item->id }}]" 
                                            x-model.number="equipment[{{ $item->id }}].quantity"
                                            min="0" max="10" 
                                            class="w-16 h-9 rounded-lg border-gray-200 focus:border-indigo-500 bg-white font-bold text-center text-sm px-1">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- External Summary Sidebar -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-md border border-gray-100 p-10 sticky top-8">
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest pl-1 mb-10">Ringkasan Biaya</h4>
                        
                        <div class="space-y-8">
                            <div class="flex flex-col gap-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-bold text-gray-500 tracking-tight">Sewa Lapangan</span>
                                    <span class="text-lg font-black text-gray-900 tracking-tight">Rp <span x-text="new Intl.NumberFormat('id-ID').format(courtTotal)"></span></span>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="px-3 py-1 bg-indigo-50 rounded-lg border border-indigo-100">
                                        <span class="text-[11px] text-indigo-600 font-extrabold uppercase tracking-widest" x-text="duration || 1"></span>
                                        <span class="text-[11px] text-indigo-600 font-extrabold uppercase tracking-widest ml-0.5">Jam</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-8 border-t border-gray-100 space-y-5" x-show="equipmentTotal > 0">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-sm font-bold text-gray-500 tracking-tight">Layanan Tambahan</span>
                                    <span class="text-lg font-black text-gray-900 tracking-tight">Rp <span x-text="new Intl.NumberFormat('id-ID').format(equipmentTotal)"></span></span>
                                </div>
                                <div class="space-y-3.5">
                                    <template x-for="(item, id) in equipment" :key="id">
                                        <div class="flex justify-between items-center" x-show="item.quantity > 0">
                                            <div class="flex items-center gap-3">
                                                <div class="w-2 h-2 rounded-full bg-indigo-500 ring-4 ring-indigo-50"></div>
                                                <span class="text-xs text-gray-600 font-bold" x-text="item.name + ' (x' + item.quantity + ')' "></span>
                                            </div>
                                            <span class="text-sm text-gray-900 font-black italic tracking-tight">Rp <span x-text="new Intl.NumberFormat('id-ID').format(item.price * item.quantity)"></span></span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="pt-10 border-t-2 border-dashed border-gray-100 mt-6">
                                <div class="flex justify-between items-end mb-10">
                                    <div>
                                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Total Pembayaran</p>
                                        <p class="text-4xl font-black text-indigo-600 leading-none tracking-tighter shadow-indigo-100 mb-1">Rp <span x-text="new Intl.NumberFormat('id-ID').format(grandTotal)"></span></p>
                                    </div>
                                </div>

                                <button form="booking-form" type="submit" class="w-full bg-indigo-600 text-white font-black py-6 rounded-[1.5rem] hover:bg-indigo-700 transition-all shadow-2xl shadow-indigo-200 transform active:scale-95 text-sm uppercase tracking-[0.2em] relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                    <span class="relative z-10">Konfirmasi & Bayar</span>
                                </button>
                                
                                <div class="mt-8 flex items-center justify-center gap-2.5 text-gray-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                    <span class="text-[11px] font-black uppercase tracking-[0.1em]">Enkripsi 256-bit Secure</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
