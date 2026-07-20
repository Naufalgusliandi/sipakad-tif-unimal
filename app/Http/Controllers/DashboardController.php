<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang sedang login saat ini
        $user = auth()->user();

        // 2. Saring jalurnya berdasarkan role user secara aman dan profesional
        switch ($user->role) {
            case 'admin':
                // Ambil hitungan riil status absensi dari database
                $hadir = \App\Models\Absensi::where('status', 'Hadir')->count();
                $izin  = \App\Models\Absensi::where('status', 'Izin')->count();
                $sakit = \App\Models\Absensi::where('status', 'Sakit')->count();
                $alpa  = \App\Models\Absensi::where('status', 'Alpa')->count();

                // Data ringkasan statistik admin
                $stats = [
                    'total_mahasiswa'   => Mahasiswa::count(),
                    'total_dosen'       => Dosen::count(),
                    'total_mata_kuliah' => MataKuliah::count(),
                    'kehadiran_hari_ini' => $hadir . ' Mahasiswa',
                    'chart_hadir'       => $hadir,
                    'chart_izin'        => $izin,
                    'chart_sakit'       => $sakit,
                    'chart_alpa'        => $alpa,
                ];
                return view('dashboard.admin', compact('stats'));

            case 'dosen':
                // 1. Ambil data profil dosen dari user yang login
                $dosen = Dosen::where('user_id', $user->id)->first();
                $dosenId = $dosen ? $dosen->id : null;

                // 2. Hitung statistik riil pengajar
                $stats = [
                    'total_jadwal'  => \App\Models\JadwalKuliah::where('dosen_id', $dosenId)->count(),
                    'total_materi'  => \App\Models\Materi::where('dosen_id', $dosenId)->count(),
                    
                    // PERBAIKAN AMAN: Hitung total absensi yang telah diinput di sistem
                    'total_absensi' => \App\Models\Absensi::count(),
                ];

                // 3. Ambil daftar jadwal mengajar dosen ini
                $jadwals = \App\Models\JadwalKuliah::with(['mataKuliah', 'kelas', 'ruangan'])
                    ->where('dosen_id', $dosenId)
                    ->get();

                // 4. Tampilkan view dashboard dosen (bukan redirect)
                return view('dashboard.dosen', compact('dosen', 'stats', 'jadwals'));;

            case 'mahasiswa':
                // PERBAIKAN MUTLAK: Alihkan ke rute mahasiswa agar dibaca oleh fungsi dashboard() di MateriController
                return redirect()->route('mahasiswa.dashboard');
                
            default:
                abort(403, 'Role tidak dikenali.');
        }
    }
}