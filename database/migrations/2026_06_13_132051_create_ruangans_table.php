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
        Schema::create('ruangans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_ruangan')->unique(); // Contoh: Lab AI, Ruang 201
        $table->string('lokasi')->nullable();    // Contoh: Gedung Utama Lt. 2
        $table->softDeletes();
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};
