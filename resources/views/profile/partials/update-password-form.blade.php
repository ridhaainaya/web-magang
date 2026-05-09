<section class="relative overflow-hidden">
    <!-- Header Section -->
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-1.5 h-8 bg-indigo-500 rounded-full"></div>
            <h2 class="text-2xl font-bold text-[#1E293B]">
                {{ __('Update Password') }}
            </h2>
        </div>
        <p class="mt-1 text-sm text-[#64748B] leading-relaxed">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Container Form dengan gaya yang seragam -->
        <div class="bg-white p-6 md:p-8 rounded-[1.5rem] border border-white shadow-[0_10px_25px_rgba(0,0,0,0.03)] space-y-5">
            
            <!-- Password Sekarang -->
            <div class="group">
                <x-input-label for="update_password_current_password" :value="__('Password Sekarang')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-indigo-500 transition-colors" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 transition-all bg-gray-50/30" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs" />
            </div>

            <!-- Password Baru -->
            <div class="group">
                <x-input-label for="update_password_password" :value="__('Password Baru')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-indigo-500 transition-colors" />
                <x-text-input id="update_password_password" name="password" type="password" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 transition-all bg-gray-50/30" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Konfirmasi Password -->
            <div class="group">
                <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-indigo-500 transition-colors" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 transition-all bg-gray-50/30" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs" />
            </div>

            <!-- Action Section: Seragam dengan penutup biodata -->
            <div class="flex items-center gap-4 pt-4 border-t border-gray-50 mt-4">
                <x-primary-button class="bg-[#6366F1] hover:bg-[#4F46E5] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-[0_10px_20px_rgba(99,102,241,0.2)] transition-all duration-300 flex items-center border-none">
                    <i class="fas fa-key mr-2 text-[10px]"></i> {{ __('Simpan') }}
                </x-primary-button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-green-600 font-bold flex items-center bg-green-50 px-4 py-2 rounded-full border border-green-100">
                        <i class="fas fa-check-circle mr-2"></i> {{ __('Tersimpan.') }}
                    </p>
                @endif
            </div>
        </div>
    </form>
</section>