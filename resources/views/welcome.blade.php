<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si TAMA - Sistem Pendaftaran Magang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">

    <nav x-data="{ open: false }" class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-8 md:px-16 lg:px-24">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-karanganyar.png') }}" alt="Logo" class="h-12 w-auto">
                    <div class="flex flex-col justify-center leading-tight">
                        <span class="text-slate-800 font-bold text-lg tracking-tight">BAPPERIDA</span>
                        <span class="text-slate-500 text-[10px] font-medium uppercase tracking-widest">Kabupaten Karanganyar</span>
                    </div>
                </div>

                <div class="hidden md:flex space-x-10 items-center text-xs font-bold tracking-widest uppercase">
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-1">Home</a>
                    <a href="#" class="text-gray-500 hover:text-blue-600 transition">User Manual</a>
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-blue-600 transition">Login</a>
                    <button class="text-gray-400 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="open = ! open" class="text-gray-500 hover:text-blue-600 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-50 px-8 py-4 space-y-4 shadow-inner">
            <a href="#" class="block text-sm font-bold text-blue-600 uppercase">Home</a>
            <a href="#" class="block text-sm font-bold text-gray-500 uppercase">User Manual</a>
            <a href="{{ route('login') }}" class="block text-sm font-bold text-gray-500 uppercase">Login</a>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto px-8 md:px-16 lg:px-24 py-12 md:py-24 flex flex-col md:flex-row items-center justify-between w-full">
        
        <div class="w-full md:w-[60%] flex justify-center md:justify-start mb-12 md:mb-0 md:pr-10">
            <img src="{{ asset('images/ilustrasi-welcome.png') }}" 
                 alt="Illustration" 
                 class="w-full h-auto drop-shadow-2xl">
        </div>

        <div class="w-full md:w-[40%] space-y-8 text-center md:text-right">
            <div>
                <h1 class="text-6xl md:text-8xl font-extrabold text-slate-800 tracking-tighter">
                    Si <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">TAMA</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-500 font-light mt-4 leading-relaxed">
                    Sistem Pendaftaran Magang
                </p>
            </div>
            
            <div class="pt-4">
                <a href="{{ route('register') }}" 
                   class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-12 py-4 rounded-lg font-bold tracking-widest hover:shadow-xl hover:-translate-y-1 transition-all duration-300 uppercase text-sm">
                    Registrasi Akun Sekarang
                </a>
            </div>

            <div class="flex items-center justify-center md:justify-end space-x-6 text-gray-400 text-xs">
                <span class="flex items-center"><i class="fas fa-check-circle text-blue-400 mr-2"></i> Mudah</span>
                <span class="flex items-center"><i class="fas fa-check-circle text-blue-400 mr-2"></i> Cepat</span>
                <span class="flex items-center"><i class="fas fa-check-circle text-blue-400 mr-2"></i> Transparan</span>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-8 md:px-16 lg:px-24">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                
                <div class="text-gray-500 text-sm font-medium">
                    &copy; 2026 <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 font-bold">BAPPERIDA</span> Kabupaten Karanganyar.
                </div>

                <div class="flex items-center space-x-6 text-gray-400">
                    <a href="#" class="hover:text-blue-600 transition text-lg"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-pink-600 transition text-lg"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-red-600 transition text-lg"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="hover:text-blue-400 transition text-lg"><i class="fab fa-twitter"></i></a>
                </div>

            </div>
        </div>
    </footer>

</body>
</html>