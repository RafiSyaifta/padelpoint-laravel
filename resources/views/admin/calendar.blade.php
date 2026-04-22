<x-app-layout>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

            <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Jadwal Global PadelPoint
                    </h2>
                    <p class="text-gray-500 mt-2 font-medium text-lg">Pantau semua pesanan lapangan di satu tempat secara
                        real-time.</p>
                </div>
                <div class="flex gap-4">
                    <div
                        class="flex items-center text-[10px] font-black uppercase tracking-widest text-gray-500 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                        <span class="w-3 h-3 rounded-full bg-indigo-600 mr-2"></span> Sukses
                    </div>
                    <div
                        class="flex items-center text-[10px] font-black uppercase tracking-widest text-gray-500 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                        <span class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></span> Pending
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-6 md:p-8 w-full block">
                <div id="admin-calendar" class="w-full"></div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('admin-calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                // --- FIX FULL 24 JAM DI SINI ---
                slotMinTime: '00:00:00', // Dimulai dari jam 12 malam persis
                slotMaxTime: '24:00:00', // Berakhir di jam 12 malam berikutnya

                allDaySlot: false,
                nowIndicator: true,
                events: '{{ route('admin.api.global-jadwal') }}',
                locale: 'id',

                height: 'auto',
                expandRows: false,

                slotEventOverlap: false,
                eventDisplay: 'block',

                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari',
                    list: 'Daftar'
                }
            });
            calendar.render();

            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 200);
        });
    </script>

    <style>
        /* Base Design */
        .fc {
            font-family: inherit;
        }

        .fc-theme-standard th,
        .fc-theme-standard td,
        .fc-theme-standard .fc-scrollgrid {
            border-color: #f1f5f9;
        }

        /* Buttons Style */
        .fc .fc-button-primary {
            background-color: #4f46e5;
            border-color: transparent;
            border-radius: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.7rem;
            padding: 0.6rem 1.2rem;
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

        /* Header & Time Labels */
        .fc-col-header-cell-cushion {
            font-weight: 800;
            color: #6b7280;
            padding: 12px 0 !important;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
        }

        .fc-timegrid-slot-label-cushion {
            font-weight: 800;
            color: #9ca3af;
            font-size: 0.75rem;
        }

        .fc-day-today {
            background-color: #f8faff !important;
        }

        /* Event Design */
        .fc-event {
            border: none !important;
            border-radius: 0.6rem !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .fc-event:hover {
            transform: scale(1.02);
            z-index: 10 !important;
        }

        .fc-event-main {
            padding: 4px 6px !important;
            display: flex !important;
            flex-direction: column !important;
            white-space: normal !important;
            word-break: break-word !important;
            overflow: hidden !important;
        }

        .fc-event-title {
            font-weight: 800 !important;
            font-size: 0.65rem !important;
            line-height: 1.2 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.025em !important;
        }

        .fc-event-time {
            font-weight: 600 !important;
            font-size: 0.6rem !important;
            opacity: 0.8;
            margin-bottom: 2px;
        }

        .fc-timegrid-event-harness-inset .fc-timegrid-event {
            margin-right: 3px !important;
            margin-left: 1px !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
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
            padding-bottom: 10px;
        }
    </style>
</x-app-layout>
