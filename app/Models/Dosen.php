<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nidn',
        'jabatan',
        'foto'
    ];

    /**
      * Relasi balik ke tabel Users
      */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}