<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Administrator
        User::create([
            'name' => 'Administrator SIPAKAD',
            'email' => 'admin@unimal.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun & Profil Dosen
        $userDosen = User::create([
            'name' => 'Dosen Pengajar, S.Kom., M.Kom.',
            'email' => 'dosen@unimal.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'dosen',
        ]);

        $dosen = Dosen::create([
            'user_id' => $userDosen->id,
            'nidn' => '19890101201501',
            'jabatan' => 'Lektor'
        ]);

        // 3. Kelas Master
        $kelas = Kelas::create([
            'nama_kelas' => 'TIF-A1',
            'dosen_id' => $dosen->id
        ]);

        // 4. Akun & Profil Mahasiswa
        $userMhs = User::create([
            'name' => 'Mahasiswa Informatika',
            'email' => 'mahasiswa@mhs.unimal.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $userMhs->id,
            'kelas_id' => $kelas->id,
            'nim' => '2023101001',
            'prodi' => 'Teknik Informatika',
            'semester' => 6,
            'angkatan' => '2023'
        ]);

        // 5. Data Mata Kuliah
        MataKuliah::create([
            'kode_mk' => 'TIF601',
            'nama_mk' => 'Kecerdasan Buatan',
            'sks' => 3,
            'semester' => 6
        ]);
    }
}