<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    /**
     * Definisi kolom yang boleh diisi (Mass Assignment)
     * Gunakan properti protected $fillable di dalam class.
     */
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nim_nisn',
        'no_hp',
        'jenjang_pendidikan',
        'sekolah_univ',
        'kota_asal',
        'jurusan'
    ];

    /**
     * Relasi balik ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}