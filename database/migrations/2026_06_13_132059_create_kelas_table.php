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
    Schema::create('kelas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kelas')->unique(); 
        $table->foreignId('dosen_id')->nullable()->constrained()->onDelete('set null');
        $table->softDeletes();
        $table->timestamps();
    });

    // Menghubungkan foreign key kelas_id secara aman di akhir setelah tabel kelas terbit
    Schema::table('mahasiswas', function (Blueprint $table) {
        $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
