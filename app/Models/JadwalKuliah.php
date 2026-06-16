<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalKuliah extends Model
{
    use SoftDeletes;

    protected $table = 'jadwal_kuliahs';

    protected $fillable = [
        'mata_kuliah_id',
        'kelas_id',
        'ruangan_id',
        'dosen_id',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function ruangan() {
        return $this->belongsTo(Ruangan::class);
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }
}