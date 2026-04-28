<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
// Pastikan nama model kamu sesuai, biasanya Application atau PermohonanMagang
// Di sini saya asumsikan nama modelnya 'Application'
use App\Models\Application; 

class AdminController extends Controller
{
    public function index()
    {
        // 1. Mengambil data statistik untuk box di dashboard
        $stats = [
            'total'   => Application::count(),
            'pending' => Application::where('status', 'diproses')->count(),
            'accepted' => Application::where('status', 'diterima')->count(),
            'users'   => User::where('role', 'user')->count(), // Menghitung mahasiswa aktif
        ];

        // 2. Mengambil 5 permohonan terbaru untuk ditampilkan di tabel
        // Kita gunakan eager loading 'user' agar tidak berat saat load data
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
        // Kita panggil user DAN profilenya sekalian
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
        // Mengambil data permohonan beserta user dan profilenya
        $application = Application::with('user.profile')->findOrFail($id);

        return view('admin.permohonan.show', compact('application'));
    }

    public function listDokumen()
    {
        // Hanya ambil yang statusnya 'diterima'
        $applications = Application::with('user.profile')
            ->where('status', 'diterima')
            ->latest()
            ->paginate(10);

        return view('admin.permohonan.list-dokumen', compact('applications'));
    }
    
    // Ubah dari (Application $application) menjadi ($id)
    public function manageDokumen($id) 
    {
        // Cari data berdasarkan ID seperti fungsi show()
        $application = Application::findOrFail($id);
        
        return view('admin.permohonan.dokumen', compact('application'));
    }

    public function uploadDokumenHasil(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $request->validate([
            'file_jawaban' => 'nullable|mimes:pdf|max:2048',
            'file_sertifikat' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Simpan File Balasan
        if ($request->hasFile('file_jawaban')) {
            // Simpan file ke folder storage/app/public/hasil_magang
            $pathJawaban = $request->file('file_jawaban')->store('hasil_magang', 'public');
            $application->file_jawaban = $pathJawaban; 
        }

        if ($request->hasFile('file_keterangan')) {
            $pathKeterangan = $request->file('file_keterangan')->store('hasil_magang', 'public');
            $application->file_keterangan = $pathKeterangan;
        }

        // Simpan File Sertifikat
        if ($request->hasFile('file_sertifikat')) {
            $pathSertifikat = $request->file('file_sertifikat')->store('hasil_magang', 'public');
            $application->file_sertifikat = $pathSertifikat;
        }

        // Simpan perubahan ke database
        $application->save();

        return back()->with('success', 'Dokumen berhasil disimpan!');
    }
}