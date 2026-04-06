<x-guest-layout>

    <x-slot name="title">
        Daftar Akun | Si APPEM
    </x-slot>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo-karanganyar.png') }}" class="h-20 w-auto shadow-sm" alt="Logo">
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full placeholder:text-sm placeholder:text-gray-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
            placeholder="Contoh: Andi Xxx" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full placeholder:text-sm placeholder:text-gray-400" type="email" name="email" :value="old('email')" required autocomplete="username" 
            placeholder="Contoh: andixxx@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full placeholder:text-sm placeholder:text-gray-400"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full placeholder:text-sm placeholder:text-gray-400"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Ulangi password di atas" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center mt-8 space-y-4">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-700 hover:to-purple-700 transition ease-in-out duration-150 shadow-lg">
                {{ __('Daftar Sekarang') }}
            </button>

            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a class="font-semibold text-indigo-600 hover:text-indigo-800 transition duration-150" href="{{ route('login') }}">
                    Login di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>