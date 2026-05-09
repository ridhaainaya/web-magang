<x-guest-layout>
    <x-slot name="title">
        Daftar Akun | Si RAMA
    </x-slot>

    <style>
        .min-h-screen > div { width: 100% !important; max-width: 100% !important; padding: 0 !important; box-shadow: none !important; background: transparent !important; }
    </style>

    <div class="min-h-screen w-full flex items-center justify-center bg-[#f0f2ff] p-4 md:p-10">
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-[800px] flex flex-col md:flex-row overflow-hidden min-h-[500px]">
            
            <div class="w-full md:w-[45%] p-10 lg:p-14 flex flex-col bg-[#f8f9ff] justify-between">
                <div class="flex items-center gap-3">
                    <a href="/">
                        <x-application-logo class="h-10 w-auto" />
                    </a>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">Si RAMA</span>
                </div>

                <div class="flex flex-col items-center text-center my-10">
                    <div class="w-full max-w-[300px] mb-8">
                        <img src="{{ asset('images/programmer-working-desk.png') }}" 
                            alt="Illustration" 
                            class="w-full h-auto drop-shadow-2xl transform transition-all duration-700 hover:scale-105 animate-float">
                    </div>
                    <h2 class="text-2xl lg:text-xl font-extrabold text-gray-900 leading-snug">
                        Pendaftaran jadi lebih mudah!
                    </h2>
                </div>

                <style>
                    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-15px); } }
                    .animate-float { animation: float 6s ease-in-out infinite; }
                </style>

                <div class="text-xs text-gray-400">
                    &copy; {{ date('Y') }} Bapperida. All rights reserved.
                </div>
            </div>

            <div class="w-full md:w-[55%] p-8 lg:p-12 flex flex-col justify-center">
                <div class="max-w-md mx-auto w-full">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Daftar Akun</h1>
                    <p class="text-sm text-gray-500 mb-6">Lengkapi data diri Anda untuk bergabung.</p>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-semibold" />
                            <x-text-input id="name" class="block mt-1 w-full border-gray-200 rounded-xl focus:ring-indigo-500 py-2.5" type="text" name="name" :value="old('name')" required autofocus placeholder="Contoh: Andi Xxx" />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                            <x-text-input id="email" class="block mt-1 w-full border-gray-200 rounded-xl focus:ring-indigo-500 py-2.5" type="email" name="email" :value="old('email')" required placeholder="andixxx@gmail.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div x-data="{ 
                            password: '', 
                            get strength() {
                                if (this.password.length === 0) return -1;
                                let score = 0;
                                if (this.password.length >= 8) score++;
                                if (/[A-Z]/.test(this.password)) score++;
                                if (/[0-9]/.test(this.password)) score++;
                                if (/[^A-Za-z0-9]/.test(this.password)) score++;
                                return score;
                            }
                        }">
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                            <div class="relative mt-1">
                                <input id="password" 
                                        x-model="password"
                                        class="border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full pr-12 py-2.5"
                                        type="password"
                                        name="password"
                                        required 
                                        minlength="8"
                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                        title="Password harus minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka."
                                        placeholder="Minimal 8 karakter" />
                                
                                <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-indigo-600">
                                    <svg id="eye-icon-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-2 flex gap-1 h-1" x-show="password.length > 0">
                                <template x-for="i in 4">
                                    <div class="flex-1 rounded-full transition-all duration-500"
                                         :class="i <= strength ? (strength <= 2 ? 'bg-red-400' : strength === 3 ? 'bg-amber-400' : 'bg-emerald-500') : 'bg-gray-100'">
                                    </div>
                                </template>
                            </div>
                            
                            <p class="text-[9px] font-bold uppercase tracking-widest mt-1.5" 
                               x-show="password.length > 0"
                               :class="strength <= 2 ? 'text-red-500' : strength === 3 ? 'text-amber-500' : 'text-emerald-600'"
                               x-text="strength <= 2 ? '⚠️ Password Lemah' : strength === 3 ? '⚡ Lumayan Kuat' : '✨ Sangat Kuat!'">
                            </p>

                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold" />
                            <div class="relative mt-1">
                                <input id="password_confirmation" 
                                    class="border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full pr-12 py-2.5"
                                    type="password"
                                    name="password_confirmation" 
                                    required placeholder="Ulangi password" />
                                
                                <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-indigo-600">
                                    <svg id="eye-icon-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>

                        <div class="pt-4 space-y-4">
                            <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all active:scale-[0.98] uppercase text-xs tracking-widest">
                                {{ __('Daftar Sekarang') }}
                            </button>
                            <p class="text-center text-sm text-gray-500">
                                Sudah punya akun? 
                                <a class="font-bold text-indigo-600 hover:text-indigo-800 transition" href="{{ route('login') }}">Login di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />';
            }
        }
    </script>
</x-guest-layout>