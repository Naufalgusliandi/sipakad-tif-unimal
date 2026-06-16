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
    Schema::create('krs', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel mahasiswas
        $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
        // Menghubungkan ke tabel mata_kuliahs
        $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
        // Mencatat tahun ajaran / semester saat MK ini diambil (misal: 20261 untuk 2026 Ganjil)
        $table->string('tahun_akademik', 9)->default('2026/2027'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
