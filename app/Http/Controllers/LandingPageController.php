<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini agar bisa mengambil data dari tabel settings

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil path file user manual dari tabel settings
        $manualPath = DB::table('settings')->where('key', 'user_manual_path')->value('value');

        // Kirim variabel $manualPath ke halaman depan (view welcome)
        return view('welcome', compact('manualPath'));
    }
}