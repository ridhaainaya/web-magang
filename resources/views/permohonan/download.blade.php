<x-app-layout>
    <!-- Background: Blue Tint agar konsisten dengan Dashboard & Profil -->
    <div class="min-h-screen bg-[#F4F7FA] py-6 md:py-10 font-sans text-[#334155]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1.5 h-8 bg-blue-500 rounded-full"></div>
                        <h2 class="text-2xl font-bold text-[#1E293B]">Pusat Unduhan Dokumen</h2>
                    </div>
                    <p class="text-sm text-[#64748B] ml-4 font-medium">Pantau status permohonan dan unduh dokumen magang Anda di sini.</p>
                </div>
                @if($application)
                    <span class="text-[10px] font-bold text-[#94A3B8] bg-white border border-[#E2E8F0] px-4 py-1.5 rounded-full uppercase tracking-[0.15em] shadow-sm">
                        ID: #{{ str_pad($application->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
                @endif
            </div>

            @if(!$application)
                <!-- Empty State (No Application) -->
                <div class="bg-white p-12 rounded-[2.5rem] border border-dashed border-[#CBD5E1] shadow-[0_10px_30px_rgba(0,0,0,0.02)] text-center">
                    <div class="w-20 h-20 bg-[#F8FAFF] rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <i class="fas fa-file-invoice text-3xl text-[#CBD5E1]"></i>
                    </div>
                    <p class="text-[#1E293B] font-bold text-lg">Anda belum mengajukan permohonan magang.</p>
                    <p class="text-[#64748B] text-sm mt-1">Silakan ajukan permohonan terlebih dahulu untuk mendapatkan dokumen.</p>
                    <a href="{{ route('permohonan.create') }}" class="mt-8 inline-flex items-center gap-2 bg-[#3B82F6] text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-[#2563EB] transition-all shadow-lg shadow-blue-200">
                        Kirim permohonan sekarang <i class="fas fa-paper-plane text-[10px]"></i>
                    </a>
                </div>
            @else
                <!-- Timeline Status Section -->
                <div class="mb-8 bg-white p-8 rounded-[2.5rem] border border-[#F1F5F9] shadow-[0_10px_30px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center justify-between relative">
                        <div class="absolute inset-0 flex items-center px-10" aria-hidden="true">
                            <div class="w-full border-t-2 border-[#F1F5F9]"></div>
                        </div>
                        
                        <!-- Step: Diajukan -->
                        <div class="relative flex flex-col items-center group">
                            <div class="w-10 h-10 rounded-2xl bg-[#3B82F6] text-white flex items-center justify-center text-sm z-10 shadow-lg shadow-blue-100">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="mt-3 text-[10px] font-black text-[#3B82F6] uppercase tracking-widest">Diajukan</span>
                        </div>

                        <!-- Step: Review Admin -->
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-2xl {{ in_array($application->status, ['diterima', 'ditolak']) ? 'bg-[#3B82F6] text-white' : 'bg-[#F4B400] text-white animate-pulse' }} flex items-center justify-center text-sm z-10 shadow-lg">
                                <i class="fas {{ in_array($application->status, ['diterima', 'ditolak']) ? 'fa-check' : 'fa-clock' }}"></i>
                            </div>
                            <span class="mt-3 text-[10px] font-black {{ in_array($application->status, ['diterima', 'ditolak']) ? 'text-[#3B82F6]' : 'text-[#F4B400]' }} uppercase tracking-widest">Review Admin</span>
                        </div>

                        <!-- Step: Selesai -->
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-2xl {{ $application->status == 'diterima' ? 'bg-[#10B981] text-white shadow-emerald-100' : 'bg-[#F1F5F9] text-[#CBD5E1]' }} flex items-center justify-center text-sm z-10 shadow-lg">
                                <i class="fas fa-award"></i>
                            </div>
                            <span class="mt-3 text-[10px] font-black {{ $application->status == 'diterima' ? 'text-[#10B981]' : 'text-[#CBD5E1]' }} uppercase tracking-widest">Selesai</span>
                        </div>
                    </div>
                </div>

                <!-- Info Grid Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Detail Info -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-[#F1F5F9] shadow-[0_10px_30px_rgba(0,0,0,0.02)] col-span-2">
                        <h3 class="font-bold text-[#1E293B] mb-6 flex items-center text-sm">
                            <i class="fas fa-info-circle mr-3 text-[#3B82F6]"></i> Informasi Pengajuan
                        </h3>
                        <div class="grid grid-cols-2 gap-y-6 text-sm">
                            <div>
                                <p class="text-[#94A3B8] text-[10px] uppercase font-black tracking-widest mb-1">Tanggal Submit</p>
                                <p class="font-bold text-[#334155]">{{ $application->created_at->translatedFormat('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[#94A3B8] text-[10px] uppercase font-black tracking-widest mb-1">Nomor Surat Anda</p>
                                <p class="font-bold text-[#334155]">{{ $application->no_surat }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-[#94A3B8] text-[10px] uppercase font-black tracking-widest mb-1">Institusi / Sekolah</p>
                                <p class="font-bold text-[#334155] leading-relaxed">{{ $profile->sekolah_univ ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Badge Card -->
                    <div class="bg-white p-8 rounded-[2.5rem] border border-[#F1F5F9] shadow-[0_10px_30px_rgba(0,0,0,0.02)] flex flex-col justify-center items-center text-center">
                        <p class="text-[#94A3B8] text-[10px] uppercase font-black tracking-widest mb-4">Status Saat Ini</p>
                        @php
                            $statusData = [
                                'diproses' => ['class' => 'bg-[#FFF9E6] text-[#F4B400]', 'icon' => 'fa-sync fa-spin'],
                                'diterima' => ['class' => 'bg-[#ECFDF5] text-[#10B981]', 'icon' => 'fa-check-circle'],
                                'ditolak' => ['class' => 'bg-[#FEF2F2] text-[#EF4444]', 'icon' => 'fa-times-circle'],
                            ];
                            $current = $statusData[$application->status] ?? ['class' => 'bg-[#F8FAFF]', 'icon' => 'fa-question'];
                        @endphp
                        <span class="px-6 py-3 rounded-2xl font-black text-[11px] {{ $current['class'] }} flex items-center shadow-sm">
                            <i class="fas {{ $current['icon'] }} mr-2"></i> {{ strtoupper($application->status) }}
                        </span>
                        @if($application->status == 'diproses')
                            <p class="text-[10px] text-[#94A3B8] mt-4 italic font-medium leading-relaxed">Admin sedang mengecek berkas Anda.<br>Mohon cek berkala.</p>
                        @endif
                    </div>
                </div>

                <!-- Document Table Section -->
                <div class="bg-white rounded-[2.5rem] border border-[#F1F5F9] shadow-[0_15px_40px_rgba(0,0,0,0.02)] overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#F8FAFF] text-[10px] font-black text-[#94A3B8] uppercase tracking-[0.2em] border-b border-[#F1F5F9]">
                                <th class="px-8 py-5">Nama Dokumen</th>
                                <th class="px-8 py-5">Dikeluarkan Oleh</th>
                                <th class="px-8 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#F1F5F9]">
                            <!-- Surat Permohonan (User) -->
                            <tr class="hover:bg-[#F8FAFF]/50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center">
                                        <div class="w-9 h-9 rounded-xl bg-[#EBF2FF] text-[#3B82F6] flex items-center justify-center mr-4">
                                            <i class="fas fa-file-upload text-sm"></i>
                                        </div>
                                        <span class="text-sm font-bold text-[#1E293B]">Surat Permohonan Magang (Anda)</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-xs text-[#64748B] font-medium italic">Sistem (Auto-generate)</td>
                                <td class="px-8 py-5 text-right">
                                    <a href="{{ asset('storage/' . $application->file_surat_pengantar) }}" target="_blank" class="inline-flex items-center text-[#3B82F6] hover:text-[#2563EB] text-xs font-black tracking-widest uppercase">
                                        <i class="fas fa-eye mr-2"></i> LIHAT PDF
                                    </a>
                                </td>
                            </tr>

                            <!-- Surat Jawaban (Admin) -->
                            <tr class="hover:bg-[#F8FAFF]/50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center">
                                        <div class="w-9 h-9 rounded-xl {{ $application->file_jawaban ? 'bg-[#ECFDF5] text-[#10B981]' : 'bg-[#F1F5F9] text-[#CBD5E1]' }} flex items-center justify-center mr-4 transition-colors">
                                            <i class="fas fa-reply text-sm"></i>
                                        </div>
                                        <span class="text-sm font-bold {{ $application->file_jawaban ? 'text-[#1E293B]' : 'text-[#94A3B8]' }}">Surat Jawaban / Balasan</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-xs text-[#64748B] font-medium italic">Admin BAPPERIDA</td>
                                <td class="px-8 py-5 text-right">
                                    @if($application->file_jawaban)
                                        <a href="{{ asset('storage/' . $application->file_jawaban) }}" target="_blank" class="inline-flex items-center bg-[#EBF2FF] text-[#3B82F6] px-4 py-2 rounded-xl text-[10px] font-black hover:bg-[#3B82F6] hover:text-white transition shadow-sm uppercase tracking-widest">
                                            <i class="fas fa-download mr-1"></i> DOWNLOAD
                                        </a>
                                    @else
                                        <span class="text-[#CBD5E1] text-[10px] font-bold italic tracking-widest uppercase"><i class="fas fa-lock mr-2 text-[8px]"></i> BELUM TERSEDIA</span>
                                    @endif
                                </td>
                            </tr>

                            @if($application->status == 'diterima')
                                <!-- Keterangan & Sertifikat (Hanya jika diterima) -->
                                <tr class="hover:bg-[#EEF2FF]/50 transition-colors bg-[#F8FAFF]/30">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center">
                                            <div class="w-9 h-9 rounded-xl {{ $application->file_sertifikat ? 'bg-[#EEF2FF] text-[#6366F1]' : 'bg-[#F1F5F9] text-[#CBD5E1]' }} flex items-center justify-center mr-4">
                                                <i class="fas fa-award text-sm"></i>
                                            </div>
                                            <span class="text-sm font-bold {{ $application->file_sertifikat ? 'text-[#4338CA]' : 'text-[#94A3B8]' }}">Sertifikat Magang Si TAMA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-xs text-[#64748B] font-medium italic">Kepala BAPPERIDA</td>
                                    <td class="px-8 py-5 text-right">
                                        @if($application->file_sertifikat)
                                            <a href="{{ asset('storage/' . $application->file_sertifikat) }}" target="_blank" class="inline-flex items-center bg-[#6366F1] text-white px-5 py-2.5 rounded-xl text-[10px] font-black hover:bg-[#4F46E5] shadow-lg shadow-indigo-100 transition uppercase tracking-[0.1em]">
                                                <i class="fas fa-file-download mr-2"></i> AMBIL SERTIFIKAT
                                            </a>
                                        @else
                                            <span class="text-[#CBD5E1] text-[10px] font-bold italic tracking-widest uppercase">TERBIT SETELAH MAGANG</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if($application->status == 'ditolak')
                    <!-- Catatan Admin (Ditolak) -->
                    <div class="mt-8 p-6 bg-[#FEF2F2] border border-[#FEE2E2] rounded-[2rem] text-[#EF4444] shadow-sm">
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center mr-4 shadow-sm shrink-0">
                                <i class="fas fa-exclamation-circle text-lg"></i>
                            </div>
                            <div>
                                <p class="font-black uppercase text-[10px] tracking-widest mb-1">Catatan Admin:</p>
                                <p class="text-sm font-medium opacity-90 leading-relaxed">Mohon maaf, permohonan Anda belum dapat kami setujui saat ini. Silakan hubungi bagian administrasi atau perbaiki data permohonan Anda.</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>