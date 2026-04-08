<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'nama_lengkap', 'nim_nisn', 'no_hp', 'jenjang_pendidikan', 'sekolah_univ', 'kota_asal', 'jurusan'])]
class Profile extends Model
{
    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}