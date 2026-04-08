<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id', 'no_surat', 'tgl_surat', 'perihal', 
    'jabatan_penandatangan', 'tgl_awal', 'tgl_akhir', 
    'file_surat_pengantar', 'status'
])]
class Application extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}