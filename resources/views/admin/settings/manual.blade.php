<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 pb-12 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-br from-slate-800 via-slate-900 to-[#1e1b4b] -z-10 shadow-lg">
            <div class="absolute inset-0 bg-gradient-to-t from-transparent to-black/20"></div>
        </div>

        <div class="p-6 max-w-2xl mx-auto pt-10">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm text-white/90 hover:text-white mb-8 group transition-all">
                <div class="p-2 rounded-full bg-white/10 group-hover:bg-white/20 mr-3 transition-all">
                    <i class="fas fa-arrow-left text-xs"></i>
                </div>
                <span class="font-bold text-[11px] uppercase tracking-widest">Kembali ke Dashboard</span>
            </a>

            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-900/5 overflow-hidden border border-white p-8 sm:p-10">
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center border border-indigo-100 shadow-sm text-xl">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 text-sm uppercase tracking-wider">Pengaturan Sistem</h3>
                        <p class="text-xs text-slate-400">Kelola berkas User Manual untuk Landing Page</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl text-xs font-bold border border-emerald-100 flex items-center gap-3">
                        <i class="fas fa-check-circle text-lg text-emerald-500"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-rose-50 text-rose-700 rounded-2xl text-xs font-bold border border-rose-100 flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-lg text-rose-500"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.settings.manual.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-3 tracking-wider">Berkas Aktif Saat Ini</label>
                        @if($manualPath)
                            <div class="flex items-center justify-between bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                                <div class="flex items-center min-w-0 mr-4">
                                    <i class="fas fa-file-pdf text-rose-500 text-xl mr-3 shrink-0"></i>
                                    <span class="text-xs text-slate-700 font-semibold truncate">user_manual_sistem.pdf</span>
                                </div>
                                <a href="{{ asset('storage/' . $manualPath) }}" target="_blank" class="shrink-0 inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold hover:bg-indigo-600 hover:text-white transition-all">
                                    <i class="fas fa-external-link-alt mr-1.5 text-[10px]"></i> Lihat PDF
                                </a>
                            </div>
                        @else
                            <div class="flex items-center gap-2 p-1 text-xs text-amber-600 font-medium bg-amber-50/50 rounded-xl p-2 border border-amber-100/50">
                                <i class="fas fa-exclamation-triangle shrink-0"></i>
                                <span>Belum ada file yang diupload. Menu di landing page akan menampilkan peringatan otomatis.</span>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-wider">Unggah File PDF Baru</label>
                        <div class="relative bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-4 hover:border-indigo-400 transition-all group">
                            <input type="file" name="user_manual" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="application/pdf">
                            <div class="text-center py-4">
                                <i class="fas fa-cloud-upload-alt text-3xl text-slate-300 group-hover:text-indigo-500 mb-2 transition-colors"></i>
                                <p class="text-xs text-slate-600 font-semibold">Klik atau seret file PDF ke sini</p>
                                <p class="text-[10px] text-slate-400 mt-1">Hanya menerima format .pdf (Maks. 10MB)</p>
                            </div>
                        </div>
                        @error('user_manual') 
                            <span class="text-xs text-rose-500 font-medium block mt-1"><i class="fas fa-times-circle mr-1"></i> {{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-100">
                        <button type="submit" class="px-8 py-3.5 bg-emerald-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:shadow-emerald-300 transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>