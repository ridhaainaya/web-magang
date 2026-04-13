<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Coba ambil semua data tanpa validasi dulu untuk tes
        $data = $request->all();
        
        // Debug: Apakah datanya benar-benar sampai ke sini?
        // Jika diklik simpan muncul layar hitam berisi data kamu, berarti form sudah OK.
        // dd($data); 

        try {
            $user = $request->user();
            
            // Simpan ke tabel profiles
            $profile = \App\Models\Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama_lengkap'       => $request->nama_lengkap,
                    'nim_nisn'           => $request->nim_nisn,
                    'no_hp'              => $request->no_hp,
                    'jenjang_pendidikan' => $request->jenjang_pendidikan,
                    'sekolah_univ'       => $request->sekolah_univ,
                    'kota_asal'          => $request->kota_asal,
                    'jurusan'            => $request->jurusan,
                ]
            );

            return Redirect::route('profile.edit')->with('status', 'profile-updated');

        } catch (\Exception $e) {
            // Jika ada error database, dia akan muncul di sini
            dd($e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
