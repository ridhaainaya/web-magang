<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;

class PermohonanMagangController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        // --- TAMBAHKAN PENGECEKAN DI SINI ---
        // Cek apakah ada permohonan yang statusnya masih 'diproses' atau sudah 'diterima'
        $hasActiveApplication = Application::where('user_id', $user->id)
            ->whereIn('status', ['diproses', 'diterima'])
            ->exists();

        if ($hasActiveApplication) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda masih memiliki permohonan yang aktif atau sudah diterima.');
        }
        // ------------------------------------

        $profile = $user->profile;
        return view('permohonan.create', compact('user', 'profile'));
    }

    public function store(Request $request)
    {
        // --- TAMBAHKAN PENGECEKAN JUGA DI SINI (Keamanan Berlapis) ---
        $hasActiveApplication = Application::where('user_id', Auth::id())
            ->whereIn('status', ['diproses', 'diterima'])
            ->exists();

        if ($hasActiveApplication) {
            return redirect()->route('dashboard')
                ->with('error', 'Gagal! Anda sudah memiliki permohonan yang sedang berjalan.');
        }
        //

        $request->validate([
            'no_surat' => 'required|string',
            'tgl_surat' => 'required|date',
            'perihal' => 'required|string',
            'jabatan_penandatangan' => 'required|string',
            'tgl_awal' => 'required|date|after_or_equal:today',
            'tgl_akhir' => 'required|date|after:tgl_awal',
            'file_surat_pengantar' => 'required|mimes:pdf|max:2048',
        ], [
            // Pesan kustom untuk masing-masing aturan
            'required' => ':attribute wajib diisi.',
            'date' => 'Format :attribute tidak valid.',
            'mimes' => ':attribute harus berupa file PDF.',
            'max' => 'Ukuran :attribute maksimal adalah 2MB.',
            'after_or_equal' => ':attribute tidak boleh tanggal yang sudah lewat.',
            'after' => ':attribute harus setelah tanggal mulai.',
        ], [
            // Mengganti nama field asli menjadi nama yang lebih "manusiawi"
            'no_surat' => 'Nomor Surat',
            'tgl_surat' => 'Tanggal Surat',
            'perihal' => 'Perihal',
            'jabatan_penandatangan' => 'Jabatan Penandatangan',
            'tgl_awal' => 'Tanggal Mulai Magang',
            'tgl_akhir' => 'Tanggal Selesai Magang',
            'file_surat_pengantar' => 'File Surat Pengantar',
        ]);

        // Mengambil user id dengan cara yang lebih disukai IDE
        $userId = Auth::user()->getAuthIdentifier(); 
        // ATAU cukup pakai Auth::id() biasanya sudah cukup tenang IDE-nya
        // $userId = Auth::id();

        // Simpan file
        $pathFile = $request->file('file_surat_pengantar')->store('surat_pengantar', 'public');

        Application::create([
            'user_id'               => Auth::id(), // Gunakan Facade Auth
            'no_surat'              => $request->no_surat,
            'tgl_surat'             => $request->tgl_surat,
            'perihal'               => $request->perihal,
            'jabatan_penandatangan' => $request->jabatan_penandatangan,
            'tgl_awal'              => $request->tgl_awal,
            'tgl_akhir'             => $request->tgl_akhir,
            'file_surat_pengantar'  => $pathFile,
            'status'                => 'diproses',
        ]);

        return redirect()->route('dashboard')->with('status', 'Permohonan magang berhasil dikirim!');
    }

    public function showDownload()
    {
        $user = Auth::user();
        // Mengambil permohonan terakhir milik user
        $application = Application::where('user_id', $user->id)->latest()->first();
        $profile = $user->profile;

        return view('permohonan.download', compact('user', 'application', 'profile'));
    }
}