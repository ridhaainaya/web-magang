<section class="relative overflow-hidden">
    <!-- Header Section: Konsisten dengan gaya form sebelumnya -->
    <header class="mb-8">
        <h2 class="text-2xl font-bold text-[#1E293B]">
            {{ __('Biodata Lengkap Mahasiswa') }}
        </h2>
        <div class="h-1 w-12 bg-[#3B82F6] mt-2 rounded-full opacity-50"></div>
        <p class="mt-3 text-sm text-[#64748B] leading-relaxed">
            {{ __("Data ini akan digunakan untuk keperluan administrasi dan penerbitan sertifikat magang.") }}
        </p>
    </header>

    <!-- Error Alert: Gaya formal dengan shadow halus -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-white border-l-4 border-red-500 rounded-r-2xl shadow-[0_4px_20px_rgba(239,68,68,0.1)]">
            <div class="flex items-center text-red-600 mb-2">
                <i class="fas fa-exclamation-circle mr-2 text-sm"></i>
                <p class="text-sm font-bold">Waduh! Ada yang salah:</p>
            </div>
            <ul class="list-disc list-inside text-xs text-red-500 space-y-1 ml-1 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <input type="hidden" name="name" value="{{ $user->name }}">
        <input type="hidden" name="email" value="{{ $user->email }}">

        <!-- Form Card Container -->
        <div class="bg-white p-6 md:p-8 rounded-[1.5rem] border border-white shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nama Lengkap: Full Width -->
                <div class="col-span-1 md:col-span-2 group">
                    <x-input-label for="nama_lengkap" :value="__('Nama Lengkap (Sesuai Ijazah)')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('nama_lengkap', $user->profile->nama_lengkap ?? $user->name)" required />
                    <x-input-error class="mt-2 text-xs" :messages="$errors->get('nama_lengkap')" />
                </div>

                <!-- NIM & No HP -->
                <div class="group">
                    <x-input-label for="nim_nisn" :value="__('NIM/NISN')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <x-text-input id="nim_nisn" name="nim_nisn" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('nim_nisn', $user->profile->nim_nisn ?? '')" required />
                </div>

                <div class="group">
                    <x-input-label for="no_hp" :value="__('Nomor WhatsApp')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <x-text-input id="no_hp" name="no_hp" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('no_hp', $user->profile->no_hp ?? '')" required />
                </div>

                <!-- Jenjang & Instansi -->
                <div class="group">
                    <x-input-label for="jenjang_pendidikan" :value="__('Jenjang Pendidikan')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <select id="jenjang_pendidikan" name="jenjang_pendidikan" class="mt-1 block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30 shadow-sm py-2.5">
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="SMA/SMK" {{ (old('jenjang_pendidikan', $user->profile->jenjang_pendidikan ?? '') == 'SMA/SMK') ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="DI-DIII" {{ (old('jenjang_pendidikan', $user->profile->jenjang_pendidikan ?? '') == 'DI-DIII') ? 'selected' : '' }}>DI-DIII</option>
                        <option value="DIV-S1" {{ (old('jenjang_pendidikan', $user->profile->jenjang_pendidikan ?? '') == 'DIV-S1') ? 'selected' : '' }}>DIV-S1</option>
                    </select>
                </div>

                <div class="group">
                    <x-input-label for="sekolah_univ" :value="__('Asal Instansi (Sekolah/Universitas)')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <x-text-input id="sekolah_univ" name="sekolah_univ" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('sekolah_univ', $user->profile->sekolah_univ ?? '')" required />
                </div>

                <!-- Jurusan & Kota -->
                <div class="group">
                    <x-input-label for="jurusan" :value="__('Jurusan')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <x-text-input id="jurusan" name="jurusan" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('jurusan', $user->profile->jurusan ?? '')" required />
                </div>

                <div class="group">
                    <x-input-label for="kota_asal" :value="__('Kota/Kabupaten Instansi')" class="text-xs font-bold text-[#64748B] mb-1 ml-1 group-hover:text-[#3B82F6] transition-colors" />
                    <x-text-input id="kota_asal" name="kota_asal" type="text" class="block w-full rounded-xl border-[#E2E8F0] text-sm focus:ring-4 focus:ring-blue-50 focus:border-[#3B82F6] transition-all bg-gray-50/30" :value="old('kota_asal', $user->profile->kota_asal ?? '')" required />
                </div>
            </div>

            <!-- Action Area -->
            <div class="flex items-center gap-4 pt-8 border-t border-gray-50 mt-6">
                <x-primary-button class="bg-[#3B82F6] hover:bg-[#2563EB] text-white px-8 py-3 rounded-xl font-bold text-sm shadow-[0_10px_20px_rgba(59,130,246,0.2)] transition-all duration-300 flex items-center border-none">
                    <i class="fas fa-save mr-2 text-[10px]"></i> {{ __('Simpan Biodata') }}
                </x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-xs text-green-600 font-bold flex items-center bg-green-50 px-4 py-2 rounded-full border border-green-100">
                        <i class="fas fa-check-circle mr-2"></i> {{ __('Tersimpan.') }}
                    </p>
                @endif
            </div>
        </div>
    </form>
</section>