<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'kelas_id',
        'dosen_id',
        'tugas',
        'quiz',
        'uts',
        'uas'
    ];

    /**
     * ACCESSOR: Menghitung Nilai Akhir Angka secara Otomatis (20% Tugas + 15% Quiz + 30% UTS + 35% UAS)
     */
    public function getNilaiAkhirAttribute()
    {
        return ($this->tugas * 0.20) + ($this->quiz * 0.15) + ($this->uts * 0.30) + ($this->uas * 0.35);
    }

    /**
     * ACCESSOR: Konversi Otomatis Nilai Angka ke Nilai Huruf Standar Kampus
     */
    public function getNilaiHurufAttribute()
    {
        $na = $this->nilai_akhir;

        if ($na >= 85) return 'A';
        if ($na >= 78) return 'B+';
        if ($na >= 70) return 'B';
        if ($na >= 63) return 'C+';
        if ($na >= 55) return 'C';
        if ($na >= 40) return 'D';
        return 'E';
    }

    // Hubungan Relasi Model
    public function mahasiswa() { return $this->belongsTo(Mahasiswa::class); }
    public function mataKuliah() { return $this->belongsTo(MataKuliah::class); }
    public function kelas() { return $this->belongsTo(Kelas::class); }
    public function dosen() { return $this->belongsTo(Dosen::class); }
}