<div x-data="{ 
    open: false, 
    title: 'Konfirmasi Tindakan', 
    message: 'Apakah Anda yakin ingin melanjutkan?', 
    confirmText: 'Ya, Lanjutkan', 
    cancelText: 'Batal',
    formToSubmit: null,
    
    show(msg, title = 'Konfirmasi', confirmBtn = 'Ya, Lanjutkan', formId = null) {
        this.message = msg;
        this.title = title;
        this.confirmText = confirmBtn;
        this.formToSubmit = formId;
        this.open = true;
    },
    
    confirm() {
        if (this.formToSubmit) {
            const form = document.getElementById(this.formToSubmit);
            if (form) {
                form.submit();
            }
        }
        this.open = false;
    }
}" 
x-on:open-confirm-modal.window="show($event.detail.message, $event.detail.title, $event.detail.confirmText, $event.detail.formId)"
x-show="open" 
class="fixed inset-0 z-[200] overflow-y-auto" 
style="display: none;">
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <!-- Backdrop -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" 
             @click="open = false"></div>

        <!-- Modal Content -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 scale-95 translate-y-4" 
             x-transition:enter-end="opacity-100 scale-100 translate-y-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 scale-100 translate-y-0" 
             x-transition:leave-end="opacity-0 scale-95 translate-y-4" 
             class="relative bg-white rounded-[2.5rem] shadow-2xl transform transition-all sm:my-8 sm:max-w-md sm:w-full p-10 z-[210] text-center overflow-hidden">
            
            <!-- Decorative Background -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-indigo-50 opacity-50 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-red-50 opacity-50 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <!-- Icon -->
                <div class="w-20 h-20 bg-red-50 rounded-[2rem] flex items-center justify-center text-red-500 mx-auto mb-8 shadow-sm border border-red-100">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>

                <h3 class="text-2xl font-black text-gray-900 mb-4 tracking-tight" x-text="title"></h3>
                <p class="text-gray-500 font-medium mb-10 leading-relaxed" x-text="message"></p>

                <div class="flex flex-col gap-3">
                    <button @click="confirm()" class="w-full bg-red-500 text-white font-black py-4 rounded-2xl hover:bg-red-600 transition-all shadow-xl shadow-red-100 transform active:scale-95 text-xs uppercase tracking-widest">
                        <span x-text="confirmText"></span>
                    </button>
                    <button @click="open = false" class="w-full bg-gray-50 text-gray-400 font-black py-4 rounded-2xl hover:bg-gray-100 transition-all text-xs uppercase tracking-widest">
                        <span x-text="cancelText"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
