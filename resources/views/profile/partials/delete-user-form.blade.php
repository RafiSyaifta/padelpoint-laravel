<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Hapus Akun</h2>
        <p class="mt-2 text-gray-500 font-medium">Sekali akun dihapus, semua data akan hilang permanen. Harap berhati-hati.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white font-black py-4 px-8 rounded-2xl transition-all duration-300 shadow-[0_8px_30px_rgb(239,68,68,0.2)] hover:shadow-[0_8px_30_rgb(239,68,68,0.4)] uppercase text-[11px] tracking-widest">
        Hapus Akun Secara Permanen
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-white rounded-[2.5rem]">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-gray-900 tracking-tight">
                Apakah kamu yakin?
            </h2>

            <p class="mt-3 text-gray-500 font-medium leading-relaxed">
                Tindakan ini tidak bisa dibatalkan. Silakan masukkan password kamu untuk mengonfirmasi penghapusan akun PadelPoint secara permanen.
            </p>

            <div class="mt-8">
                <label class="block font-black text-[10px] uppercase tracking-widest text-gray-400 mb-2">Password Konfirmasi</label>
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full !bg-white border-gray-200" placeholder="Masukkan password kamu" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-black rounded-2xl transition-all uppercase text-[10px] tracking-widest">
                    Batal
                </button>

                <button type="submit" class="px-6 py-3.5 bg-red-600 hover:bg-red-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-red-200 uppercase text-[10px] tracking-widest">
                    Hapus Sekarang
                </button>
            </div>
        </form>
    </x-modal>
</section>
