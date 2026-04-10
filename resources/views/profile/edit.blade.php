<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Profil</h2>
            <p class="text-gray-500">Kelola informasi akun dan keamanan kata sandi Anda.</p>
        </div>
        
        <div class="space-y-6">
            <div class="p-6 bg-white shadow-sm rounded-2xl border border-gray-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 bg-white shadow-sm rounded-2xl border border-gray-100">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>