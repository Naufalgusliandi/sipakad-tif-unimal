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
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            
            // Atribut Kurikulum Utama
            $table->string('kode_mk', 15)->unique();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester'); // Semester penempatan MK (1 s.d 8)
            
            // Standar Enterprise Perlindungan Data Historis
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};