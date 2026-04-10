<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Pusat Unduhan Dokumen</h2>
            <p class="text-gray-500">Pantau status permohonan dan unduh dokumen magang Anda di sini.</p>
        </div>

        @if(!$application)
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm text-center">
                <i class="fas fa-file-invoice text-5xl text-gray-200 mb-4"></i>
                <p class="text-gray-500 italic">Anda belum mengajukan permohonan magang.</p>
                <a href="{{ route('permohonan.create') }}" class="mt-4 inline-block text-blue-600 font-bold hover:underline">Kirim permohonan sekarang &rarr;</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm col-span-2">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i> Informasi Pengajuan
                    </h3>
                    <div class="grid grid-cols-2 gap-y-4 text-sm">
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Tanggal Submit Apply</p>
                            <p class="font-semibold text-gray-700">{{ $application->created_at->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Nomor Surat (Siswa)</p>
                            <p class="font-semibold text-gray-700">{{ $application->no_surat }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider">Detail Siswa</p>
                            <p class="font-semibold text-gray-700">{{ $profile->nama_lengkap ?? $user->name }} - {{ $profile->sekolah_univ ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-center items-center text-center">
                    <p class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-2">Status Saat Ini</p>
                    @php
                        $statusClasses = [
                            'diproses' => 'bg-amber-100 text-amber-700',
                            'diterima' => 'bg-emerald-100 text-emerald-700',
                            'ditolak' => 'bg-red-100 text-red-700',
                        ];
                    @endphp
                    <span class="px-4 py-2 rounded-full font-bold text-xs {{ $statusClasses[$application->status] ?? 'bg-gray-100' }}">
                        {{ strtoupper($application->status) }}
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                            <th class="px-6 py-4">Nama Dokumen</th>
                            <th class="px-6 py-4">Dikeluarkan Oleh</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-700">Surat Permohonan Magang</td>
                            <td class="px-6 py-4 text-xs text-gray-500">Mahasiswa (Anda)</td>
                            <td class="px-6 py-4">
                                <a href="{{ asset('storage/' . $application->file_surat_pengantar) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-bold">
                                    <i class="fas fa-download mr-1"></i> Download
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-700">Surat Jawaban Magang</td>
                            <td class="px-6 py-4 text-xs text-gray-500">Admin BAPPERIDA</td>
                            <td class="px-6 py-4">
                                @if($application->file_jawaban)
                                    <a href="{{ asset('storage/' . $application->file_jawaban) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-bold">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                @else
                                    <span class="text-gray-300 text-xs italic"><i class="fas fa-lock mr-1"></i> Belum Tersedia</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-700">Surat Keterangan Magang</td>
                            <td class="px-6 py-4 text-xs text-gray-500">Admin BAPPERIDA</td>
                            <td class="px-6 py-4">
                                @if($application->file_keterangan)
                                    <a href="{{ asset('storage/' . $application->file_keterangan) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-bold">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                @else
                                    <span class="text-gray-300 text-xs italic"><i class="fas fa-lock mr-1"></i> Belum Tersedia</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 text-sm font-bold text-indigo-600">Sertifikat Magang Si TAMA</td>
                            <td class="px-6 py-4 text-xs text-gray-500">Admin BAPPERIDA</td>
                            <td class="px-6 py-4">
                                @if($application->file_sertifikat)
                                    <a href="{{ asset('storage/' . $application->file_sertifikat) }}" target="_blank" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-indigo-700 transition">
                                        <i class="fas fa-award mr-1"></i> Download Sertifikat
                                    </a>
                                @else
                                    <span class="text-gray-300 text-xs italic"><i class="fas fa-lock mr-1"></i> Belum Terbit</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>