<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah; // Import model JadwalKuliah
use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        $mhs = auth()->user()->mahasiswa;

        if (!$mhs) {
            return redirect()->back()->with('error', 'Profil akademik Anda belum lengkap.');
        }

        // 1. Ambil daftar mata kuliah yang dibuka KHUSUS untuk tingkat semester mahasiswa saat ini
        $matakuliah_tersedia = MataKuliah::where('semester', $mhs->semester)->get();

        // 2. Ambil ID mata kuliah yang SUDAH diambil oleh mahasiswa ini
        $id_mk_diambil = $mhs->mataKuliahKrs()->pluck('mata_kuliah_id')->toArray();

        return view('mahasiswa.krs.index', compact('matakuliah_tersedia', 'id_mk_diambil'));
    }

    /**
     * Proses Kontrak KRS Otomatis: Sekaligus mengunci kelas_id mahasiswa
     */
    public function ambil($id)
    {
        $mhs = auth()->user()->mahasiswa;
        $mk = MataKuliah::findOrFail($id);

        // 1. Cari Jadwal Kuliah yang membuka Mata Kuliah ini di semester 6
        // Sistem mencari tahu: MK Kecerdasan Buatan ini dibuka di kelas mana oleh Admin
        $jadwal = JadwalKuliah::where('mata_kuliah_id', $mk->id)->first();

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Mata kuliah ini belum dijadwalkan oleh Admin Prodi.');
        }

        // 2. Gunakan attach() untuk menyimpan ke tabel pivot 'krs' jika belum pernah diambil
        if (!$mhs->mataKuliahKrs()->where('mata_kuliah_id', $id)->exists()) {
            
            // LOGIKA DINAMIS ANDA: Detik ini juga, set kelas_id mahasiswa mengikuti kelas dari Jadwal MK tersebut!
            // Misal Jadwal Kecerdasan Buatan dibuka untuk Kelas Ruang Kelas 1 (ID: 4), 
            // maka kelas_id Naufal otomatis terupdate menjadi 4 secara instant.
            $mhs->update([
                'kelas_id' => $jadwal->kelas_id
            ]);

            $mhs->mataKuliahKrs()->attach($id);
            
            return redirect()->back()->with('success', 'Mata kuliah ' . $mk->nama_mk . ' berhasil dikontrak ke KRS Anda.');
        }

        return redirect()->back()->with('error', 'Mata kuliah ini sudah ada di KRS Anda.');
    }

    public function batal($id)
    {
        $mhs = auth()->user()->mahasiswa;
        
        $mhs->mataKuliahKrs()->detach($id);
        
        // Kembalikan kelas_id menjadi null saat batal kontrak krs
        $mhs->update(['kelas_id' => null]);

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus dari KRS Anda.');
    }
}