<x-app-layout>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
                <div>
                    <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Riwayat Booking</h2>
                    <p class="text-gray-500 mt-2 font-medium text-lg">Daftar jadwal lapangan Padel yang sudah Anda pesan.</p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-[0_8px_30px_rgb(79,70,229,0.2)] hover:shadow-[0_8px_30px_rgb(79,70,229,0.4)] hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Booking Baru
                </a>
            </div>

            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-2xl shadow-sm flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="space-y-6">
                @if ($bookings->isEmpty())
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-16 text-center flex flex-col items-center justify-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Belum ada jadwal</h3>
                        <p class="text-gray-500 font-medium text-lg">Anda belum memesan lapangan apapun. Silakan melakukan booking sekarang!</p>
                    </div>
                @else
                    @foreach ($bookings as $booking)
                        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-indigo-100 hover:-translate-y-1 transition-all duration-300 flex flex-col md:flex-row group">

                            <div class="md:w-2/3 p-8 flex items-start gap-6">
                                <div class="h-16 w-16 bg-indigo-50/70 text-indigo-600 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-indigo-100 transition-colors duration-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A4 4 0 002 9.87v4.263a4 4 0 005.555 3.334l1.125-.75m4.268-3.08l4.416 2.944a1 1 0 001.543-.805V8.212a1 1 0 00-1.543-.804l-4.416 2.944zM15 12h.01"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    @if ($booking->status == 'success')
                                        <span class="inline-block py-1 px-3 rounded-full bg-green-50 border border-green-100 text-[10px] font-black tracking-wider uppercase mb-2 text-green-600">Lunas / Sukses</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="inline-block py-1 px-3 rounded-full bg-orange-50 border border-orange-100 text-[10px] font-black tracking-wider uppercase mb-2 text-orange-600">Menunggu Pembayaran</span>
                                    @else
                                        <span class="inline-block py-1 px-3 rounded-full bg-red-50 border border-red-100 text-[10px] font-black tracking-wider uppercase mb-2 text-red-600">Dibatalkan</span>
                                    @endif

                                    <h4 class="text-2xl font-black text-gray-900 mb-2 group-hover:text-indigo-700 transition-colors duration-300">
                                        {{ $booking->court->name }}</h4>

                                    <div class="flex flex-wrap items-center gap-4 text-gray-500 font-medium text-sm mb-4">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}
                                        </div>
                                        <div class="flex items-center gap-1.5 px-3 py-1 bg-gray-50 rounded-lg text-gray-700">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }} WIB
                                        </div>
                                    </div>

                                    @if($booking->equipment->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach($booking->equipment as $item)
                                            <div class="flex items-center gap-2 px-3 py-2 bg-indigo-50/50 rounded-xl border border-indigo-100/50">
                                                <span class="text-indigo-600 font-black text-xs">{{ $item->pivot->quantity }}x</span>
                                                <span class="text-indigo-700 text-[10px] font-bold uppercase tracking-widest">{{ $item->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif

                                    @if ($booking->status == 'success')
                                        <button onclick="document.getElementById('review-modal-{{ $booking->id }}').classList.remove('hidden')"
                                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-sm border border-indigo-100">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Beri Rating & Ulasan
                                        </button>
                                    @endif

                                    @if ($booking->status == 'pending' && $booking->snap_token)
                                        <div class="mt-4 p-5 bg-orange-50/50 rounded-2xl border border-orange-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                                            <div>
                                                <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest">Selesaikan Pembayaran</p>
                                                <p class="text-xs text-orange-600 font-bold mt-1">Pilih metode pembayaran yang tersedia.</p>
                                            </div>

                                            <button onclick="pay('{{ $booking->snap_token }}')"
                                                class="w-full sm:w-auto px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-black rounded-xl shadow-lg shadow-orange-200 transition-all text-xs uppercase tracking-wider">
                                                Bayar Sekarang
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="md:w-1/3 bg-gray-50/50 group-hover:bg-gray-50 p-8 border-t md:border-t-0 md:border-l border-dashed border-gray-200 transition-colors duration-300 flex flex-col justify-between items-start md:items-end text-left md:text-right relative">
                                <div class="hidden md:block absolute -left-3 top-1/2 -mt-3 w-6 h-6 bg-[#F8FAFC] rounded-full border-r border-gray-200 group-hover:border-indigo-100 transition-colors duration-300"></div>

                                <div class="w-full">
                                    <p class="text-sm font-extrabold text-gray-400 uppercase tracking-widest mb-1">Total Tagihan</p>
                                    <p class="text-3xl font-black text-indigo-600 mb-6">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>

                                @if ($booking->status == 'pending')
                                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="w-full mt-auto" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full flex items-center justify-center py-2.5 px-4 bg-white border border-red-200 text-red-500 font-bold rounded-xl hover:bg-red-50 hover:border-red-300 transition-all duration-300 group/btn">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div id="review-modal-{{ $booking->id }}" class="hidden fixed inset-0 z-[100] overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                                <div class="fixed inset-0 bg-gray-900/60 transition-opacity" onclick="document.getElementById('review-modal-{{ $booking->id }}').classList.add('hidden')"></div>

                                <div class="relative bg-white rounded-[2.5rem] shadow-2xl transform transition-all sm:max-w-lg sm:w-full p-10 z-[110] text-left">
                                    <form action="{{ route('review.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="court_id" value="{{ $booking->court_id }}">

                                        <h3 class="text-2xl font-black text-gray-900 mb-2">Bagaimana pengalaman Anda?</h3>
                                        <p class="text-gray-500 font-medium mb-8 text-sm leading-relaxed">Ulasan Anda sangat membantu pemain lain dalam memilih lapangan terbaik.</p>

                                        <div class="mb-6">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 mb-2">Rating</label>
                                            <select name="rating" class="w-full rounded-xl border-gray-200 bg-gray-50/50 font-bold py-3.5 px-4 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                                                <option value="5">⭐️⭐️⭐️⭐️⭐️ Sempurna</option>
                                                <option value="4">⭐️⭐️⭐️⭐️ Bagus</option>
                                                <option value="3">⭐️⭐️⭐️ Lumayan</option>
                                                <option value="2">⭐️⭐️ Kurang</option>
                                                <option value="1">⭐️ Buruk</option>
                                            </select>
                                        </div>

                                        <div class="mb-8">
                                            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 mb-2">Ulasan Anda</label>
                                            <textarea name="comment" rows="4" class="w-full rounded-xl border-gray-200 bg-gray-50/50 p-4 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900" placeholder="Berikan komentar Anda mengenai kualitas lapangan..."></textarea>
                                        </div>

                                        <div class="flex gap-3">
                                            <button type="button" onclick="document.getElementById('review-modal-{{ $booking->id }}').classList.add('hidden')" class="flex-1 py-4 bg-gray-100 text-gray-500 font-black rounded-2xl uppercase text-[10px] tracking-widest hover:bg-gray-200 transition-all">Batal</button>
                                            <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-lg shadow-indigo-200 uppercase text-[10px] tracking-widest hover:bg-indigo-700 transition-all">Kirim Ulasan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function pay(snapToken) {
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil diproses.");
                    window.location.reload();
                },
                onPending: function(result) {
                    alert("Transaksi sedang diproses, silakan selesaikan pembayaran Anda.");
                },
                onError: function(result) {
                    alert("Terjadi kesalahan pada pembayaran.");
                },
                onClose: function() {
                    // Silently close
                }
            });
        }
    </script>
</x-app-layout>
