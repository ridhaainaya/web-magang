<section>
    <header>
        <h2 class="text-lg font-bold text-gray-800">
            {{ __('Biodata Lengkap Mahasiswa') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Data ini akan digunakan untuk keperluan administrasi dan penerbitan sertifikat magang.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <x-input-label for="nama_lengkap" :value="__('Nama Lengkap (Sesuai Ijazah)')" />
                <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" :value="old('nama_lengkap', $user->profile->nama_lengkap ?? $user->name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
            </div>

            <div>
                <x-input-label for="nim_nisn" :value="__('NIM/NISN')" />
                <x-text-input id="nim_nisn" name="nim_nisn" type="text" class="mt-1 block w-full" :value="old('nim_nisn', $user->profile->nim_nisn ?? '')" required />
            </div>

            <div>
                <x-input-label for="no_hp" :value="__('Nomor WhatsApp')" />
                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->profile->no_hp ?? '')" required />
            </div>

            <div>
                <x-input-label for="jenjang_pendidikan" :value="__('Jenjang Pendidikan')" />
                <select id="jenjang_pendidikan" name="jenjang_pendidikan" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm">
                    <option value="">-- Pilih Jenjang --</option>
                    <option value="SMA/SMK" {{ (old('jenjang_pendidikan', $user->profile->jenjang_pendidikan ?? '') == 'SMA/SMK') ? 'selected' : '' }}>SMA/SMK</option>
                    <option value="DI-DIII" {{ (old('jenjang_pendidikan', $user->profile->jenjang_pendidikan ?? '') == 'D3') ? 'selected' : '' }}>D3</option>
                    <option value="DIV-S1" {{ (old('jenjang_pendidikan', $user->profile->jenjang_pendidikan ?? '') == 'S1') ? 'selected' : '' }}>S1</option>
                </select>
            </div>

            <div>
                <x-input-label for="sekolah_univ" :value="__('Asal Instansi (Sekolah/Universitas)')" />
                <x-text-input id="sekolah_univ" name="sekolah_univ" type="text" class="mt-1 block w-full" :value="old('sekolah_univ', $user->profile->sekolah_univ ?? '')" required />
            </div>

            <div>
                <x-input-label for="jurusan" :value="__('Jurusan')" />
                <x-text-input id="jurusan" name="jurusan" type="text" class="mt-1 block w-full" :value="old('jurusan', $user->profile->jurusan ?? '')" required />
            </div>

            <div>
                <x-input-label for="kota_asal" :value="__('Kota/Kabupaten Sekolah/Universitas')" />
                <x-text-input id="kota_asal" name="kota_asal" type="text" class="mt-1 block w-full" :value="old('kota_asal', $user->profile->kota_asal ?? '')" required />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="bg-gradient-to-r from-blue-600 to-purple-600 border-none shadow-md hover:shadow-lg transition-all">
                {{ __('Simpan Biodata') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold">
                    <i class="fas fa-check-circle"></i> {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>