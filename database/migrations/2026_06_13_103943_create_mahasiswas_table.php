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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kolom kelas_id dibuat sebagai unsignedBigInteger nullable biasa
            // tanpa ->after() dan tanpa constrained() langsung di sini agar urutan migration tidak error
            $table->unsignedBigInteger('kelas_id')->nullable();
            
            // Atribut Akademik Utama
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