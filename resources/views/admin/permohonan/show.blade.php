<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 pb-12">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-br from-blue-600 to-indigo-700 -z-10 shadow-lg">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="p-6 max-w-5xl mx-auto pt-10">
            <a href="{{ route('admin.permohonan.index') }}" class="inline-flex items-center text-sm text-white/80 hover:text-white mb-8 group transition-all">
                <div class="p-2 rounded-full bg-white/10 group-hover:bg-white/20 mr-3 transition-all">
                    <i class="fas fa-arrow-left"></i>
                </div>
                Kembali ke Daftar Permohonan
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-white">
                        <div class="h-24 bg-gradient-to-r from-blue-400 to-indigo-400"></div>
                        <div class="px-6 pb-8 -mt-12 text-center">
                            <div class="inline-flex p-1.5 rounded-3xl bg-white shadow-lg mb-4">
                                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-3xl font-bold">
                                    {{ substr($application->user->name, 0, 1) }}
                                </div>
                            </div>
                            <h2 class="text-xl font-bold text-slate-800">{{ $application->user->name }}</h2>
                            <p class="text-sm text-slate-500">{{ $application->user->email }}</p>
                            
                            <div class="mt-6 flex flex-wrap justify-center gap-2">
                                @php
                                    $statusClasses = [
                                        'diproses' => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'diterima' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                        'ditolak' => 'bg-rose-50 text-rose-600 border-rose-100',
                                    ];
                                @endphp
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.1em] border {{ $statusClasses[$application->status] ?? 'bg-slate-50 text-slate-600 border-slate-100' }}">
                                    {{ $application->status }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="border-t border-slate-50 p-6 space-y-4">
                            <div class="flex items-center text-slate-600">
                                <i class="fab fa-whatsapp w-8 text-emerald-500 text-lg"></i>
                                <span class="text-sm font-medium">{{ $application->user->profile->no_hp ?? '-' }}</span>
                            </div>
                            <div class="flex items-center text-slate-600">
                                <i class="fas fa-map-marker-alt w-8 text-rose-500 text-lg"></i>
                                <span class="text-sm font-medium">{{ $application->user->profile->kota_asal ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-6 border border-white">
                        <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center">
                            <i class="fas fa-paperclip mr-2 text-blue-500"></i> Berkas Lampiran
                        </h3>
                        @if($application->file_surat_pengantar)
                        <div class="group relative bg-slate-50 rounded-2xl p-4 border border-slate-100 hover:border-blue-200 transition-all">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center mr-3">
                                    <i class="fas fa-file-pdf text-lg"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs font-bold text-slate-700 truncate">Surat Pengantar</p>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">PDF Dokumen</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ asset('storage/' . $application->file_surat_pengantar) }}" target="_blank" class="flex-1 bg-white text-slate-600 text-[10px] font-bold py-2 rounded-lg text-center border border-slate-200 hover:bg-slate-50 transition-all">
                                    PRATINJAU
                                </a>
                                <a href="{{ asset('storage/' . $application->file_surat_pengantar) }}" download class="flex-1 bg-blue-600 text-white text-[10px] font-bold py-2 rounded-lg text-center hover:bg-blue-700 shadow-md shadow-blue-100 transition-all">
                                    UNDUH
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tidak ada berkas</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden border border-white">
                        <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h3 class="font-bold text-slate-800 tracking-tight text-lg">Detail Permohonan Magang</h3>
                            <i class="fas fa-info-circle text-slate-300"></i>
                        </div>
                        
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-12">
                                <div class="space-y-6">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-1 bg-blue-500 h-4 rounded-full"></div>
                                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Data Akademik</h4>
                                    </div>
                                    <div class="grid gap-6">
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">NIM / NISN</label>
                                            <p class="text-slate-700 font-semibold tracking-wide">{{ $application->user->profile->nim_nisn ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Instansi Pendidikan</label>
                                            <p class="text-slate-700 font-semibold tracking-wide">{{ $application->user->profile->sekolah_univ ?? '-' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Jurusan / Program Studi</label>
                                            <p class="text-slate-700 font-semibold tracking-wide">{{ $application->user->profile->jurusan ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-1 bg-purple-500 h-4 rounded-full"></div>
                                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Periode & Waktu</h4>
                                    </div>
                                    <div class="grid gap-6">
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Durasi Magang</label>
                                            <div class="flex items-center gap-3">
                                                <div class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-bold text-slate-600 italic">
                                                    {{ \Carbon\Carbon::parse($application->tgl_awal)->format('d M Y') }}
                                                </div>
                                                <i class="fas fa-arrow-right text-[10px] text-slate-300"></i>
                                                <div class="px-3 py-1 bg-slate-100 rounded-lg text-xs font-bold text-slate-600 italic">
                                                    {{ \Carbon\Carbon::parse($application->tgl_akhir)->format('d M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Diajukan Pada</label>
                                            <p class="text-slate-700 font-semibold">{{ $application->created_at->format('d F Y, H:i') }} WIB</p>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">No. Surat Pengantar</label>
                                            <p class="text-slate-700 font-semibold">{{ $application->no_surat ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-12 pt-8 border-t border-slate-100 flex flex-col sm:flex-row gap-4 justify-end">
                                <form action="{{ route('admin.update-status', $application->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" onclick="return confirm('Tolak permohonan ini?')" class="w-full px-8 py-3 bg-white text-rose-600 border border-rose-100 rounded-2xl font-bold hover:bg-rose-600 hover:text-white hover:shadow-lg hover:shadow-rose-100 transition-all duration-300">
                                        <i class="fas fa-times-circle mr-2"></i> Tolak Permohonan
                                    </button>
                                </form>

                                <form action="{{ route('admin.update-status', $application->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" onclick="return confirm('Terima mahasiswa ini?')" class="w-full px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-indigo-700 shadow-xl shadow-blue-200 hover:shadow-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                                        <i class="fas fa-check-circle mr-2"></i> Terima Mahasiswa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100 flex gap-4">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-amber-900 mb-1">Tips Penilaian</h4>
                            <p class="text-xs text-amber-700 leading-relaxed">
                                Pastikan untuk memeriksa kesesuaian <strong>Jurusan</strong> dan <strong>Periode Magang</strong> dengan kapasitas kuota di departemen terkait sebelum memberikan persetujuan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>