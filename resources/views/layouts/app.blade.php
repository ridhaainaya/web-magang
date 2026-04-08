<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Si APPEM') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    <div class="flex min-h-screen" x-data="{ open: true }">
        
        <aside :class="open ? 'w-64' : 'w-20'" class="bg-white border-r border-gray-100 transition-all duration-300 flex flex-col z-40 sticky top-0 h-screen">
            <div class="h-20 flex items-center px-6 border-b border-gray-50">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo-karanganyar.png') }}" class="h-10 w-auto" alt="Logo">
                    <div x-show="open" class="flex flex-col leading-tight">
                        <span class="font-bold text-blue-600">Si</span>
                        <span class="font-bold text-purple-600 uppercase text-[10px]">APPEM</span>
                    </div>
                </div>
            </div>

            <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                    <i class="fas fa-th-large w-6 text-center"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm">Dashboard</span>
                </a>

                <a href="{{ route('permohonan.create') }}" class="flex items-center p-3 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-blue-600 transition-all duration-200">
                    <i class="fas fa-list-ul w-6 text-center"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm text-nowrap">Permohonan Magang</span>
                </a>

                <a href="#" class="flex items-center p-3 rounded-xl text-gray-400 hover:bg-gray-50 hover:text-blue-600 transition-all duration-200">
                    <i class="fas fa-cloud-download-alt w-6 text-center"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm text-nowrap">Download Dokumen</span>
                </a>

                <div class="pt-4 pb-2">
                    <p x-show="open" class="px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest">Account</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-600' : 'text-gray-400 hover:bg-gray-50 hover:text-blue-600' }} transition-all duration-200">
                    <i class="fas fa-user-edit w-6 text-center"></i>
                    <span x-show="open" class="ms-3 font-semibold text-sm">Edit Profile</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 rounded-xl text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-6 text-center"></i>
                        <span x-show="open" class="ms-3 font-semibold text-sm">Keluar</span>
                    </button>
                </form>
            </nav>

            <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 shadow-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <div x-show="open" class="ms-3 overflow-hidden">
                        <p class="text-xs font-bold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-400">Mahasiswa Magang</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-grow flex flex-col h-screen overflow-hidden">
            <header class="h-20 bg-white/80 backdrop-blur-md sticky top-0 z-30 flex items-center justify-between px-8 border-b border-gray-100">
                <div class="flex items-center space-x-4">
                    <button @click="open = !open" class="p-2 rounded-lg bg-gray-50 text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ now()->translatedFormat('l') }}</p>
                        <p class="text-xs font-semibold text-gray-700">{{ now()->translatedFormat('d F Y') }}</p>
                    </div>
                    <div class="h-8 w-[1px] bg-gray-100 mx-2"></div>
                    <i class="far fa-calendar-alt text-gray-400"></i>
                </div>
            </header>

            <main class="flex-grow p-8 overflow-y-auto bg-slate-50/30">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>