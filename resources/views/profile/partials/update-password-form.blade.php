<section>
    <header class="mb-8">
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Update Password</h2>
        <p class="mt-2 text-gray-500 font-medium">Pastikan akun kamu menggunakan password yang panjang dan aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 mb-2">Password Saat Ini</label>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 mb-2">Password Baru</label>
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 mb-2">Konfirmasi Password</label>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 px-8 rounded-2xl transition-all duration-300 shadow-[0_8px_30px_rgb(79,70,229,0.3)] hover:shadow-[0_8px_30px_rgb(79,70,229,0.5)] hover:-translate-y-0.5 uppercase text-[11px] tracking-widest">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold">Berhasil disimpan!</p>
            @endif
        </div>
    </form>
</section>
