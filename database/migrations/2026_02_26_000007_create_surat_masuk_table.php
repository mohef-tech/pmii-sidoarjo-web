<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('whatsapp');
            $table->string('komisariat');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->text('catatan_admin')->nullable();
            // 9 berkas persyaratan
            $table->string('file_permohonan')->nullable();
            $table->string('file_ba_rapat')->nullable();
            $table->string('file_ba_formatur')->nullable();
            $table->string('file_struktur')->nullable();
            $table->string('file_lpj')->nullable();
            $table->string('file_rekomendasi')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_ktm')->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
