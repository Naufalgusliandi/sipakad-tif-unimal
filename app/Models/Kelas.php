<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model {
    use SoftDeletes;
    protected $fillable = ['nama_kelas', 'dosen_id'];

    // Relasi ke Dosen Wali
    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }
}