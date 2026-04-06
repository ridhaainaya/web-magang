<x-guest-layout>
    <x-slot name="title">
        Lupa Password | Si APPEM
    </x-slot>

    <div class="flex justify-center mb-6">
        <a href="/">
            <x-application-logo class="h-20 w-auto" />
        </a>
    </div>

    <div class="mb-6 text-sm text-gray-600 text-center leading-relaxed">
        {{ __('Lupa password? Beritahu kami alamat email Anda dan kami akan mengirimkan link reset password untuk membuat yang baru.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full placeholder:text-sm placeholder:text-gray-400" 
                type="email" name="email" :value="old('email')" 
                required autofocus 
                placeholder="Contoh: andixxx@gmail.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center mt-8 space-y-4">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gradient-to-r from-blue-600 to-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-700 hover:to-purple-700 transition shadow-lg">
                {{ __('Kirim Link Reset Password') }}
            </button>

            <p class="text-sm text-gray-600">
                Sudah ingat password? 
                <a class="font-semibold text-indigo-600 hover:text-indigo-800 transition" href="{{ route('login') }}">
                    Kembali ke Login
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>