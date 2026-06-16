<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah dengan fitur Pencarian & Pagination
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mataKuliahs = MataKuliah::when($search, function ($query, $search) {
                $query->where('nama_mk', 'like', "%{$search}%")
                      ->orWhere('kode_mk', 'like', "%{$search}%");
            })
            ->orderBy('semester', 'asc')
            ->orderBy('kode_mk', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.mata-kuliah.index', compact('mataKuliahs', 'search'));
    }

    /**
     * Menampilkan form tambah mata kuliah
     */
    public function create()
    {
        return view('admin.mata-kuliah.create');
    }

    /**
     * Menyimpan data mata kuliah baru ke sistem
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:15|unique:mata_kuliahs,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah baru berhasil ditambahkan ke dalam kurikulum.');
    }

    /**
     * Menghapus mata kuliah secara aman (Soft Deletes)
     */
    public function destroy($id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->delete();

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus dari kurikulum aktif.');
    }
}