<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="font-black text-4xl text-gray-900 tracking-tight">Leaderboard Padelist</h2>
                <p class="text-gray-500 mt-2 font-medium text-lg">Siapa yang paling aktif menguasai lapangan?</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-6 md:px-8 py-5 font-black text-[10px] uppercase tracking-widest text-gray-400">Rank</th>
                                <th class="px-6 md:px-8 py-5 font-black text-[10px] uppercase tracking-widest text-gray-400">Padelist</th>
                                <th class="px-6 md:px-8 py-5 font-black text-[10px] uppercase tracking-widest text-gray-400 text-center">Total Jam</th>
                                <th class="px-6 md:px-8 py-5 font-black text-[10px] uppercase tracking-widest text-gray-400 text-center">Booking</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($topUsers as $index => $user)
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 md:px-8 py-6">
                                    @if($index == 0)
                                        <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-yellow-300 to-yellow-500 text-white rounded-xl text-sm font-black shadow-lg shadow-yellow-200 ring-2 ring-yellow-100">1</div>
                                    @elseif($index == 1)
                                        <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-gray-200 to-gray-400 text-white rounded-xl text-sm font-black shadow-lg shadow-gray-100 ring-2 ring-gray-100">2</div>
                                    @elseif($index == 2)
                                        <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-orange-300 to-orange-500 text-white rounded-xl text-sm font-black shadow-lg shadow-orange-100 ring-2 ring-orange-100">3</div>
                                    @else
                                        <span class="text-gray-400 font-bold ml-3 text-sm">{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-6 md:px-8 py-6">
                                    <div class="flex items-center gap-3 md:gap-4">
                                        <div class="h-10 w-10 md:h-12 md:w-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-black group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 border border-indigo-100">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-gray-900 group-hover:text-indigo-600 transition-colors text-sm md:text-base">{{ $user->name }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Active Player</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 md:px-8 py-6 text-center">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-2xl border border-indigo-100 shadow-sm group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-300">
                                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-sm md:text-base font-black tracking-tight">{{ $user->total_hours }}<span class="text-[10px] ml-0.5 opacity-80 uppercase">h</span></span>
                                    </div>
                                </td>
                                <td class="px-6 md:px-8 py-6 text-center font-black text-gray-400 text-sm md:text-base">
                                    {{ $user->bookings_count }}<span class="text-[10px] ml-0.5 opacity-60">x</span>
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
