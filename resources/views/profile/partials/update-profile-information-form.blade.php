<section>
    <header class="mb-6">
        <h2 class="text-xl font-black text-gray-900">Informasi Profil</h2>
        <p class="mt-1 text-sm text-gray-500">Update nama dan alamat email akun kamu.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block font-bold text-xs uppercase tracking-widest text-gray-400 mb-2">Nama</label>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block font-bold text-xs uppercase tracking-widest text-gray-400 mb-2">Email</label>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-3 px-8 rounded-2xl transition-all duration-300 shadow-[0_8px_30px_rgb(79,70,229,0.2)]">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600 font-bold">Tersimpan!</p>
            @endif
        </div>
    </form>
</section>
