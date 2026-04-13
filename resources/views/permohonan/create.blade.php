<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Formulir Permohonan Magang</h2>
            <p class="text-gray-500">Silakan lengkapi detail surat dan unggah berkas pengantar dari instansi Anda.</p>
        </div>

        <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center mb-4 text-blue-600">
                    <i class="fas fa-user-circle mr-2"></i>
                    <h3 class="font-bold">Informasi Pemohon</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                        <p class="font-semibold text-gray-700">{{ $profile->nama_lengkap ?? $user->name }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Asal Sekolah/Universitas</label>
                        <p class="font-semibold text-gray-700">{{ $profile->sekolah_univ ?? '-' }}</p>
                    </div>
                </div>
                @if(!$profile)
                    <div class="mt-4 p-3 bg-amber-50 border border-amber-100 rounded-xl text-amber-700 text-xs flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-base"></i> 
                        <span>Biodata profil belum lengkap. <a href="{{ route('profile.edit') }}" class="underline font-bold hover:text-amber-900 transition">Lengkapi di sini</a> agar data surat sinkron.</span>
                    </div>
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center mb-4 text-indigo-600">
                    <i class="fas fa-file-signature mr-2"></i>
                    <h3 class="font-bold">Detail Surat Resmi</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <x-input-label for="no_surat" :value="__('Nomor Surat')" />
                        <x-text-input id="no_surat" name="no_surat" type="text" class="mt-1 block w-full" placeholder="Contoh: 005/123/SMK/2026" required />
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <x-input-label for="tgl_surat" :value="__('Tanggal Surat')" />
                        <x-text-input id="tgl_surat" name="tgl_surat" type="date" class="mt-1 block w-full" required />
                    </div>
                    <div class="col-span-2">
                        <x-input-label for="perihal" :value="__('Perihal Surat')" />
                        <x-text-input id="perihal" name="perihal" type="text" class="mt-1 block w-full" placeholder="Contoh: Permohonan Prakerin / Magang Mahasiswa" required />
                    </div>
                    <div class="col-span-2">
                        <x-input-label for="jabatan_penandatangan" :value="__('Jabatan Penandatangan')" />
                        <x-text-input id="jabatan_penandatangan" name="jabatan_penandatangan" type="text" class="mt-1 block w-full" placeholder="Contoh: Kepala Sekolah / Dekan Fakultas / Kaprodi" required />
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center mb-4 text-purple-600">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <h3 class="font-bold">Rencana Waktu Magang</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="tgl_awal" :value="__('Tanggal Mulai')" />
                        <x-text-input id="tgl_awal" name="tgl_awal" type="date" class="mt-1 block w-full" required />
                    </div>
                    <div>
                        <x-input-label for="tgl_akhir" :value="__('Tanggal Selesai')" />
                        <x-text-input id="tgl_akhir" name="tgl_akhir" type="date" class="mt-1 block w-full" required />
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center mb-4 text-emerald-600">
                    <i class="fas fa-cloud-upload-alt mr-2"></i>
                    <h3 class="font-bold">Unggah Berkas</h3>
                </div>
                <div class="border-2 border-dashed border-gray-100 rounded-2xl p-8 text-center hover:border-blue-300 transition-all group bg-slate-50/50">
                    <div class="mb-4">
                        <i class="fas fa-file-pdf text-4xl text-gray-300 group-hover:text-red-500 transition-colors"></i>
                    </div>
                    <label for="file_surat_pengantar" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Surat Pengantar</label>
                    <input type="file" id="file_surat_pengantar" name="file_surat_pengantar" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition" required />
                    <p class="mt-3 text-[10px] text-gray-400 font-medium italic">Format file: PDF (Maksimal 2MB)</p>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</a>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-12 py-4 rounded-2xl font-bold shadow-xl shadow-blue-200 hover:scale-[1.03] active:scale-95 transition-all flex items-center">
                    Kirim Permohonan <i class="fas fa-paper-plane ml-3"></i>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>