<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class SipakadApiController extends Controller
{
    /**
     * Endpoint API: Ambil Seluruh Data Mahasiswa
     */
    public function getMahasiswa()
    {
        $mahasiswa = Mahasiswa::with(['user', 'kelas'])->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data Mahasiswa berhasil diambil',
            'data'    => $mahasiswa
        ], 200);
    }

    /**
     * Endpoint API: Ambil Seluruh Data Mata Kuliah
     */
    public function getMataKuliah()
    {
        $mk = MataKuliah::all();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data Mata Kuliah berhasil diambil',
            'data'    => $mk
        ], 200);
    }

    /**
     * Endpoint API: Ambil Seluruh Jadwal Kuliah
     */
    public function getJadwal()
    {
        $jadwal = JadwalKuliah::with(['mataKuliah', 'dosen', 'kelas', 'ruangan'])->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data Jadwal Kuliah berhasil diambil',
            'data'    => $jadwal
        ], 200);
    }
}