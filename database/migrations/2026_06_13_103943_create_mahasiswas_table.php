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
    Schema::create('mahasiswas', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke tabel users
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // PERBAIKAN: Hapus ->after('user_id') agar sintaks SQL valid saat create table
        $table->unsignedBigInteger('kelas_id')->nullable();
        
        // Atribut Akademik Utama asli milik Anda
        $table->string('nim', 20)->unique();
        $table->string('prodi')->default('Teknik Informatika');
        $table->integer('semester');
        $table->string('angkatan', 4);
        $table->string('foto')->nullable(); 
        
        $table->softDeletes(); 
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};