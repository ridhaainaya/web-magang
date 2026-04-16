<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Kelola Mahasiswa Magang</h2>
                <p class="text-sm text-slate-500">Daftar seluruh permohonan magang yang masuk ke sistem.</p>
            </div>
            
            <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">
                <i class="fas fa-file-excel mr-2"></i> Export Data
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase tracking-widest border-b border-slate-100">
                            <th class="px-6 py-4 font-bold">Mahasiswa</th>
                            <th class="px-6 py-4 font-bold">Instansi</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Tanggal Daftar</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($applications as $app)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">
                                        {{ substr($app->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">{{ $app->user->name }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $app->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $app->user->profile->sekolah_univ ?? 'Tidak ada data' }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'diproses' => 'bg-amber-100 text-amber-600',
                                        'diterima' => 'bg-emerald-100 text-emerald-600',
                                        'ditolak' => 'bg-rose-100 text-rose-600',
                                    ];
                                    $class = $statusClasses[$app->status] ?? 'bg-slate-100 text-slate-600';
                                @endphp
                                <span class="{{ $class }} px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $app->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('admin.permohonan.show', $app->id) }}" class="p-2 bg-slate-100 text-slate-400 rounded-lg hover:bg-blue-500 hover:text-white transition-all" title="Lihat Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                    <form action="{{ route('admin.update-status', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit" onclick="return confirm('Terima mahasiswa ini?')" class="p-2 bg-emerald-50 text-emerald-500 rounded-lg hover:bg-emerald-500 hover:text-white transition-all" title="Terima">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.update-status', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" onclick="return confirm('Tolak mahasiswa ini?')" class="p-2 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-500 hover:text-white transition-all" title="Tolak">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-slate-200 text-4xl mb-3"></i>
                                    <p class="text-slate-400 text-sm italic">Belum ada data pendaftaran.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($applications->hasPages())
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
                {{ $applications->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>