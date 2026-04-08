<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Data Surat
            $table->string('no_surat');
            $table->date('tgl_surat');
            $table->string('perihal');
            $table->string('jabatan_penandatangan'); // Misal: Kepala Sekolah

            $table->date('tgl_awal');
            $table->date('tgl_akhir');

            $table->string('file_surat_pengantar');

            $table->enum('status', ['diproses', 'diterima', 'ditolak'])->default('diproses');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
