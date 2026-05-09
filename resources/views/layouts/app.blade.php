<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Si TAMA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        html { scrollbar-gutter: stable; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        /* Efek cahaya halus pada sidebar */
        .sidebar-glow {
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.05), transparent);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F0F4F8] h-full">
    @php
        $isLocked = \App\Models\Application::where('user_id', auth()->id())
                    ->whereIn('status', ['diproses', 'diterima'])
                    ->exists();
    @endphp

    <div class="flex min-h-screen relative" x-data="{ open: window.innerWidth > 1024 }">
        
        <!-- Overlay Mobile -->
        <div x-show="open && window.innerWidth < 1024" 
             x-transition:opacity
             @click="open = false"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden">
        </div>

        <!-- SIDEBAR (Statis, Colorful Icons, Formal Style) -->
        <aside 
            :class="{
                'w-64 translate-x-0 visible': open, 
                'w-20 translate-x-0 hidden lg:flex': !open && window.innerWidth > 1024,
                '-translate-x-full invisible lg:visible': !open && window.innerWidth < 1024
            }"
            class="bg-white border-r border-[#E2E8F0] transition-all duration-300 flex flex-col z-50 fixed lg:sticky top-0 h-screen shrink-0 sidebar-glow">
            
            <!-- Logo Section: Kembali ke gaya awal Si TAMA bertumpuk -->
            <div class="h-20 flex items-center px-6 border-b border-[#F1F5F9] shrink-0">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo-karanganyar.png') }}" class="h-10 w-auto" alt="Logo">
                    <div x-show="open" class="flex flex-col leading-tight">
                        <span class="font-bold text-blue-600">Si</span>
                        <span class="font-bold text-purple-600 uppercase text-[10px]">TAMA</span>
                    </div>
                </div>
            </div>

            <!-- Menu Navigation -->
            <nav class="flex-grow p-4 space-y-2 overflow-y-auto custom-scrollbar">
            
                @if(Auth::user()->role === 'admin')
                    <div class="pb-2">
                        <p x-show="open" class="px-4 text-[10px] font-black text-[#94A3B8] uppercase tracking-[0.2em]">Administrator</p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-[#64748B] hover:bg-indigo-50/50 hover:text-indigo-600' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'bg-indigo-50 text-indigo-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Statistik Sistem</span>
                    </a>

                    <a href="{{ route('admin.permohonan.index') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('admin.permohonan.index') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-[#64748B] hover:bg-blue-50/50 hover:text-blue-600' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.permohonan.index') ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Daftar Mahasiswa</span>
                    </a>

                    <a href="{{ route('admin.permohonan.list-dokumen') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('admin.permohonan.list-dokumen') ? 'bg-emerald-50 text-emerald-600 shadow-sm' : 'text-[#64748B] hover:bg-emerald-50/50 hover:text-emerald-600' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.permohonan.list-dokumen') ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Upload Balasan</span>
                    </a>

                @else
                    <div class="pb-2">
                        <p x-show="open" class="px-4 text-[10px] font-black text-[#94A3B8] uppercase tracking-[0.2em]">Menu Utama</p>
                    </div>

                    <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-[#64748B] hover:bg-blue-50/50 hover:text-blue-600' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Dashboard Saya</span>
                    </a>

                    <a href="{{ $isLocked ? '#' : route('permohonan.create') }}" 
                        class="flex items-center p-3 rounded-xl transition-all {{ $isLocked ? 'opacity-40 cursor-not-allowed' : (request()->routeIs('permohonan.create') ? 'bg-amber-50 text-amber-600 shadow-sm' : 'text-[#64748B] hover:bg-amber-50/50 hover:text-amber-600') }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('permohonan.create') ? 'bg-amber-500 text-white' : 'bg-amber-50 text-amber-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Daftar Magang</span>
                    </a>

                    <a href="{{ route('permohonan.download') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('permohonan.download') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-[#64748B] hover:bg-indigo-50/50 hover:text-indigo-600' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('permohonan.download') ? 'bg-indigo-600 text-white' : 'bg-indigo-50 text-indigo-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-cloud-download-alt"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Pusat Unduhan</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-xl transition-all {{ request()->routeIs('profile.edit') ? 'bg-emerald-50 text-emerald-600 shadow-sm' : 'text-[#64748B] hover:bg-emerald-50/50 hover:text-emerald-600' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('profile.edit') ? 'bg-emerald-500 text-white' : 'bg-emerald-50 text-emerald-500' }} flex items-center justify-center text-xs shrink-0 transition-colors">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-bold text-sm">Profil Akun</span>
                    </a>
                @endif
            </nav>

            <!-- User Info & Logout (Bottom Section) -->
           <div class="p-6 border-t border-[#F1F5F9] bg-[#F8FAFF]/80 text-center">
                <div x-show="open" class="flex flex-col items-center">
                    <div class="relative mb-3">
                        <div class="absolute -inset-2 border-2 border-transparent border-t-amber-400 border-l-amber-400 rounded-full rotate-45 opacity-70"></div>
                        
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-xl font-black shadow-xl relative z-10 border-4 border-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <div class="mb-5 w-full overflow-hidden px-2">
                        <p class="text-sm font-black text-[#1E293B] tracking-tight leading-none mb-1.5 truncate">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-[9px] font-bold text-[#94A3B8] lowercase tracking-normal opacity-80 truncate">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center p-3 rounded-xl text-[#94A3B8] hover:bg-red-50 hover:text-red-500 transition-all group">
                        <div class="w-8 h-8 rounded-lg bg-white border border-[#F1F5F9] group-hover:border-red-100 flex items-center justify-center text-xs shadow-sm transition-colors">
                            <i class="fas fa-power-off"></i>
                        </div>
                        <span x-show="open" class="ms-3 font-black text-[10px] uppercase tracking-[0.2em]">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Header Section -->
            <header class="h-20 bg-white border-b border-[#E2E8F0] sticky top-0 z-30 flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center space-x-4">
                    <button @click="open = !open" 
                            class="w-10 h-10 rounded-xl bg-[#F8FAFF] text-[#94A3B8] hover:text-blue-600 flex items-center justify-center transition-all border border-[#F1F5F9]">
                        <i class="fas fa-bars-staggered text-sm"></i>
                    </button>
                    <h2 class="font-black text-[#1E293B] lg:hidden">Si <span class="text-blue-600">TAMA</span></h2>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- Kalender Berwarna & Interaktif -->
                    <div x-data="{ openCal: false }" class="relative">
                        <button @click="openCal = !openCal" 
                                class="flex items-center space-x-4 bg-[#F8FAFF] hover:bg-blue-50 px-4 py-2 rounded-2xl border border-[#F1F5F9] transition-all group active:scale-95 shadow-sm">
                            <div class="hidden sm:flex flex-col text-right leading-tight">
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em] mb-0.5">
                                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}
                                </p>
                                <p class="text-xs font-extrabold text-slate-700">
                                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-blue-200 group-hover:rotate-12 transition-transform">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-10">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Alert Notification -->
    @if(session('error') || session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
             class="fixed bottom-8 right-8 z-[100] {{ session('error') ? 'bg-red-500 shadow-red-200' : 'bg-[#10B981] shadow-emerald-200' }} text-white px-7 py-4 rounded-[2rem] shadow-2xl flex items-center animate-bounce-short">
            <i class="fas {{ session('error') ? 'fa-exclamation-triangle' : 'fa-check-circle' }} mr-3 text-lg"></i>
            <span class="font-black text-xs uppercase tracking-widest">{{ session('error') ?? session('status') }}</span>
        </div>
    @endif
</body>
</html>