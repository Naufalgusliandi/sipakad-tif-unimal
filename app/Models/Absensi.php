<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'mata_kuliah_id',
        'kelas_id',
        'pertemuan_ke',
        'tanggal',
        'jam',
        'status'
    ];

    // Hubungan ke Mahasiswa
    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Hubungan ke Dosen Pengajar
    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }

    // Hubungan ke Mata Kuliah
    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class);
    }

    // Hubungan ke Kelas
    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}