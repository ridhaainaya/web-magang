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
        Schema::table('applications', function (Blueprint $table) {
            // Kita tambahkan 3 kolom baru untuk file dari Admin
            $table->string('file_jawaban')->nullable()->after('file_surat_pengantar');
            $table->string('file_keterangan')->nullable()->after('file_jawaban');
            $table->string('file_sertifikat')->nullable()->after('file_keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['file_jawaban', 'file_keterangan', 'file_sertifikat']);
        });
    }
};
