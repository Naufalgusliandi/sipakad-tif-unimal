<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Memproses cetak PDF Kartu Hasil Studi (KHS) Mahasiswa
     */
    public function cetakKhs($mahasiswa_id)
    {
        // Ambil data mahasiswa lengkap beserta akun usernya
        $mahasiswa = Mahasiswa::with('user')->findOrFail($mahasiswa_id);

        // Ambil rekapitulasi nilai mata kuliah mahasiswa tersebut
        $nilais = Nilai::with('mataKuliah')
            ->where('mahasiswa_id', $mahasiswa_id)
            ->get();

        // Hitung total SKS dan IPK sementara
        $totalSks = 0;
        $totalBobot = 0;

        foreach ($nilais as $n) {
            $sks = $n->mataKuliah->sks;
            $totalSks += $sks;

            // Konversi nilai huruf ke bobot angka standar akademik
            $bobot = 0;
            switch ($n->nilai_huruf) {
                case 'A':  $bobot = 4.0; break;
                case 'B+': $bobot = 3.5; break;
                case 'B':  $bobot = 3.0; break;
                case 'C+': $bobot = 2.5; break;
                case 'C':  $bobot = 2.0; break;
                case 'D':  $bobot = 1.0; break;
                default:   $bobot = 0.0; break;
            }
            $totalBobot += ($bobot * $sks);
        }

        $ipk = $totalSks > 0 ? round($totalBobot / $totalSks, 2) : 0.00;

        // Render data ke dalam view blade khusus cetak PDF
        $pdf = Pdf::loadView('admin.laporan.khs_pdf', compact('mahasiswa', 'nilais', 'totalSks', 'ipk'))
            ->setPaper('a4', 'portrait');

        // Buka PDF langsung di tab browser baru
        return $pdf->stream('KHS_' . $mahasiswa->nim . '.pdf');
    }
}