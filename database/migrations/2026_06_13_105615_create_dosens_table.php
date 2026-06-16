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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            
            // Relasi One-to-One ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Atribut Kepegawaian Utama sesuai konsep resmi
            $table->string('nidn', 20)->unique();
            $table->string('jabatan'); // Contoh: Tenaga Pengajar, Asisten Ahli, Lektor, Lektor Kepala, Guru Besar
            
            // Atribut Profil Tambahan
            $table->string('foto')->nullable(); 
            
            // Standar Enterprise Perlindungan Data
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};