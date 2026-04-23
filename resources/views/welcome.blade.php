<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PadelPoint - Sewa Lapangan Padel Premium</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
</head>

<body class="font-sans antialiased bg-[#F8FAFC] min-h-screen flex flex-col text-gray-900">

    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tighter">PadelPoint<span
                            class="text-indigo-600">.</span></span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-sm font-extrabold text-indigo-600 bg-indigo-50 px-5 py-2.5 rounded-xl hover:bg-indigo-100 transition-colors border border-indigo-100">Masuk
                            Dashboard</a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold text-gray-500 hover:text-gray-900 px-2 transition-colors">Log in</a>
                        <a href="{{ route('register') }}"
                            class="text-sm font-extrabold text-white bg-gray-900 px-6 py-2.5 rounded-xl hover:bg-indigo-600 transition-all shadow-md hover:shadow-xl hover:-translate-y-0.5">Daftar
                            Sekarang</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-white pt-20 pb-32 border-b border-gray-100 overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-gradient-to-b from-indigo-50/50 to-transparent pointer-events-none">
        </div>
        <div
            class="absolute -top-24 -right-24 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob">
        </div>
        <div
            class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center z-10">
            <span
                class="inline-block py-1.5 px-4 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-[10px] font-black tracking-widest uppercase mb-6 shadow-sm">
                🏆 Platform Booking Padel #1
            </span>
            <h1 class="text-5xl md:text-7xl font-black tracking-tighter mb-6 leading-tight">
                Main Padel <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Gak Pake
                    Ribet.</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-500 font-medium max-w-2xl mx-auto mb-10 leading-relaxed">
                Pilih lapangan favoritmu, cek ketersediaan jadwal secara real-time, dan langsung bayar. Semua beres
                dalam hitungan detik.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#lapangan"
                    class="bg-gray-900 text-white font-extrabold py-4 px-8 rounded-2xl hover:bg-indigo-600 transition-all shadow-lg hover:shadow-indigo-200 flex items-center justify-center group">
                    Lihat Lapangan
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-white p-6 rounded-3xl shadow-xl shadow-gray-200/40 border border-gray-100 flex items-start gap-4 transform transition-transform hover:-translate-y-1">
                <div
                    class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center shrink-0 text-indigo-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-gray-900 text-lg">Real-time Jadwal</h3>
                    <p class="text-sm text-gray-500 mt-1 font-medium leading-relaxed">Cek jam kosong langsung dari
                        sistem, gak perlu nunggu balasan admin.</p>
                </div>
            </div>
            <div
                class="bg-white p-6 rounded-3xl shadow-xl shadow-gray-200/40 border border-gray-100 flex items-start gap-4 transform transition-transform hover:-translate-y-1">
                <div
                    class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center shrink-0 text-purple-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-gray-900 text-lg">Pembayaran Aman</h3>
                    <p class="text-sm text-gray-500 mt-1 font-medium leading-relaxed">Terintegrasi dengan QRIS, GoPay,
                        dan Virtual Account otomatis.</p>
                </div>
            </div>
            <div
                class="bg-white p-6 rounded-3xl shadow-xl shadow-gray-200/40 border border-gray-100 flex items-start gap-4 transform transition-transform hover:-translate-y-1">
                <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center shrink-0 text-green-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-gray-900 text-lg">Kualitas Premium</h3>
                    <p class="text-sm text-gray-500 mt-1 font-medium leading-relaxed">Fasilitas terbaik yang sudah
                        di-review langsung oleh para Padelist.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="lapangan" class="pb-24 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center sm:text-left">
                <h2 class="font-black text-3xl text-gray-900 tracking-tight">Pilih Lapangan Padel</h2>
                <p class="text-gray-500 mt-2 font-medium text-lg">Temukan lapangan yang cocok dan booking sekarang.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courts as $court)
                    <div
                        class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col group">

                        <div
                            class="relative h-56 bg-gradient-to-br from-indigo-500 to-purple-700 flex items-center justify-center overflow-hidden">
                            @if ($court->image)
                                <img src="{{ asset('storage/' . $court->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                            @else
                                <svg class="w-24 h-24 text-white opacity-20 transform -rotate-12" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M14.752 11.168l-3.197-2.132A4 4 0 002 9.87v4.263a4 4 0 005.555 3.334l1.125-.75m4.268-3.08l4.416 2.944a1 1 0 001.543-.805V8.212a1 1 0 00-1.543-.804l-4.416 2.944zM15 12h.01">
                                    </path>
                                </svg>
                            @endif
                            <span
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-xl text-indigo-600 text-[10px] font-black uppercase tracking-widest shadow-sm">Verified
                                Court</span>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between bg-white">
                            <div>
                                <h3
                                    class="text-2xl font-extrabold text-gray-900 group-hover:text-indigo-600 transition-colors mb-1">
                                    {{ $court->name }}</h3>

                                @php
                                    $avgRating = $court->reviews->avg('rating');
                                    $totalReviews = $court->reviews->count();
                                @endphp

                                <button
                                    onclick="document.getElementById('reviews-modal-{{ $court->id }}').classList.remove('hidden')"
                                    class="flex items-center gap-2 mb-4 hover:bg-gray-50 py-1.5 px-2 -ml-2 rounded-xl transition-colors text-left group/rating w-fit">
                                    @if ($totalReviews > 0)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span
                                                class="ml-1 text-sm font-black text-gray-900">{{ number_format($avgRating, 1) }}</span>
                                        </div>
                                        <span class="text-gray-300 text-xs font-medium">•</span>
                                        <span
                                            class="text-gray-500 text-xs font-bold uppercase tracking-tighter group-hover/rating:text-indigo-600 underline decoration-dashed underline-offset-4 decoration-gray-300">{{ $totalReviews }}
                                            Ulasan</span>
                                    @else
                                        <span
                                            class="text-gray-400 text-[10px] font-black uppercase tracking-widest italic">Belum
                                            ada ulasan</span>
                                    @endif
                                </button>

                                <p class="text-gray-500 text-sm font-medium mb-1">Harga sewa</p>
                                <div class="flex items-baseline text-indigo-600 mb-6">
                                    <span class="text-3xl font-black tracking-tight">Rp
                                        {{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                                    <span class="text-gray-500 ml-1 text-sm font-medium">/jam</span>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-auto">
                                <button onclick="bukaKalender({{ $court->id }}, '{{ $court->name }}')"
                                    class="flex-1 flex items-center justify-center bg-indigo-50 border border-indigo-100 hover:bg-indigo-600 hover:border-indigo-600 text-indigo-600 hover:text-white font-black py-4 px-2 rounded-2xl transition-all duration-300 shadow-sm text-[10px] uppercase tracking-widest group/btn">
                                    <svg class="w-5 h-5 mr-1 text-indigo-500 group-hover/btn:text-white transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Cek Jadwal
                                </button>

                                @auth
                                    <a href="{{ route('booking.create', $court->id) }}"
                                        class="flex-1 flex items-center justify-center bg-gray-900 hover:bg-indigo-600 text-white font-black py-4 px-2 rounded-2xl transition-all duration-300 shadow-md hover:shadow-lg hover:scale-[1.02] text-[10px] uppercase tracking-widest">
                                        Booking
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}"
                                        class="flex-1 flex items-center justify-center bg-gray-200 hover:bg-gray-900 text-gray-700 hover:text-white font-black py-4 px-2 rounded-2xl transition-all duration-300 text-[10px] uppercase tracking-widest shadow-inner">
                                        Login Dulu
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>

                    <div id="reviews-modal-{{ $court->id }}" class="hidden fixed inset-0 z-[100] overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                            <div class="fixed inset-0 bg-gray-900/60 transition-opacity backdrop-blur-sm"
                                onclick="this.parentElement.parentElement.classList.add('hidden')"></div>

                            <div
                                class="relative bg-white rounded-[2.5rem] shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full p-8 z-[110] text-left flex flex-col max-h-[85vh]">
                                <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-100">
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">Ulasan Padelist
                                        </h3>
                                        <p class="text-indigo-600 font-bold text-sm mt-1">{{ $court->name }}</p>
                                    </div>
                                    <button
                                        onclick="this.closest('#reviews-modal-{{ $court->id }}').classList.add('hidden')"
                                        class="p-2 bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-500 rounded-full transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="overflow-y-auto pr-2 space-y-4 flex-1">
                                    @forelse($court->reviews()->latest()->get() as $review)
                                        <div
                                            class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 hover:border-indigo-100 transition-colors">
                                            <div class="flex justify-between items-start mb-3">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 font-black flex items-center justify-center text-sm uppercase">
                                                        {{ substr($review->user->name, 0, 2) }}
                                                    </div>
                                                    <div>
                                                        <h4 class="font-extrabold text-gray-900 text-sm">
                                                            {{ $review->user->name }}</h4>
                                                        <span
                                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-center bg-white px-2.5 py-1.5 rounded-xl shadow-sm border border-gray-100">
                                                    <span class="text-yellow-400 mr-1 text-xs">⭐</span>
                                                    <span
                                                        class="text-xs font-black text-gray-700">{{ $review->rating }}.0</span>
                                                </div>
                                            </div>
                                            <p class="text-gray-600 text-sm leading-relaxed font-medium">
                                                "{{ $review->comment }}"</p>
                                        </div>
                                    @empty
                                        <div class="text-center py-10">
                                            <div
                                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-gray-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <p class="text-gray-500 font-bold text-lg">Belum ada ulasan</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="text-2xl font-black tracking-tighter text-gray-300">PadelPoint<span
                    class="text-indigo-200">.</span></span>
            <p class="text-gray-400 font-medium text-sm">© {{ date('Y') }} PadelPoint. All rights reserved.</p>
        </div>
    </footer>

    <div id="calendarModal" class="hidden fixed inset-0 z-[100] overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 bg-gray-900/60 transition-opacity backdrop-blur-sm" onclick="tutupKalender()">
            </div>
            <div
                class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-5xl p-6 md:p-10 z-[110] text-left flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 id="calendarTitle" class="text-3xl font-black text-gray-900 tracking-tight">Jadwal
                            Lapangan</h3>
                        <p class="text-gray-500 font-medium">Cek jam kosong sebelum melakukan booking.</p>
                    </div>
                    <button onclick="tutupKalender()"
                        class="p-2 bg-gray-100 hover:bg-red-100 text-gray-500 hover:text-red-600 rounded-full transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="calendar" class="w-full"></div>
            </div>
        </div>
    </div>

    <script>
        let calendarInstance = null;

        function bukaKalender(courtId, courtName) {
            document.getElementById('calendarModal').classList.remove('hidden');
            document.getElementById('calendarTitle').innerText = 'Jadwal ' + courtName;
            var calendarEl = document.getElementById('calendar');
            if (calendarInstance) calendarInstance.destroy();
            calendarInstance = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                slotMinTime: '00:00:00',
                slotMaxTime: '24:00:00',
                allDaySlot: false,
                nowIndicator: true,
                events: '/api/courts/' + courtId + '/jadwal',
                locale: 'id',
                height: '650px',
                slotEventOverlap: false,
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari',
                    list: 'Daftar'
                }
            });
            calendarInstance.render();
            setTimeout(() => {
                calendarInstance.updateSize();
            }, 150);
        }

        function tutupKalender() {
            document.getElementById('calendarModal').classList.add('hidden');
        }
    </script>
    <style>
        .fc {
            font-family: inherit;
        }

        .fc-theme-standard th,
        .fc-theme-standard td,
        .fc-theme-standard .fc-scrollgrid {
            border-color: #f1f5f9;
        }

        .fc .fc-button-primary {
            background-color: #4f46e5;
            border-color: transparent;
            border-radius: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.65rem;
            padding: 0.5rem 1rem;
            transition: all 0.3s;
        }

        .fc .fc-button-primary:hover {
            background-color: #4338ca;
        }

        .fc .fc-button-primary:not(:disabled):active,
        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background-color: #312e81;
            border-color: transparent;
        }

        .fc-col-header-cell-cushion {
            font-weight: 800;
            color: #6b7280;
            padding: 10px 0 !important;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .fc-timegrid-slot-label-cushion {
            font-weight: 800;
            color: #9ca3af;
            font-size: 0.7rem;
        }

        .fc-event {
            border: none !important;
            border-radius: 0.6rem !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        }

        .fc-event-main {
            padding: 4px 6px !important;
            white-space: normal !important;
            word-break: break-word !important;
            overflow: hidden !important;
            display: flex !important;
            flex-direction: column !important;
        }

        .fc-event-title {
            font-weight: 800 !important;
            font-size: 0.65rem !important;
            line-height: 1.2;
        }

        .fc-event-time {
            font-weight: 600 !important;
            font-size: 0.6rem !important;
            opacity: 0.8;
        }

        .fc-timegrid-event-harness-inset .fc-timegrid-event {
            margin-right: 2px !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .fc-timegrid-now-indicator-line {
            border-color: #ef4444;
            border-width: 2px;
        }

        .fc-timegrid-now-indicator-arrow {
            border-color: #ef4444;
            background-color: #ef4444;
        }

        .fc-scroller-harness {
            padding-bottom: 20px;
        }
    </style>
</body>

</html>
