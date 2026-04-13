<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Si APPEM') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* TRIK KUNCI HEADER: Menyiapkan ruang scrollbar agar header tidak geser */
        html {
            scrollbar-gutter: stable;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white h-full">
    @php
        // Ambil data untuk mengecek apakah form pendaftaran harus dikunci
        $isLocked = \App\Models\Application::where('user_id', auth()->id())
                    ->whereIn('status', ['diproses', 'diterima'])
                    ->exists();
    @endphp

    <div class="flex min-h-screen relative" x-data="{ open: window.innerWidth > 1024 }">
        
        <div x-show="open && window.innerWidth < 1024" 
             x-transition:opacity
             @click="open = false"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden">
        </div>

        <aside 
            :class="{
                'w-64 translate-x-0 visible': open, 
                'w-20 translate-x-0 hidden lg:flex': !open && window.innerWidth > 1024,
                '-translate-x-full invisible lg:visible': !open && window.innerWidth < 1024
            }"
            class="bg-white border-r border-gray-100 transition-all duration-300 flex flex-col z-50 fixed lg:sticky top-0 h-screen shadow-2xl lg:shadow-none shrink-0">
            
            <div class="h-20 flex items-center px-6 border-b border-gray-50 shrink-0">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo-karanganyar.png') }}" class="h-10 w-auto" alt="Logo">
                    <div x-show="open" class="flex flex-col leading-tight">
                        <span class="font-bold text-blue-600">Si</span>
                        <span class="font-bold text-purple-600 uppercase text-[10px]">TAMA</span>
                    </div>
                </div>
            </div>

            <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                    <i class="fas fa-th-large w-6 text-center shrink-0"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm">Dashboard</span>
                </a>

                <a href="{{ $isLocked ? '#' : route('permohonan.create') }}" 
                   class="flex items-center p-3 rounded-xl transition-all duration-200 
                   {{ $isLocked ? 'opacity-50 cursor-not-allowed text-gray-300' : (request()->routeIs('permohonan.create') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:bg-gray-50 hover:text-blue-600') }}">
                    <i class="fas fa-list-ul w-6 text-center shrink-0"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm text-nowrap">Permohonan Magang</span>
                    @if($isLocked)
                        <i x-show="open" class="fas fa-lock ms-auto text-[10px] opacity-40"></i>
                    @endif
                </a>

                <a href="{{ route('permohonan.download') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('permohonan.download') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                    <i class="fas fa-cloud-download-alt w-6 text-center shrink-0"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm text-nowrap">Download Dokumen</span>
                </a>

                <div class="pt-4 pb-2">
                    <p x-show="open" class="px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest transition-all">Account</p>
                    <hr x-show="!open" class="border-gray-50 mx-2">
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                    <i class="fas fa-user-edit w-6 text-center shrink-0"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm">Edit Profile</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 rounded-xl text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-6 text-center shrink-0"></i>
                        <span x-show="open" class="ms-3 font-semibold text-sm">Keluar</span>
                    </button>
                </form>
            </nav>

            <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 shadow-sm shrink-0">
                        <i class="fas fa-user"></i>
                    </div>
                    <div x-show="open" class="ms-3 overflow-hidden">
                        <p class="text-xs font-bold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-400">Mahasiswa Magang</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-20 bg-white/80 backdrop-blur-md sticky top-0 z-30 flex items-center justify-between px-8 border-b border-slate-100 w-full shrink-0">
                <div class="flex items-center space-x-4">
                    <button @click="open = !open" 
                            class="p-2.5 rounded-xl bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 active:scale-95">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                    
                    <div class="flex flex-col lg:hidden">
                        <h2 class="font-bold text-slate-800 tracking-tight">Si <span class="text-blue-600">TAMA</span></h2>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">
                            {{ now()->translatedFormat('l') }}
                        </p>
                        <p class="text-xs font-semibold text-slate-600">
                            {{ now()->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div class="h-8 w-[1px] bg-slate-100 mx-1"></div>
                    <div class="text-blue-500/70">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 bg-slate-50/30 p-4 md:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @if(session('error') || session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
             class="fixed bottom-5 right-5 z-[100] {{ session('error') ? 'bg-red-600' : 'bg-emerald-600' }} text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center animate-bounce-short">
            <i class="fas {{ session('error') ? 'fa-exclamation-triangle' : 'fa-check-circle' }} mr-3"></i>
            <span class="font-bold text-sm">{{ session('error') ?? session('status') }}</span>
        </div>
    @endif
</body>
</html>