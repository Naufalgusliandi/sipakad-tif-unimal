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
                // Data ringkasan awal untuk dashboard statistik admin
                $stats = [
                    'total_mahasiswa'   => Mahasiswa::count(),
                    'total_dosen'       => Dosen::count(),
                    'total_mata_kuliah' => MataKuliah::count(),
                    'kehadiran_hari_ini' => '100%',
                ];
                return view('dashboard.admin', compact('stats'));

            case 'dosen':
                // Dosen langsung diarahkan ke halaman utama aktivitasnya
                return redirect()->route('dosen.absensi.index');

            case 'mahasiswa':
                // PERBAIKAN MUTLAK: Alihkan ke rute mahasiswa agar dibaca oleh fungsi dashboard() di MateriController
                return redirect()->route('mahasiswa.dashboard');
                
            default:
                abort(403, 'Role tidak dikenali.');
        }
    }
}