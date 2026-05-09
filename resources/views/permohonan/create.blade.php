<x-app-layout>
    <!-- Background: Blue Tint dengan Gradasi Halus di pojok agar tidak flat -->
    <div class="min-h-screen bg-[#F4F7FA] py-6 md:py-10 font-sans text-[#334155] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100/40 rounded-full blur-3xl -mr-32 -mt-32"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Header Section -->
            <div class="mb-8 group">
                <h2 class="text-2xl font-bold text-[#1E293B] group-hover:text-[#3B82F6] transition-colors duration-500">Formulir Permohonan Magang</h2>
                <p class="text-sm text-[#64748B]">Silakan lengkapi detail surat dan unggah berkas pengantar dari instansi Anda.</p>
                <div class="h-1 w-12 bg-[#3B82F6] mt-2 rounded-full opacity-50 group-hover:w-20 transition-all duration-500"></div>
            </div>

            <!-- Error Alerts: Lebih rapi dengan shadow halus -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-white border-l-4 border-red-500 rounded-r-2xl shadow-[0_4px_20px_rgba(239,68,68,0.1)]">
                    <div class="flex items-center text-red-600 mb-2">
                        <i class="fas fa-exclamation-circle mr-2 text-sm"></i>
                        <p class="text-sm font-bold">Mohon periksa kembali inputan Anda:</p>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-500 space-y-1 ml-1 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Section 1: Informasi Pemohon -->
                <div class="bg-white p-6 rounded-[1.5rem] border border-white shadow-[0_10px_25px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_35px_rgba(59,130,246,0.08)] transition-all duration-500">
                    <div class="flex items-center mb-5">
                        <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center text-[#3B82F6] mr-3 shadow-sm">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[#1E293B]">Informasi Pemohon</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="p-3 bg-[#F8FAFF] rounded-xl border border-[#EDF2F7] hover:bg-white hover:border-blue-200 transition-all">
                            <label class="text-[10px] font-bold text-[#94A3B8] uppercase tracking-widest block mb-1">Nama Lengkap</label>
                            <p class="font-semibold text-[#334155]">{{ $profile->nama_lengkap ?? $user->name }}</p>
                        </div>
                        <div class="p-3 bg-[#F8FAFF] rounded-xl border border-[#EDF2F7] hover:bg-white hover:border-blue-200 transition-all">
                            <label class="text-[10px] font-bold text-[#94A3B8] uppercase tracking-widest block mb-1">Asal Sekolah/Universitas</label>
                            <p class="font-semibold text-[#334155]">{{ $profile->sekolah_univ ?? '-' }}</p>
                        </div>
                    </div>
                    @if(!$profile)
                        <div class="mt-4 p-3 bg-amber-50/50 border border-amber-100 rounded-xl text-amber-700 text-[11px] flex items-center">
                            <div class="w-6 h-6 bg-amber-100 rounded-full flex items-center justify-center mr-3 shrink-0">
                                <i class="fas fa-exclamation text-[10px]"></i>
                            </div>
                            <span>Biodata profil belum lengkap. <a href="{{ route('profile.edit') }}" class="underline font-bold hover:text-amber-900">Lengkapi di sini</a> agar data surat sinkron.</span>
                        </div>
                    @endif
                </div>

                <!-- Section 2: Detail Surat Resmi -->
                <div class="bg-white p-6 rounded-[1.5rem] border border-white shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <div class="flex items-center mb-5">
                        <div class="w-9 h-9 bg-indigo-50 rounded-lg flex items-center justify-center text-[#6366F1] mr-3 shadow-sm">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[#1E293B]">Detail Surat Resmi</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="col-span-2 md:col-span-1">
                            <x-input-label for="no_surat" :value="__('Nomor Surat')" class="text-xs font-bold text-[#64748B] mb-1 ml-1" />
                            <x-text-input id="no_surat" name="no_surat" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('no_surat')" placeholder="Contoh: 005/123/SMK/2026" required />
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <x-input-label for="tgl_surat" :value="__('Tanggal Surat')" class="text-xs font-bold text-[#64748B] mb-1 ml-1" />
                            <x-text-input id="tgl_surat" name="tgl_surat" type="date" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('tgl_surat')" required />
                        </div>
                        <div class="col-span-2">
                            <x-input-label for="perihal" :value="__('Perihal Surat')" class="text-xs font-bold text-[#64748B] mb-1 ml-1" />
                            <x-text-input id="perihal" name="perihal" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('perihal')" placeholder="Contoh: Permohonan Prakerin / Magang Mahasiswa" required />
                        </div>
                        <div class="col-span-2">
                            <x-input-label for="jabatan_penandatangan" :value="__('Jabatan Penandatangan')" class="text-xs font-bold text-[#64748B] mb-1 ml-1" />
                            <x-text-input id="jabatan_penandatangan" name="jabatan_penandatangan" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('jabatan_penandatangan')" placeholder="Contoh: Kepala Sekolah / Dekan / Kaprodi" required />
                        </div>
                    </div>
                </div>

                <!-- Section 3: Waktu Magang -->
                <div class="bg-white p-6 rounded-[1.5rem] border border-white shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <div class="flex items-center mb-5">
                        <div class="w-9 h-9 bg-sky-50 rounded-lg flex items-center justify-center text-[#0EA5E9] mr-3 shadow-sm">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[#1E293B]">Rencana Waktu Magang</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 font-medium text-sm">
                        <div class="group/date">
                            <x-input-label for="tgl_awal" :value="__('Tanggal Mulai')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover/date:text-[#0EA5E9] transition-colors" />
                            <x-text-input id="tgl_awal" name="tgl_awal" type="date" class="block w-full rounded-xl border-[#E2E8F0] focus:ring-4 focus:ring-sky-50 focus:border-[#0EA5E9] transition-all bg-gray-50/30" :value="old('tgl_awal')" required />
                        </div>
                        <div class="group/date">
                            <x-input-label for="tgl_akhir" :value="__('Tanggal Selesai')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover/date:text-[#0EA5E9] transition-colors" />
                            <x-text-input id="tgl_akhir" name="tgl_akhir" type="date" class="block w-full rounded-xl border-[#E2E8F0] focus:ring-4 focus:ring-sky-50 focus:border-[#0EA5E9] transition-all bg-gray-50/30" :value="old('tgl_akhir')" required />
                        </div>
                    </div>
                </div>

                <!-- Section 4: Unggah Berkas -->
                <div class="bg-white p-6 rounded-[1.5rem] border border-white shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <div class="flex items-center mb-5">
                        <div class="w-9 h-9 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 mr-3 shadow-sm">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-[#1E293B]">Unggah Berkas</h3>
                    </div>
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-2xl blur opacity-0 group-hover:opacity-10 transition duration-500"></div>
                        <div class="relative border-2 border-dashed {{ $errors->has('file_surat_pengantar') ? 'border-red-200 bg-red-50/30' : 'border-[#EDF2F7] bg-[#F5F2FF]' }} rounded-2xl p-6 text-center hover:border-blue-400 hover:bg-white transition-all">
                            <div class="mb-3 transform group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-file-pdf text-3xl {{ $errors->has('file_surat_pengantar') ? 'text-red-400' : 'text-purple-300' }}"></i>
                            </div>
                            <label for="file_surat_pengantar" class="block text-sm font-bold text-[#334155] mb-1 cursor-pointer">Pilih File Surat Pengantar</label>
                            <input type="file" id="file_surat_pengantar" name="file_surat_pengantar" class="text-xs text-[#94A3B8] file:hidden" required />
                            <p class="mt-2 text-[10px] text-[#94A3B8] font-bold uppercase tracking-[0.1em]">PDF • MAKSIMAL 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center justify-end space-x-5 pt-2 pb-8">
                    <a href="{{ route('dashboard') }}" class="text-xs font-bold text-[#94A3B8] hover:text-[#1E293B] uppercase tracking-widest transition-colors">Batal</a>
                    <button type="submit" class="bg-[#3B82F6] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-[0_10px_20px_rgba(59,130,246,0.2)] hover:bg-[#2563EB] hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center">
                        Kirim Permohonan <i class="fas fa-paper-plane ml-2 text-[10px]"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>