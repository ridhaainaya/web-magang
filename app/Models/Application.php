<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    // HAPUS bagian #[Fillable] di atas class, pindahkan ke sini:
    protected $fillable = [
        'user_id', 
        'no_surat', 
        'tgl_surat', 
        'perihal', 
        'jabatan_penandatangan', 
        'tgl_awal', 
        'tgl_akhir', 
        'file_surat_pengantar', 
        'file_jawaban',    // Tambahkan ini (hasil migrasi tadi)
        'file_keterangan', // Tambahkan ini (hasil migrasi tadi)
        'file_sertifikat', // Tambahkan ini (hasil migrasi tadi)
        'status'
    ];

    /**
     * Relasi balik ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}