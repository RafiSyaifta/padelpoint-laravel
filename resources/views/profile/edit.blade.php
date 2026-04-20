<x-app-layout>
    <div class="pt-8 pb-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10">
                <h2 class="font-black text-3xl lg:text-4xl text-gray-900 tracking-tight">Pengaturan Profil</h2>
                <p class="text-gray-500 mt-2 font-medium text-lg">Kelola informasi akun dan keamanan PadelPoint kamu.</p>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 lg:p-12 transition-all duration-300 hover:shadow-md">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 lg:p-12 transition-all duration-300 hover:shadow-md">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-red-50 p-8 lg:p-12 border-dashed border-red-200">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
