<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{
    /**
     * Menampilkan daftar seluruh jadwal kuliah aktif
     */
    public function index()
    {
        // Menggunakan Eager Loading (with) untuk mencegah N+1 Query Problem di view
        $jadwals = JadwalKuliah::with(['mataKuliah', 'kelas', 'ruangan', 'dosen.user'])
            ->orderBy('hari', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        return view('admin.jadwal.index', compact('jadwals'));
    }

    /**
     * Menampilkan form penyusunan jadwal kuliah baru beserta data master dropdown
     */
    public function create()
    {
        $mata_kuliah = MataKuliah::orderBy('nama_mk')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();
        $dosens = Dosen::with('user')->get();

        return view('admin.jadwal.create', compact('mata_kuliah', 'kelas', 'ruangans', 'dosens'));
    }

    /**
     * Menyimpan jadwal baru dengan proteksi deteksi bentrok pemakaian ruangan kelas
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'kelas_id' => 'required|exists:kelas,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'dosen_id' => 'required|exists:dosens,id',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        // ALGORITMA PROTEKSI: Cek apakah ada jadwal lain di ruangan yang sama pada hari dan rentang jam tersebut
        $isBentrok = JadwalKuliah::where('hari', $request->hari)
            ->where('ruangan_id', $request->ruangan_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
            })->exists();

        if ($isBentrok) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['bentrok' => 'Gagal menyimpan! Ruangan tersebut sudah digunakan oleh jadwal perkuliahan lain pada hari dan jam yang sama.']);
        }

        JadwalKuliah::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal perkuliahan baru berhasil disusun dan dipublikasikan.');
    }

    /**
     * Menghapus jadwal kuliah
     */
    public function destroy($id)
    {
        JadwalKuliah::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal perkuliahan berhasil dihapus dari sistem.');
    }
}