<x-app-layout>
    <div class="p-6">
        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.permohonan.list-dokumen') }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Dokumen
            </a>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Upload Dokumen Balasan</h2>
            <p class="text-sm text-slate-500 font-medium">Mahasiswa: <span class="text-slate-800 font-bold text-base">{{ $application->user->name }}</span></p>
        </div>

        <div class="max-w-4xl bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.upload-dokumen-hasil', $application->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Slot Surat Balasan --}}
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider mb-3">1. Surat Balasan (PDF)</label>
                        <input type="file" name="file_jawaban" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor:pointer">
                        @if($application->file_jawaban)
                            <div class="mt-3 flex items-center gap-2 text-xs font-bold text-emerald-600 bg-emerald-50 p-2 rounded-lg">
                                <i class="fas fa-check-circle"></i>
                                <a href="{{ asset('storage/' . $application->file_jawaban) }}" target="_blank" class="hover:underline">Sudah Terupload (Lihat File)</a>
                            </div>
                        @endif
                    </div>

                    {{-- Slot Surat Keterangan --}}
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider mb-3">2. Surat Keterangan (PDF)</label>
                        <input type="file" name="file_keterangan" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor:pointer">
                        @if($application->file_keterangan)
                            <div class="mt-3 flex items-center gap-2 text-xs font-bold text-emerald-600 bg-emerald-50 p-2 rounded-lg">
                                <i class="fas fa-check-circle"></i>
                                <a href="{{ asset('storage/' . $application->file_keterangan) }}" target="_blank" class="hover:underline">Sudah Terupload (Lihat File)</a>
                            </div>
                        @endif
                    </div>

                    {{-- Slot Sertifikat --}}
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <label class="block text-sm font-black text-slate-700 uppercase tracking-wider mb-3">2. Sertifikat Magang (PDF)</label>
                        <input type="file" name="file_sertifikat" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-purple-600 file:text-white hover:file:bg-purple-700 cursor:pointer">
                        @if($application->file_sertifikat)
                            <div class="mt-3 flex items-center gap-2 text-xs font-bold text-purple-600 bg-purple-50 p-2 rounded-lg">
                                <i class="fas fa-award"></i>
                                <a href="{{ asset('storage/' . $application->file_sertifikat) }}" target="_blank" class="hover:underline">Sudah Terupload (Lihat File)</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-slate-800 text-white font-black rounded-xl hover:bg-slate-900 transition-all shadow-lg shadow-slate-200 uppercase tracking-widest text-xs">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Simpan Semua Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>