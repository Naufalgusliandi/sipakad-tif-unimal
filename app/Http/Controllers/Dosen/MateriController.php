<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $dosenActive = auth()->user()->dosen;

        if (!$dosenActive) {
            return view('dosen.materi.index', ['materis' => collect()]);
        }

        $materis = Materi::with(['mataKuliah', 'kelas'])
            ->where('dosen_id', $dosenActive->id)
            ->latest()
            ->paginate(10);

        return view('dosen.materi.index', compact('materis'));
    }

    public function create()
    {
        $dosenActive = auth()->user()->dosen;

        if (!$dosenActive) {
            return redirect()->back()->with('error', 'Profil dosen tidak valid.');
        }

        // PERBAIKAN: Dropdown upload materi hanya menampilkan MK dan kelas yang diajar dosen ini
        $jadwalDosen = JadwalKuliah::with(['kelas', 'mataKuliah'])
            ->where('dosen_id', $dosenActive->id)
            ->get();

        $mata_kuliah = $jadwalDosen->pluck('mataKuliah')->unique('id');
        $kelas = $jadwalDosen->pluck('kelas')->unique('id');

        return view('dosen.materi.create', compact('mata_kuliah', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_materi' => 'required|file|mimes:pdf,ppt,pptx,doc,docx|max:10240',
        ]);

        $dosenActive = auth()->user()->dosen;
        if (!$dosenActive) {
            return redirect()->back()->with('error', 'Sesi dosen tidak valid.');
        }

        $filePath = null;
        if ($request->hasFile('file_materi')) {
            $filePath = $request->file('file_materi')->store('dokumen_kuliah', 'public');
        }

        Materi::create([
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'kelas_id' => $request->kelas_id,
            'dosen_id' => $dosenActive->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath
        ]);

        return redirect()->route('dosen.materi.index')->with('success', 'Materi perkuliahan baru berhasil diunggah.');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        
        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('dosen.materi.index')->with('success', 'Berkas materi berhasil dihapus dari server.');
    }
}