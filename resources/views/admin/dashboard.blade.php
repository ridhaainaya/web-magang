<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Dashboard Admin</h2>
                <p class="text-slate-500 text-sm">Selamat datang kembali! Berikut adalah ringkasan sistem magang hari ini.</p>
            </div>
            <div class="hidden md:block">
                <span class="text-xs font-medium text-slate-400">Terakhir diperbarui: {{ now()->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4">
                        <i class="fas fa-file-invoice text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Masuk</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Perlu Review</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Disetujui</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $stats['accepted'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm transition hover:shadow-md">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">User </p>
                        <p class="text-2xl font-bold text-slate-800">{{ $stats['users'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-white">
                <h3 class="font-bold text-slate-800 flex items-center text-sm">
                    <i class="fas fa-history mr-3 text-blue-500"></i> Permohonan Terbaru
                </h3>
                <a href="{{ route('admin.permohonan.index') }}" class="text-[10px] font-bold text-blue-600 hover:text-blue-800 transition uppercase tracking-tighter">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="overflow-x-auto text-nowrap">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            <th class="px-6 py-4">Nama Pemohon</th>
                            <th class="px-6 py-4">Nomor Surat</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm italic">
                        @forelse($recentApplications as $app)
                        <tr class="hover:bg-slate-50/50 transition duration-200">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 mr-3 text-[10px] font-bold border border-slate-200 uppercase">
                                        {{ substr($app->user->name, 0, 2) }}
                                    </div>
                                    <span class="font-semibold text-slate-700 not-italic">{{ $app->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs">{{ $app->no_surat }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $badge = match($app->status) {
                                        'diproses' => 'bg-amber-100 text-amber-700',
                                        'diterima' => 'bg-emerald-100 text-emerald-700',
                                        'ditolak' => 'bg-red-100 text-red-700',
                                        default => 'bg-slate-100 text-slate-700'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $badge }} not-italic">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition shadow-sm group">
                                    <i class="fas fa-external-link-alt text-xs transition group-hover:scale-110"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-slate-400 italic">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-3xl mb-3 opacity-20"></i>
                                    <p>Belum ada data permohonan masuk</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-blue-600 rounded-2xl p-6 text-white flex items-center justify-between shadow-lg shadow-blue-100">
                <div>
                    <h4 class="font-bold">Butuh Bantuan Sistem?</h4>
                    <p class="text-blue-100 text-xs mt-1">Hubungi tim IT jika terjadi kendala pada server.</p>
                </div>
                <i class="fas fa-headset text-3xl opacity-30"></i>
            </div>
            <div class="bg-slate-800 rounded-2xl p-6 text-white flex items-center justify-between shadow-lg shadow-slate-200">
                <div>
                    <h4 class="font-bold">Log Aktivitas</h4>
                    <p class="text-slate-400 text-xs mt-1">Cek riwayat perubahan data permohonan.</p>
                </div>
                <i class="fas fa-list-ul text-3xl opacity-30"></i>
            </div>
        </div>
    </div>
</x-app-layout>