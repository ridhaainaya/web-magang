<x-guest-layout>
    <x-slot name="title">
        Login | Si RAMA
    </x-slot>

    <!-- CSS Tambahan untuk override default layout Breeze yang sempit -->
    <style>
        /* Menghilangkan paksaan lebar sempit dari guest layout bawaan */
        .min-h-screen > div { width: 100% !important; max-width: 100% !important; padding: 0 !important; box-shadow: none !important; background: transparent !important; }
    </style>

    <!-- Container Utama: Background Ungu Full Screen -->
    <div class="min-h-screen w-full flex items-center justify-center bg-[#f0f2ff] p-4 md:p-10">
        
        <!-- Kartu Putih Utama: Lebar Maksimal untuk Web Desktop -->
       <!-- Kartu Putih Utama: Ukuran dikecilkan dari 1100px ke 900px dan min-h dikurangi -->
        <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-[850px] flex flex-col md:flex-row overflow-hidden min-h-[px]">
            
            <!-- --- KOLOM KIRI (Visual) --- -->
            <div class="w-full md:w-[45%] p-10 lg:p-14 flex flex-col bg-[#f8f9ff] justify-between">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <a href="/">
                        <x-application-logo class="h-10 w-auto" />
                    </a>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">Si RAMA</span>
                </div>

               <!-- Konten Tengah: Gambar & Slogan -->
                <div class="flex flex-col items-center text-center my-10">
                    <!-- Gambar langsung tanpa kotak pembungkus -->
                    <div class="w-full max-w-[300px] mb-8">
                        <img src="{{ asset('images/programmer-working-desk.png') }}" 
                            alt="Illustration" 
                            class="w-full h-auto drop-shadow-2xl transform transition-all duration-700 hover:scale-105 animate-float">
                    </div>

                    <!-- Judul Slogan -->
                    <h2 class="text-2xl lg:text-xl font-extrabold text-gray-900 leading-snug">
                        Pendaftaran jadi lebih mudah!
                    </h2>
                </div>

                <style>
                    @keyframes float {
                        0%, 100% { transform: translateY(0px); }
                        50% { transform: translateY(-15px); } 
                    }
                    .animate-float { 
                        animation: float 6s ease-in-out infinite; 
                    }
                </style>

                <!-- Footer Kiri -->
                <div class="text-xs text-gray-400">
                    &copy; {{ date('Y') }} Bapperida. All rights reserved.
                </div>
            </div>

            <!-- --- KOLOM KANAN (Formulir) --- -->
            <div class="w-full md:w-[55%] p-10 lg:p-16 flex flex-col justify-center">
                
                <div class="max-w-md mx-auto w-full">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Masuk</h1>
                    <p class="text-gray-500 mb-8">Silakan masukkan detail akun Anda untuk melanjutkan.</p>

                    <x-auth-session-status class="mb-6" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                            <x-text-input id="email" class="block mt-1 w-full border-gray-200 rounded-xl focus:ring-indigo-500 py-3" type="email" name="email" :value="old('email')" required autofocus placeholder="andixxx@gmail.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                            <div class="relative mt-1">
                                <input id="password" 
                                    class="border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full pr-12 py-3"
                                    type="password"
                                    name="password"
                                    required placeholder="Masukkan password" />
                                
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-indigo-600 transition">
                                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Opsi -->
                        <div class="flex items-center justify-between">
                            <label for="remember_me" class="flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600 italic">Ingat saya</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-indigo-600 hover:underline" href="{{ route('password.request') }}">Lupa password?</a>
                            @endif
                        </div>

                        <!-- Tombol -->
                        <div class="pt-4 space-y-4">
                            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all active:scale-[0.98]">
                                MASUK SEKARANG
                            </button>
                            <p class="text-center text-sm text-gray-500">
                                Belum punya akun? 
                                <a class="font-bold text-indigo-600 hover:text-indigo-800" href="{{ route('register') }}">Daftar di sini</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
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