<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('komisariat', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('singkatan')->nullable();
            $table->string('kampus')->nullable();
            $table->string('kota')->nullable()->default('Sidoarjo');
            $table->string('ketua')->nullable();
            $table->string('whatsapp_ketua')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komisariat');
    }
};
