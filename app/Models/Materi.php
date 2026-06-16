<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materi extends Model
{
    use SoftDeletes;

    protected $table = 'materis';

    protected $fillable = [
        'mata_kuliah_id',
        'kelas_id',
        'dosen_id',
        'judul',
        'deskripsi',
        'file_path'
    ];

    // Relasi balik
    public function mataKuliah() { return $this->belongsTo(MataKuliah::class); }
    public function kelas() { return $this->belongsTo(Kelas::class); }
    public function dosen() { return $this->belongsTo(Dosen::class); }
}