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
        /* Animasi halus untuk icon */
        .step-card:hover .step-icon { transform: scale(1.1) rotate(5deg); }
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
    </nav>

    <main class="flex-grow">
        <section class="relative max-w-7xl mx-auto px-8 md:px-16 lg:px-24 py-8 md:py-12 overflow-hidden">
            
            <div class="absolute top-0 right-0 -z-10 w-72 h-72 bg-blue-100/50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -z-10 w-96 h-96 bg-purple-100/50 rounded-full blur-3xl opacity-50"></div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12">
                
                <div class="w-full md:w-[50%] relative group"> <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 opacity-20 blur-2xl group-hover:opacity-30 transition-opacity duration-500"></div>
                    
                    <img src="{{ asset('images/ilustrasi-welcome.png') }}" 
                        alt="Illustration" 
                        class="relative w-full h-auto drop-shadow-2xl transform transition-all duration-700 hover:scale-105 animate-float">
                    
                    <style>
                        @keyframes float {
                            0%, 100% { transform: translateY(0px); }
                            50% { transform: translateY(-15px); } /* Ayunan diperhalus */
                        }
                        .animate-float { animation: float 6s ease-in-out infinite; }
                    </style>
                </div>

                <div class="w-full md:w-[50%] space-y-8 text-center md:text-left">

                <!-- BADGE -->
                <div>
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-blue-50 to-purple-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-[0.25em] rounded-full border border-blue-100 shadow-sm">
                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        Official Internship Portal
                    </span>
                </div>

                <!-- TITLE -->
                <div class="space-y-4">
                    <h1 class="text-6xl md:text-7xl font-black text-slate-800 tracking-tight leading-[0.95]">
                        Si 
                        <span class="relative inline-block">
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600">
                                TAMA
                            </span>
                            <!-- Glow effect -->
                            <span class="absolute inset-0 blur-xl opacity-30 bg-gradient-to-r from-blue-600 to-purple-600 -z-10"></span>
                        </span>
                    </h1>

                    <h2 class="text-xl md:text-2xl font-semibold text-slate-500 tracking-tight">
                        Sistem Pendaftaran Magang
                    </h2>

                    <p class="text-slate-400 text-sm leading-relaxed max-w-md mx-auto md:mx-0">
                        Kelola administrasi magangmu di BAPPERIDA Karanganyar dengan lebih praktis, cepat, dan sepenuhnya digital.
                    </p>
                </div>

                <!-- BUTTON -->
                <div class="pt-2">
                    <a href="{{ route('register') }}" 
                    class="group relative inline-flex items-center justify-center px-8 py-3.5 font-bold text-white rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 active:scale-95 text-sm">
                        
                        <!-- Background -->
                        <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600"></span>
                        
                        <!-- Glow -->
                        <span class="absolute inset-0 opacity-0 group-hover:opacity-100 blur-xl bg-gradient-to-r from-blue-600 to-purple-600 transition"></span>

                        <!-- Text -->
                        <span class="relative flex items-center gap-2">
                            REGISTRASI SEKARANG
                            <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </a>
                </div>

            </div>

            </div>
        </section>

        <section class="bg-slate-50 py-24 relative overflow-hidden">
            <div class="absolute top-1/2 left-0 -translate-y-1/2 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60"></div>

            <div class="max-w-7xl mx-auto px-8 md:px-16 lg:px-24 relative z-10">
                <div class="text-center mb-20">
                    <span class="text-blue-600 text-[10px] font-black uppercase tracking-[0.3em] mb-4 block">Simple Process</span>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight">
                        Bagaimana Cara <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">Mendaftar?</span>
                    </h2>
                    <div class="w-20 h-1.5 bg-gradient-to-r from-blue-600 to-purple-600 mx-auto mt-6 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                    
                    <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 border-t-2 border-dashed border-slate-200 -z-0"></div>

                    <div class="group relative">
                        <div class="step-card bg-white/70 backdrop-blur-md p-8 rounded-[2rem] shadow-sm border border-white hover:border-blue-200 hover:shadow-[0_20px_50px_rgba(59,130,246,0.1)] hover:-translate-y-3 transition-all duration-500 relative z-10 overflow-hidden">
                            <div class="absolute -right-6 -top-6 text-slate-100 text-9xl font-black group-hover:text-blue-50 transition-colors duration-500 select-none">1</div>
                            
                            <div class="step-icon w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-8 shadow-xl shadow-blue-200 group-hover:rotate-[10deg] transition-transform duration-500 relative z-20">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            
                            <h3 class="text-xl font-extrabold text-slate-800 mb-4 relative z-20">Buat Akun</h3>
                            <p class="text-sm text-slate-500 leading-relaxed relative z-20 font-medium">
                                Daftarkan diri Anda menggunakan email aktif untuk mendapatkan akses penuh ke dashboard.
                            </p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="step-card bg-white/70 backdrop-blur-md p-8 rounded-[2rem] shadow-sm border border-white hover:border-purple-200 hover:shadow-[0_20px_50px_rgba(168,85,247,0.1)] hover:-translate-y-3 transition-all duration-500 relative z-10 overflow-hidden">
                            <div class="absolute -right-6 -top-6 text-slate-100 text-9xl font-black group-hover:text-purple-50 transition-colors duration-500 select-none">2</div>
                            
                            <div class="step-icon w-16 h-16 bg-gradient-to-br from-purple-600 to-purple-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-8 shadow-xl shadow-purple-200 group-hover:rotate-[10deg] transition-transform duration-500 relative z-20">
                                <i class="fas fa-id-card"></i>
                            </div>
                            
                            <h3 class="text-xl font-extrabold text-slate-800 mb-4 relative z-20">Lengkapi Profil</h3>
                            <p class="text-sm text-slate-500 leading-relaxed relative z-20 font-medium">
                                Isi data diri dan instansi pendidikan secara lengkap untuk kebutuhan validasi dokumen administrasi.
                            </p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="step-card bg-white/70 backdrop-blur-md p-8 rounded-[2rem] shadow-sm border border-white hover:border-indigo-200 hover:shadow-[0_20px_50px_rgba(79,70,229,0.1)] hover:-translate-y-3 transition-all duration-500 relative z-10 overflow-hidden">
                            <div class="absolute -right-6 -top-6 text-slate-100 text-9xl font-black group-hover:text-indigo-50 transition-colors duration-500 select-none">3</div>
                            
                            <div class="step-icon w-16 h-16 bg-gradient-to-br from-indigo-600 to-indigo-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-8 shadow-xl shadow-indigo-200 group-hover:rotate-[10deg] transition-transform duration-500 relative z-20">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            
                            <h3 class="text-xl font-extrabold text-slate-800 mb-4 relative z-20">Kirim Berkas</h3>
                            <p class="text-sm text-slate-500 leading-relaxed relative z-20 font-medium">
                                Unggah surat pengantar resmi dari kampus atau sekolah dalam format PDF yang rapi dan jelas.
                            </p>
                        </div>
                    </div>

                    <div class="group relative">
                        <div class="step-card bg-white/70 backdrop-blur-md p-8 rounded-[2rem] shadow-sm border border-white hover:border-emerald-200 hover:shadow-[0_20px_50px_rgba(16,185,129,0.1)] hover:-translate-y-3 transition-all duration-500 relative z-10 overflow-hidden">
                            <div class="absolute -right-6 -top-6 text-slate-100 text-9xl font-black group-hover:text-emerald-50 transition-colors duration-500 select-none">4</div>
                            
                            <div class="step-icon w-16 h-16 bg-gradient-to-br from-emerald-600 to-emerald-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-8 shadow-xl shadow-emerald-200 group-hover:rotate-[10deg] transition-transform duration-500 relative z-20">
                                <i class="fas fa-check-double"></i>
                            </div>
                            
                            <h3 class="text-xl font-extrabold text-slate-800 mb-4 relative z-20">Cek Status</h3>
                            <p class="text-sm text-slate-500 leading-relaxed relative z-20 font-medium">
                                Pantau progres verifikasi secara real-time melalui dashboard. Mulailah perjalanan magang Anda!
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
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