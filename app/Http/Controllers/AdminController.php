<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk akses DB Facade
use App\Models\User;
use App\Models\Application; 

class AdminController extends Controller
{
    public function index()
    {
        // 1. Mengambil data statistik untuk box di dashboard
        $stats = [
            'total'    => Application::count(),
            'pending'  => Application::where('status', 'diproses')->count(),
            'accepted' => Application::where('status', 'diterima')->count(),
            'users'    => User::where('role', 'user')->count(), // Menghitung mahasiswa aktif
        ];

        // 2. Mengambil 5 permohonan terbaru untuk ditampilkan di tabel
        $recentApplications = Application::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 3. Mengirim data ke view admin/dashboard.blade.php
        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }

    /**
     * Menampilkan semua daftar permohonan
     */
    public function listPermohonan()
    {
        $applications = Application::with('user.profile')->latest()->paginate(10);
        return view('admin.permohonan.index', compact('applications'));
    }

    /**
     * Update status permohonan (Terima/Tolak/Diproses)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak'
        ]);

        $application = Application::findOrFail($id);
        $application->update([
            'status' => $request->status
        ]);

        return back()->with('status', 'Status permohonan ' . $application->user->name . ' berhasil diperbarui!');
    }

    public function show($id)
    {
        $application = Application::with('user.profile')->findOrFail($id);
        return view('admin.permohonan.show', compact('application'));
    }

    public function listDokumen()
    {
        $applications = Application::with('user.profile')
            ->where('status', 'diterima')
            ->latest()
            ->paginate(10);

        return view('admin.permohonan.list-dokumen', compact('applications'));
    }
    
    public function manageDokumen($id) 
    {
        $application = Application::findOrFail($id);
        return view('admin.permohonan.dokumen', compact('application'));
    }

    public function uploadDokumenHasil(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $request->validate([
            'file_jawaban' => 'nullable|mimes:pdf|max:2048',
            'file_keterangan' => 'nullable|mimes:pdf|max:2048',
            'file_sertifikat' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file_jawaban')) {
            $pathJawaban = $request->file('file_jawaban')->store('hasil_magang', 'public');
            $application->file_jawaban = $pathJawaban; 
        }

        if ($request->hasFile('file_keterangan')) {
            $pathKeterangan = $request->file('file_keterangan')->store('hasil_magang', 'public');
            $application->file_keterangan = $pathKeterangan;
        }

        if ($request->hasFile('file_sertifikat')) {
            $pathSertifikat = $request->file('file_sertifikat')->store('hasil_magang', 'public');
            $application->file_sertifikat = $pathSertifikat;
        }

        $application->save();

        return back()->with('success', 'Dokumen berhasil disimpan!');
    }

    /* =========================================================================
     * FITUR TAMBAHAN: USER MANUAL MANAGEMENT
     * ========================================================================= */

    /**
     * Menampilkan halaman upload user manual
     */
    public function manageUserManual()
    {
        // Mengambil path file user manual yang tersimpan di database
        $manualPath = DB::table('settings')->where('key', 'user_manual_path')->value('value');
        
        return view('admin.settings.manual', compact('manualPath'));
    }

    /**
     * Memproses upload file PDF user manual baru
     */
    public function uploadUserManual(Request $request)
    {
        $request->validate([
            'user_manual' => 'required|mimes:pdf|max:10240', // Maksimal 10MB (10240 KB)
        ], [
            'user_manual.required' => 'Silakan pilih file PDF terlebih dahulu.',
            'user_manual.mimes' => 'Format file wajib berupa PDF.',
            'user_manual.max' => 'Ukuran file tidak boleh melebihi 10MB.',
        ]);

        if ($request->hasFile('user_manual')) {
            // 1. Ambil data path file lama dari database
            $oldPath = DB::table('settings')->where('key', 'user_manual_path')->value('value');
            
            // 2. Hapus file fisik lama di storage jika ada (supaya menghemat ruang)
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }

            // 3. Simpan file PDF baru ke folder 'storage/app/public/documents'
            $newPath = $request->file('user_manual')->store('documents', 'public');

            // 4. Update atau masukkan path baru ke tabel settings
            DB::table('settings')->updateOrInsert(
                ['key' => 'user_manual_path'],
                ['value' => $newPath, 'updated_at' => now()]
            );

            return back()->with('success', 'User manual sistem berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal memproses berkas PDF.');
    }
}