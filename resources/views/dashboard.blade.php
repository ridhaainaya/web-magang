<x-app-layout>
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 md:p-10 text-white shadow-xl shadow-blue-200/50 mb-10">
        <div class="relative z-10">
            <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="mt-3 opacity-90 text-sm md:text-lg font-medium max-w-2xl">
                Selamat datang di <span class="underline decoration-2 underline-offset-4 decoration-white/30">Si APPEM</span>. Pantau status pendaftaran dan unduh dokumen magang Anda di sini.
            </p>
        </div>
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-xl border border-blue-100">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <span class="px-3 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold uppercase rounded-full border border-amber-100">Proses</span>
            </div>
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Status Permohonan</h3>
            <p class="text-xl font-extrabold text-gray-800">Menunggu Review</p>
            <p class="text-xs text-gray-400 mt-2 italic">*Dokumen sedang diperiksa admin</p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 text-xl border border-purple-100">
                    <i class="fas fa-file-download"></i>
                </div>
                <span class="text-gray-300 text-sm font-bold tracking-tighter">03 Dokumen</span>
            </div>
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Unduhan Tersedia</h3>
            <p class="text-xl font-extrabold text-gray-800">Dokumen Pendukung</p>
            <a href="#" class="text-xs text-purple-600 mt-2 font-bold hover:underline block">Lihat Daftar Dokumen &rarr;</a>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 text-xl border border-emerald-100">
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Biodata Mahasiswa</h3>
            <p class="text-xl font-extrabold text-gray-800">Lengkapi Profil</p>
            <p class="text-xs text-gray-400 mt-2">Pastikan data akademik sudah sesuai.</p>
        </div>
    </div>
</x-app-layout>