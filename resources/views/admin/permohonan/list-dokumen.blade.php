<x-app-layout>
    <div class="p-6">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Penyerahan Dokumen Magang</h2>
            <p class="text-sm text-slate-500">Daftar mahasiswa yang telah diterima dan memerlukan dokumen balasan/sertifikat.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Mahasiswa</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Instansi/Sekolah</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status Dokumen</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($applications as $app)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr($app->user->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-bold text-slate-700">{{ $app->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            {{ $app->user->profile->sekolah_univ ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <i class="fas fa-reply {{ $app->file_jawaban ? 'text-emerald-500' : 'text-slate-200' }}" title="Surat Balasan"></i>
                                <i class="fas fa-file-signature {{ $app->file_keterangan ? 'text-emerald-500' : 'text-slate-200' }}" title="Surat Keterangan"></i>
                                <i class="fas fa-award {{ $app->file_sertifikat ? 'text-emerald-500' : 'text-slate-200' }}" title="Sertifikat"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.permohonan.dokumen', $app->id) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-md shadow-emerald-100">
                                <i class="fas fa-upload mr-2"></i> Upload
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic text-sm">
                            Belum ada mahasiswa yang berstatus 'Diterima'.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</x-app-layout>