<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Halaman Utama: Mengunci pilihan filter hanya untuk kelas/MK yang diampu dosen tersebut
     */
    public function index()
    {
        $dosenActive = auth()->user()->dosen;

        if (!$dosenActive) {
            return view('dosen.nilai.index', ['kelas' => collect(), 'mata_kuliah' => collect()]);
        }

        $jadwalDosen = JadwalKuliah::with(['kelas', 'mataKuliah'])
            ->where('dosen_id', $dosenActive->id)
            ->get();
        
        $kelas = $jadwalDosen->pluck('kelas')->unique('id');
        $mata_kuliah = $jadwalDosen->pluck('mataKuliah')->unique('id');

        return view('dosen.nilai.index', compact('kelas', 'mata_kuliah'));
    }

    /**
     * Lembar Penilaian: Menampilkan mahasiswa yang valid di dalam kelas terpilih
     */
    /**
     * Lembar Penilaian: Menampilkan mahasiswa yang valid berdasarkan Kelas & Kontrak KRS
     */
    public function create(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id'
        ]);

        $kelasSelected = Kelas::findOrFail($request->kelas_id);
        $mkSelected = MataKuliah::findOrFail($request->mata_kuliah_id);

        $mahasiswas = Mahasiswa::with(['user', 'nilai' => function($query) use ($mkSelected, $kelasSelected) {
        $query->where('mata_kuliah_id', $mkSelected->id)->where('kelas_id', $kelasSelected->id);
        }])
        // HAPUS pembatasan 'where(kelas_id)' dari profil mahasiswa
        ->whereHas('mataKuliahKrs', function ($query) use ($mkSelected) {
            $query->where('mata_kuliah_id', $mkSelected->id);
        })
        ->orderBy('nim', 'asc')
        ->paginate(15);

        $mahasiswas->appends($request->all());

        return view('dosen.nilai.create', compact('kelasSelected', 'mkSelected', 'mahasiswas'));
    }

    /**
     * Menyimpan nilai KHS mahasiswa
     */
    /**
     * Menyimpan nilai KHS mahasiswa
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'tugas' => 'required|array',
            'quiz' => 'required|array',
            'uts' => 'required|array',
            'uas' => 'required|array',
        ]);

        $dosenActive = auth()->user()->dosen;
        if (!$dosenActive) {
            return redirect()->back()->with('error', 'Sesi dosen tidak valid.');
        }

        foreach ($request->tugas as $mahasiswaId => $val) {
            $tugas = $request->tugas[$mahasiswaId] ?? 0;
            $quiz  = $request->quiz[$mahasiswaId] ?? 0;
            $uts   = $request->uts[$mahasiswaId] ?? 0;
            $uas   = $request->uas[$mahasiswaId] ?? 0;

            // Hitung kalkulasi Nilai Akhir otomatis sesuai rumus formula SIPAKAD Anda
            $nilaiAkhir = ($tugas * 0.2) + ($quiz * 0.15) + ($uts * 0.3) + ($uas * 0.35);

            // Klasifikasi Grade Huruf standar Universitas Malikussaleh
            if ($nilaiAkhir >= 85) $huruf = 'A';
            elseif ($nilaiAkhir >= 78) $huruf = 'B+';
            elseif ($nilaiAkhir >= 70) $huruf = 'B';
            elseif ($nilaiAkhir >= 63) $huruf = 'C+';
            elseif ($nilaiAkhir >= 55) $huruf = 'C';
            elseif ($nilaiAkhir >= 40) $huruf = 'D';
            else $huruf = 'E';

            \App\Models\Nilai::updateOrCreate(
                [
                    'kelas_id'       => $request->kelas_id,
                    'mata_kuliah_id' => $request->mata_kuliah_id,
                    'mahasiswa_id'   => $mahasiswaId,
                ],
                [
                    'dosen_id'    => $dosenActive->id,
                    'tugas'       => $tugas,
                    'quiz'        => $quiz,
                    'uts'         => $uts,
                    'uas'         => $uas,
                    'nilai_akhir' => $nilaiAkhir,
                    'nilai_huruf' => $huruf,
                ]
            );
        }

        // PERBAIKAN MUTLAK: Tetap bertahan di halaman lembar input nilai agar dosen bisa langsung meninjau hasilnya
        return redirect()->route('dosen.nilai.create', [
            'kelas_id' => $request->kelas_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'page' => $request->page ?? 1 // Menjaga posisi pagination halaman nilai agar tidak melompat
        ])->with('success', 'Komponen nilai evaluasi mahasiswa berhasil dikalkulasi dan diperbarui.');
    }
}