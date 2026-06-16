<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'kelas_id', // Menambahkan kelas_id agar terintegrasi dengan materi/jadwal
        'nim',
        'prodi',
        'semester',
        'angkatan',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mahasiswa_id', 'id');
    }

    public function mataKuliahKrs()
    {
        return $this->belongsToMany(MataKuliah::class, 'krs', 'mahasiswa_id', 'mata_kuliah_id')
                    ->withTimestamps();
    }
}