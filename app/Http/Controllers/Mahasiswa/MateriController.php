<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Dashboard Mahasiswa: Mengunci data ringkasan murni milik mahasiswa yang login
     */
    public function dashboard()
    {
        // 1. Kunci profil mahasiswa yang sedang login
        $mhs = auth()->user()->mahasiswa;

        if (!$mhs) {
            return view('mahasiswa.dashboard', [
                'mhs' => null, 'sks_total' => 0, 'ipk' => '0.00', 'hadir_pct' => 0
            ]);
        }

        // ===================================================================
        // PERBAIKAN SKS REAL-TIME: Ambil total SKS dari Mata Kuliah yang diambil di KRS
        // ===================================================================
        $sks_total = 0;
        $krs_aktif = $mhs->mataKuliahKrs; // Memanggil relasi belongsToMany ke tabel krs
        foreach ($krs_aktif as $mk) {
            $sks_total += $mk->sks;
        }

        // ===================================================================
        // PERBAIKAN IPK REAL-TIME: Hanya hitung nilai dari MK yang SUDAH dinilai dosen
        // ===================================================================
        $list_nilai = Nilai::with('mataKuliah')
            ->where('mahasiswa_id', $mhs->id)
            ->whereNotNull('uas') // Proteksi krusial: Hanya hitung jika nilai UAS sudah diinput dosen
            ->get();
        
        $total_bobot = 0;
        $sks_pembagi_ipk = 0;

        foreach ($list_nilai as $n) {
            if ($n->mataKuliah) {
                // Rumus Nilai Akhir (20% Tugas + 15% Quiz + 30% UTS + 35% UAS)
                $na = ($n->tugas * 0.2) + ($n->quiz * 0.15) + ($n->uts * 0.3) + ($n->uas * 0.35);
                
                // Konversi ke bobot angka standar akademik Unimal
                if ($na >= 85) $bobot = 4.0;
                elseif ($na >= 78) $bobot = 3.5;
                elseif ($na >= 70) $bobot = 3.0;
                elseif ($na >= 63) $bobot = 2.5;
                elseif ($na >= 55) $bobot = 2.0;
                elseif ($na >= 40) $bobot = 1.0;
                else $bobot = 0.0;

                // Akumulasikan bobot nilai dikali SKS mata kuliah tersebut
                $total_bobot += ($bobot * $n->mataKuliah->sks);
                $sks_pembagi_ipk += $n->mataKuliah->sks;
            }
        }
        
        // Rumus IPK = Total (Bobot * SKS) / Total SKS yang sudah dinilai
        $ipk = $sks_pembagi_ipk > 0 ? number_format($total_bobot / $sks_pembagi_ipk, 2) : "0.00";

        // 4. Hitung Persentase Kehadiran murni milik mahasiswa ini
        $total_absen = Absensi::where('mahasiswa_id', $mhs->id)->count();
        $hadir = Absensi::where('mahasiswa_id', $mhs->id)->where('status', 'Hadir')->count();
        $hadir_pct = $total_absen > 0 ? round(($hadir / $total_absen) * 100) : 100;

        return view('dashboard.mahasiswa', compact('mhs', 'sks_total', 'ipk', 'hadir_pct'));
    }

    /**
     * Repositori Materi: Menampilkan berkas berdasarkan Kurikulum KRS
     */
    public function index()
    {
        $mhs = auth()->user()->mahasiswa;

        if (!$mhs) {
            $materis = collect();
            return view('mahasiswa.materi.index', compact('materis'));
        }

        // 1. Ambil seluruh ID mata kuliah yang SUDAH dikontrak oleh mahasiswa ini di tabel KRS
        $id_mk_diambil = $mhs->mataKuliahKrs()->pluck('mata_kuliah_id')->toArray();

        // 2. Ambil berkas materi kuliah yang MATA KULIAH-nya ada di dalam daftar krs mahasiswa
        $materis = Materi::with(['mataKuliah', 'kelas', 'dosen.user'])
            ->whereIn('mata_kuliah_id', $id_mk_diambil)
            ->latest()
            ->paginate(9);

        return view('mahasiswa.materi.index', compact('materis'));
    }

    /**
     * KHS: Menampilkan Lembar Hasil Studi sekaligus menghitung IPK untuk dicetak ke PDF
     */
    public function khs()
    {
        $mhs = auth()->user()->mahasiswa;
        
        // Ambil semua komponen nilai milik mahasiswa
        $nilais = $mhs ? Nilai::with('mataKuliah')->where('mahasiswa_id', $mhs->id)->get() : collect();
        
        // Hitung ulang IPK khusus untuk ditampilkan pada lembar cetak KHS PDF Anda
        $total_bobot = 0;
        $sks_pembagi_ipk = 0;

        // Ambil nilai yang valid saja untuk kalkulasi IPK di lembar KHS
        $nilai_valid = Nilai::with('mataKuliah')->where('mahasiswa_id', $mhs->id)->whereNotNull('uas')->get();

        foreach ($nilai_valid as $n) {
            if ($n->mataKuliah) {
                $na = ($n->tugas * 0.2) + ($n->quiz * 0.15) + ($n->uts * 0.3) + ($n->uas * 0.35);
                
                if ($na >= 85) $bobot = 4.0;
                elseif ($na >= 78) $bobot = 3.5;
                elseif ($na >= 70) $bobot = 3.0;
                elseif ($na >= 63) $bobot = 2.5;
                elseif ($na >= 55) $bobot = 2.0;
                elseif ($na >= 40) $bobot = 1.0;
                else $bobot = 0.0;

                $total_bobot += ($bobot * $n->mataKuliah->sks);
                $sks_pembagi_ipk += $n->mataKuliah->sks;
            }
        }

        $ipk = $sks_pembagi_ipk > 0 ? number_format($total_bobot / $sks_pembagi_ipk, 2) : "0.00";
        
        return view('mahasiswa.khs', compact('nilais', 'ipk'));
    }

    /**
     * Presensi: Mengunci Rekapitulasi Absensi kelas murni milik akun login
     */
    public function print_khs()
    {
        // Kode print opsional Anda jika dibutuhkan
    }

    public function presensi()
    {
        $mhs = auth()->user()->mahasiswa;
        
        $absensis = $mhs ? Absensi::with('mataKuliah')->where('mahasiswa_id', $mhs->id)->latest()->get() : collect();
        
        return view('mahasiswa.presensi', compact('absensis'));
    }
}