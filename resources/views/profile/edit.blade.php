<x-app-layout>
    <!-- Background: Menggunakan Biru Pucat (#F4F7FA) agar selaras dengan dashboard -->
    <div class="min-h-screen bg-[#F4F7FA] py-10 font-sans text-[#334155]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section: Menggunakan bahasa formal sesuai draf Anda -->
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-1.5 h-8 bg-blue-500 rounded-full"></div>
                    <h2 class="text-3xl font-extrabold text-[#1E293B] tracking-tight">Pengaturan Profil</h2>
                </div>
                <p class="text-[#64748B] font-medium ml-4">Kelola informasi akun dan keamanan kata sandi Anda.</p>
            </div>
            
            <div class="space-y-8">
                <!-- Card 1: Informasi Profil -->
                <div class="p-8 bg-white rounded-[2.5rem] border border-[#F1F5F9] shadow-[0_15px_40px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                    <!-- Aksen dekoratif subtle -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    
                    <div class="max-w-3xl relative z-10">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Card 2: Update Password -->
                <div class="p-8 bg-white rounded-[2.5rem] border border-[#F1F5F9] shadow-[0_15px_40px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                    <!-- Aksen dekoratif subtle -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50/50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    
                    <div class="max-w-3xl relative z-10">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>