<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_magazines', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('edition')->nullable(); // Edisi / Nomor
            $table->string('cover_image')->nullable();
            $table->string('file'); // path PDF
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_magazines');
    }
};
