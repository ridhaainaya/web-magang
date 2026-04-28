<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-end">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Pusat Unduhan Dokumen</h2>
                <p class="text-gray-500">Pantau status permohonan dan unduh dokumen magang Anda di sini.</p>
            </div>
            @if($application)
                <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-3 py-1 rounded-full uppercase tracking-widest">
                    ID: #{{ str_pad($application->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            @endif
        </div>

        @if(!$application)
            <div class="bg-white p-12 rounded-3xl border border-dashed border-gray-200 shadow-sm text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-invoice text-3xl text-gray-300"></i>
                </div>
                <p class="text-gray-500 font-medium">Anda belum mengajukan permohonan magang.</p>
                <p class="text-gray-400 text-xs mt-1">Silakan ajukan permohonan terlebih dahulu untuk mendapatkan dokumen.</p>
                <a href="{{ route('permohonan.create') }}" class="mt-6 inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-100">Kirim permohonan sekarang</a>
            </div>
        @else
            <div class="mb-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between relative">
                    <div class="absolute inset-0 flex items-center px-10" aria-hidden="true">
                        <div class="w-full border-t-2 border-gray-100"></div>
                    </div>
                    
                    <div class="relative flex flex-col items-center group">
                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs z-10 shadow-lg shadow-blue-100">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="mt-2 text-[10px] font-bold text-blue-600 uppercase">Diajukan</span>
                    </div>

                    <div class="relative flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ in_array($application->status, ['diterima', 'ditolak']) ? 'bg-blue-600 text-white' : 'bg-amber-400 text-white animate-pulse' }} flex items-center justify-center text-xs z-10 shadow-lg">
                            <i class="fas {{ in_array($application->status, ['diterima', 'ditolak']) ? 'fa-check' : 'fa-clock' }}"></i>
                        </div>
                        <span class="mt-2 text-[10px] font-bold {{ in_array($application->status, ['diterima', 'ditolak']) ? 'text-blue-600' : 'text-amber-500' }} uppercase">Review Admin</span>
                    </div>

                    <div class="relative flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full {{ $application->status == 'diterima' ? 'bg-emerald-500 text-white shadow-emerald-100' : 'bg-gray-100 text-gray-300' }} flex items-center justify-center text-xs z-10 shadow-lg">
                            <i class="fas fa-award"></i>
                        </div>
                        <span class="mt-2 text-[10px] font-bold {{ $application->status == 'diterima' ? 'text-emerald-600' : 'text-gray-300' }} uppercase">Selesai</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-nowrap">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm col-span-2">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center text-sm">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i> Informasi Pengajuan
                    </h3>
                    <div class="grid grid-cols-2 gap-y-4 text-sm">
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Tanggal Submit</p>
                            <p class="font-semibold text-gray-700">{{ $application->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Nomor Surat Anda</p>
                            <p class="font-semibold text-gray-700">{{ $application->no_surat }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Institusi / Sekolah</p>
                            <p class="font-semibold text-gray-700">{{ $profile->sekolah_univ ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-center items-center text-center">
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-2">Status Saat Ini</p>
                    @php
                        $statusData = [
                            'diproses' => ['class' => 'bg-amber-100 text-amber-700', 'icon' => 'fa-sync fa-spin'],
                            'diterima' => ['class' => 'bg-emerald-100 text-emerald-700', 'icon' => 'fa-check-circle'],
                            'ditolak' => ['class' => 'bg-red-100 text-red-700', 'icon' => 'fa-times-circle'],
                        ];
                        $current = $statusData[$application->status] ?? ['class' => 'bg-gray-100', 'icon' => 'fa-question'];
                    @endphp
                    <span class="px-5 py-2 rounded-xl font-bold text-xs {{ $current['class'] }} flex items-center">
                        <i class="fas {{ $current['icon'] }} mr-2"></i> {{ strtoupper($application->status) }}
                    </span>
                    @if($application->status == 'diproses')
                        <p class="text-[9px] text-gray-400 mt-3 italic leading-relaxed">Admin sedang mengecek berkas Anda.<br>Mohon cek berkala.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                            <th class="px-6 py-4">Nama Dokumen</th>
                            <th class="px-6 py-4">Dikeluarkan Oleh</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center mr-3">
                                        <i class="fas fa-file-upload text-xs"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">Surat Permohonan Magang (Anda)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 italic">Sistem (Auto-generate)</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ asset('storage/' . $application->file_surat_pengantar) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-xs font-bold">
                                    <i class="fas fa-eye mr-2"></i> LIHAT PDF
                                </a>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg {{ $application->file_jawaban ? 'bg-emerald-50 text-emerald-500' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center mr-3">
                                        <i class="fas fa-reply text-xs"></i>
                                    </div>
                                    <span class="text-sm font-semibold {{ $application->file_jawaban ? 'text-gray-700' : 'text-gray-400' }}">Surat Jawaban / Balasan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">Admin BAPPERIDA</td>
                            <td class="px-6 py-4 text-right">
                                @if($application->file_jawaban)
                                    <a href="{{ asset('storage/' . $application->file_jawaban) }}" target="_blank" class="inline-flex items-center bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition">
                                        <i class="fas fa-download mr-1"></i> DOWNLOAD
                                    </a>
                                @else
                                    <span class="text-gray-300 text-[10px] font-medium italic"><i class="fas fa-lock mr-1"></i> BELUM TERSEDIA</span>
                                @endif
                            </td>
                        </tr>

                        @if($application->status == 'diterima')

                        <tr class="hover:bg-indigo-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg {{ $application->file_keterangan ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center mr-3">
                                        <i class="fas fa-award text-xs"></i>
                                    </div>
                                    <span class="text-sm font-bold {{ $application->file_keterangan ? 'text-indigo-700' : 'text-gray-400' }}">Surat Keterangan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">Kepala BAPPERIDA</td>
                            <td class="px-6 py-4 text-right">
                                @if($application->file_keterangan)
                                    <a href="{{ asset('storage/' . $application->file_keterangan) }}" target="_blank" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-xl text-[10px] font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition">
                                        <i class="fas fa-file-download mr-2"></i> Download
                                    </a>
                                @else
                                    <span class="text-gray-300 text-[10px] font-medium italic">TERBIT SETELAH MAGANG</span>
                                @endif
                            </td>
                        </tr>

                        <tr class="hover:bg-indigo-50/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg {{ $application->file_sertifikat ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center mr-3">
                                        <i class="fas fa-award text-xs"></i>
                                    </div>
                                    <span class="text-sm font-bold {{ $application->file_sertifikat ? 'text-indigo-700' : 'text-gray-400' }}">Sertifikat Magang Si TAMA</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">Kepala BAPPERIDA</td>
                            <td class="px-6 py-4 text-right">
                                @if($application->file_sertifikat)
                                    <a href="{{ asset('storage/' . $application->file_sertifikat) }}" target="_blank" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-xl text-[10px] font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition">
                                        <i class="fas fa-file-download mr-2"></i> AMBIL SERTIFIKAT
                                    </a>
                                @else
                                    <span class="text-gray-300 text-[10px] font-medium italic">TERBIT SETELAH MAGANG</span>
                                @endif
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($application->status == 'ditolak')
                <div class="mt-6 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-700 text-sm">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle mt-1 mr-3 text-lg"></i>
                        <div>
                            <p class="font-bold uppercase text-xs tracking-wider">Catatan Admin:</p>
                            <p class="mt-1 opacity-80">Mohon maaf, permohonan Anda belum dapat kami setujui saat ini. Silakan hubungi admin atau perbaiki data Anda.</p>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>