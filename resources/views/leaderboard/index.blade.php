<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="font-black text-4xl text-gray-900 tracking-tight">Leaderboard Padelist</h2>
                <p class="text-gray-500 mt-2 font-medium text-lg">Siapa yang paling rajin menguasai lapangan?</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-6 font-black text-xs uppercase tracking-widest text-gray-400">Rank</th>
                            <th class="px-8 py-6 font-black text-xs uppercase tracking-widest text-gray-400">Padelist</th>
                            <th class="px-8 py-6 font-black text-xs uppercase tracking-widest text-gray-400 text-center">Total Jam</th>
                            <th class="px-8 py-6 font-black text-xs uppercase tracking-widest text-gray-400 text-center">Total Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topUsers as $index => $user)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-indigo-50/30 transition-colors">
                            <td class="px-8 py-6">
                                @if($index == 0)
                                    <span class="flex items-center justify-center w-8 h-8 bg-yellow-400 text-white rounded-full text-sm font-black shadow-lg shadow-yellow-200">1</span>
                                @elseif($index == 1)
                                    <span class="flex items-center justify-center w-8 h-8 bg-gray-300 text-white rounded-full text-sm font-black shadow-lg shadow-gray-200">2</span>
                                @elseif($index == 2)
                                    <span class="flex items-center justify-center w-8 h-8 bg-orange-400 text-white rounded-full text-sm font-black shadow-lg shadow-orange-200">3</span>
                                @else
                                    <span class="text-gray-400 font-bold ml-3">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-black">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-black text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="bg-indigo-600 text-white px-4 py-1.5 rounded-full text-sm font-black shadow-md shadow-indigo-100">
                                    {{ $user->total_hours }} Jam
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center font-bold text-gray-500">
                                {{ $user->bookings_count }}x
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
