<x-app-layout>
    @php
        // Ambil data permohonan terakhir milik user
        $application = \App\Models\Application::where('user_id', auth()->id())->latest()->first();
    @endphp

    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 md:p-10 text-white shadow-xl shadow-blue-200/50 mb-10">
        <div class="relative z-10">
            <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="mt-3 opacity-90 text-sm md:text-lg font-medium max-w-2xl">
                Selamat datang di <span class="underline decoration-2 underline-offset-4 decoration-white/30">Si TAMA</span>. Pantau status pendaftaran dan unduh dokumen magang Anda di sini.
            </p>
        </div>
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-6">
                @if(!$application)
                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-400 text-xl border border-gray-100">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <span class="px-3 py-1 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase rounded-full border border-gray-100">Kosong</span>
                @elseif($application->status == 'diproses')
                    <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 text-xl border border-amber-100">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                    <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase rounded-full border border-amber-100">Proses</span>
                @elseif($application->status == 'diterima')
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 text-xl border border-emerald-100">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase rounded-full border border-emerald-100">Diterima</span>
                @else
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 text-xl border border-red-100">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-bold uppercase rounded-full border border-red-100">Ditolak</span>
                @endif
            </div>

            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Status Permohonan</h3>
            
            <p class="text-xl font-extrabold text-gray-800">
                @if(!$application) Belum Mengajukan @elseif($application->status == 'diproses') Menunggu Review @elseif($application->status == 'diterima') Disetujui @else Pendaftaran Ditolak @endif
            </p>
            
            @if(!$application || $application->status == 'ditolak')
                <a href="{{ route('permohonan.create') }}" class="inline-block text-xs text-blue-600 mt-2 font-bold hover:underline">
                    Daftar Sekarang &rarr;
                </a>
            @else
                <p class="text-xs text-gray-400 mt-2 italic">*Data terkunci selama proses</p>
            @endif
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 {{ $application && $application->status == 'diterima' ? 'bg-purple-50 text-purple-600 border-purple-100' : 'bg-gray-50 text-gray-300 border-gray-100' }} rounded-2xl flex items-center justify-center text-xl border">
                    <i class="fas fa-file-download"></i>
                </div>
            </div>
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Unduhan Tersedia</h3>
            <p class="text-xl font-extrabold text-gray-800">Dokumen Balasan</p>
            
            @if($application && $application->status == 'diterima')
                <a href="{{ route('permohonan.download') }}" class="text-xs text-purple-600 mt-2 font-bold hover:underline block">Lihat Daftar Dokumen &rarr;</a>
            @else
                <p class="text-xs text-gray-400 mt-2 italic">Belum tersedia</p>
            @endif
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 text-xl border border-emerald-100">
                    <i class="fas fa-id-card"></i>
                </div>
                @if(auth()->user()->profile)
                    <i class="fas fa-check-circle text-emerald-500"></i>
                @endif
            </div>
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Biodata Mahasiswa</h3>
            <p class="text-xl font-extrabold text-gray-800">{{ auth()->user()->profile ? 'Data Lengkap' : 'Lengkapi Profil' }}</p>
            <a href="{{ route('profile.edit') }}" class="text-xs text-emerald-600 mt-2 font-bold hover:underline block">
                {{ auth()->user()->profile ? 'Update Profil' : 'Lengkapi Sekarang' }} &rarr;
            </a>
        </div>
    </div>
</x-app-layout>