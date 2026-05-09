<x-app-layout>
    @php
        // Ambil data permohonan terakhir milik user
        $application = \App\Models\Application::where('user_id', auth()->id())->latest()->first();
    @endphp

    <!-- Background: Bukan putih polos, tapi off-white dengan tint lembut -->
    <div class="min-h-screen bg-[#F4F7FA] p-6 md:p-10 font-sans text-[#333]">
        
        <!-- Bagian Banner Utama (Revisi: Tanpa View Calendar & Bahasa Indonesia) -->
        <div class="relative overflow-hidden bg-[#EEF5F1] rounded-[2.5rem] p-10 md:p-14 mb-10 border border-[#E2EBE5]">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                <div class="max-w-2xl text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#2D3F33] leading-tight">
                        Pantau terus progres dan kegiatan magangmu di sini
                    </h1>
                    <p class="mt-4 text-[#6A7C70] text-base md:text-lg font-medium leading-relaxed">
                        Halo, <span class="text-[#4CAF50] font-bold">{{ Auth::user()->name }}!</span> 👋 Selamat datang di <span class="font-bold">Si TAMA</span>. Jangan lupa cek status pendaftaranmu secara berkala ya.
                    </p>
                </div>
                
                <!-- Ikon Dekoratif yang simpel -->
                <div class="hidden md:block">
                     <div class="w-40 h-40 bg-white/60 rounded-[2rem] flex items-center justify-center shadow-sm border border-white/80 rotate-3">
                        <i class="fas fa-paper-plane text-5xl text-[#4CAF50] opacity-70"></i>
                     </div>
                </div>
            </div>
            <!-- Elemen pemanis latar belakang -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#4CAF50]/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Dashboard Cards (Logic & Tata Letak tetap sesuai kode awal) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Kartu 1: Status (Kuning Pastel) -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-[#F0F0F0] shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-[#FFF9E6] rounded-2xl flex items-center justify-center text-[#F4B400] text-xl shadow-sm">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div>
                        <h3 class="text-[#A0A0A0] text-[10px] font-black uppercase tracking-[0.15em]">Status</h3>
                        <p class="text-lg font-bold text-[#2D3F33]">Permohonan</p>
                    </div>
                </div>

                <div class="p-5 bg-[#FFFCF2] rounded-2xl border border-[#FFF4D1] mb-6">
                    <p class="text-sm font-bold text-[#856404]">
                         @if(!$application) Belum Mengajukan @elseif($application->status == 'diproses') Sedang Direview @elseif($application->status == 'diterima') Diterima @else Pendaftaran Ditolak @endif
                    </p>
                </div>
                
                @if(!$application || $application->status == 'ditolak')
                    <a href="{{ route('permohonan.create') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#4CAF50] hover:bg-[#4CAF50]/5 px-4 py-2 rounded-lg transition-colors">
                        Buat Pendaftaran <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                @else
                    <p class="text-[11px] text-[#BBB] font-medium italic px-2">Terakhir diupdate: {{ $application->updated_at->format('d M Y') }}</p>
                @endif
            </div>

            <!-- Kartu 2: Unduhan (Ungu Pastel) -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-[#F0F0F0] shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-[#F5F2FF] rounded-2xl flex items-center justify-center text-[#7C4DFF] text-xl shadow-sm">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <div>
                        <h3 class="text-[#A0A0A0] text-[10px] font-black uppercase tracking-[0.15em]">Unduhan</h3>
                        <p class="text-lg font-bold text-[#2D3F33]">Berkas Balasan</p>
                    </div>
                </div>

                <div class="p-5 bg-[#F9F8FF] rounded-2xl border border-[#EBE7FF] mb-6">
                    <p class="text-sm font-bold text-[#5E35B1]">
                        {{ $application && $application->status == 'diterima' ? 'Dokumen sudah siap' : 'Belum tersedia' }}
                    </p>
                </div>

                @if($application && $application->status == 'diterima')
                    <a href="{{ route('permohonan.download') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#7C4DFF] hover:bg-[#7C4DFF]/5 px-4 py-2 rounded-lg transition-colors">
                        Download Berkas <i class="fas fa-download text-[10px]"></i>
                    </a>
                @else
                    <p class="text-[11px] text-[#BBB] font-medium italic px-2">Cek kembali nanti ya</p>
                @endif
            </div>

            <!-- Kartu 3: Profil (Hijau Pastel) -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-[#F0F0F0] shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 bg-[#EBF7EE] rounded-2xl flex items-center justify-center text-[#4CAF50] text-xl shadow-sm">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <h3 class="text-[#A0A0A0] text-[10px] font-black uppercase tracking-[0.15em]">Profil</h3>
                        <p class="text-lg font-bold text-[#2D3F33]">Data Diri</p>
                    </div>
                </div>

                <div class="p-5 bg-[#F4FAF5] rounded-2xl border border-[#DFF0E3] mb-6">
                    <p class="text-sm font-bold text-[#2E7D32]">
                        {{ auth()->user()->profile ? 'Profil sudah lengkap' : 'Lengkapi profil kamu' }}
                    </p>
                </div>

                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#4CAF50] hover:bg-[#4CAF50]/5 px-4 py-2 rounded-lg transition-colors">
                    Edit Profil Saya <i class="fas fa-user-edit text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>