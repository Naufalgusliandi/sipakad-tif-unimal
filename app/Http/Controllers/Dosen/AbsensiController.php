<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\JadwalKuliah; // Digunakan sebagai jembatan mengajar dosen
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Halaman Utama: Menampilkan Kelas dan Mata Kuliah yang HANYA diampu oleh dosen bersangkutan
     */
    public function index()
    {
        // 1. Kunci data profil dosen yang sedang aktif login
        $dosenActive = auth()->user()->dosen;

        if (!$dosenActive) {
            return view('dosen.absensi.index', ['kelas' => collect(), 'mata_kuliah' => collect()])
                ->with('error', 'Profil dosen Anda belum dikonfigurasi oleh Admin.');
        }

        // 2. Filter Jadwal: Hanya ambil jadwal mengajar milik dosen ini
        $jadwalDosen = JadwalKuliah::with(['kelas', 'mataKuliah'])
            ->where('dosen_id', $dosenActive->id)
            ->get();

        // Pluck data unik agar tidak duplikat di pilihan dropdown view
        $kelas = $jadwalDosen->pluck('kelas')->unique('id');
        $mata_kuliah = $jadwalDosen->pluck('mataKuliah')->unique('id');

        return view('dosen.absensi.index', compact('kelas', 'mata_kuliah'));
    }

    /**
     * Form Absensi: Menampilkan daftar mahasiswa berdasarkan KELAS & KONTRAK KRS
     */
    public function create(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'pertemuan_ke' => 'required|integer|min:1|max:16'
        ]);

        $kelasSelected = Kelas::findOrFail($request->kelas_id);
        $mkSelected = MataKuliah::findOrFail($request->mata_kuliah_id);
        $pertemuan = $request->pertemuan_ke;

        $mahasiswas = Mahasiswa::whereHas('user')
    ->with('user')
    // HAPUS pembatasan kelas_id dari profil mahasiswa agar semua mahasiswa yang kontrak MK ini bisa diabsen
    ->whereHas('mataKuliahKrs', function ($query) use ($mkSelected) {
        $query->where('mata_kuliah_id', $mkSelected->id);
    })
    ->orderBy('nim', 'asc')
    ->get();

        return view('dosen.absensi.create', compact('kelasSelected', 'mkSelected', 'pertemuan', 'mahasiswas'));
    }

    /**
     * Menyimpan data presensi masal ke database
     */
    /**
     * Menyimpan data presensi masal ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|array',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'kelas_id' => 'required|exists:kelas,id',
            'pertemuan_ke' => 'required|integer',
        ]);

        $dosenActive = auth()->user()->dosen;
        if (!$dosenActive) {
            return redirect()->back()->with('error', 'Sesi dosen tidak valid.');
        }

        foreach ($request->status as $mahasiswaId => $statusKehadiran) {
            Absensi::updateOrCreate(
                [
                    'mahasiswa_id'   => $mahasiswaId,
                    'mata_kuliah_id' => $request->mata_kuliah_id,
                    'kelas_id'       => $request->kelas_id,
                    'pertemuan_ke'   => $request->pertemuan_ke,
                ],
                [
                    'dosen_id' => $dosenActive->id,
                    'tanggal'  => $request->tanggal ?? now()->toDateString(), // Mengikuti input tanggal form
                    'jam'      => $request->jam ?? now()->toTimeString(),     // Mengikuti input jam form
                    'status'   => $statusKehadiran,
                ]
            );
        }

        // PERBAIKAN ALUR: Kembali ke lembar yang sama agar dosen bisa langsung meninjau hasilnya
        return redirect()->route('dosen.absensi.create', [
            'kelas_id' => $request->kelas_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'pertemuan_ke' => $request->pertemuan_ke
        ])->with('success', 'Presensi mahasiswa pada Pertemuan Ke-' . $request->pertemuan_ke . ' berhasil disimpan.');
    }
}