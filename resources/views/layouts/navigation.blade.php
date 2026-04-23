<nav x-data="{ open: false }" class="bg-white dark:bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 transform group-hover:rotate-12 transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-black text-2xl tracking-tighter text-gray-900 group-hover:text-indigo-600 transition-colors">PadelPoint<span class="text-indigo-600">.</span></span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-base font-bold text-gray-600 dark:text-gray-600 hover:text-indigo-600 mt-1">
                        {{ __('Katalog') }}
                    </x-nav-link>

                    <x-nav-link :href="route('leaderboard')" :active="request()->routeIs('leaderboard')" class="text-base font-bold text-gray-600 dark:text-gray-600 hover:text-indigo-600 mt-1">
                        {{ __('Leaderboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-base font-bold text-indigo-600 dark:text-indigo-600 mt-1">
                            {{ __('Panel Admin') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.courts.index')" :active="request()->routeIs('admin.courts.index')" class="text-base font-bold text-gray-600 dark:text-gray-600 hover:text-indigo-600 mt-1">
                            {{ __('Kelola Lapangan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.calendar')" :active="request()->routeIs('admin.calendar')" class="text-base font-bold text-gray-600 dark:text-gray-600 hover:text-indigo-600 mt-1">
                            {{ __('Jadwal Global') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('booking.index')" :active="request()->routeIs('booking.index')" class="text-base font-bold text-gray-600 dark:text-gray-600 hover:text-indigo-600 mt-1">
                            {{ __('Riwayat Booking') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-bold rounded-full text-gray-700 dark:text-gray-700 bg-white hover:bg-gray-50 hover:text-indigo-600 focus:outline-none transition-all duration-300 shadow-sm">
                            <div class="flex items-center gap-2">
                                @if(Auth::user()->role === 'admin')
                                    <span class="bg-indigo-100 text-indigo-700 text-[10px] px-2 py-0.5 rounded-md uppercase font-black tracking-tighter">Admin</span>
                                @endif
                                <div>{{ Auth::user()->name }}</div>
                            </div>

                            <div class="ml-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden min-w-[200px] -m-1.5 relative z-50">
                            <div class="px-5 py-3 border-b border-gray-50 bg-gray-50/50">
                                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Pengaturan Akun</p>
                            </div>

                            <div class="p-2 space-y-1 bg-white">
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-200 group">
                                    <div class="p-2 bg-gray-100 group-hover:bg-indigo-100 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 text-gray-500 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    {{ __('Profile') }}
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50 rounded-xl transition-all duration-200 group text-left">
                                        <div class="p-2 bg-red-50/50 group-hover:bg-red-100 rounded-lg transition-colors">
                                            <svg class="w-4 h-4 text-red-400 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                        </div>
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100 shadow-lg">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Katalog') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('leaderboard')" :active="request()->routeIs('leaderboard')">
                {{ __('Leaderboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Panel Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.courts.index')" :active="request()->routeIs('admin.courts.index')">
                    {{ __('Kelola Lapangan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.calendar')" :active="request()->routeIs('admin.calendar')">
                    {{ __('Jadwal Global') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('booking.index')" :active="request()->routeIs('booking.index')">
                    {{ __('Riwayat Booking') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
