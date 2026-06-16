<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa dengan fitur Pencarian & Pagination
     */
    /**
     * Menampilkan daftar mahasiswa dengan fitur Pencarian & Pagination
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query optimasi menggunakan Eager Loading (with) untuk mencegah N+1 Query Problem
        $mahasiswas = Mahasiswa::with('user')
            ->when($search, function ($query, $search) {
                $query->where('nim', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q) use ($search) { // Menggunakan 'use ($search)' yang benar
                          $q->where('name', 'like', "%{$search}%")
                            ->where('role', 'mahasiswa');
                      });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // Menjaga keyword pencarian saat berpindah halaman pagination

        return view('admin.mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Menampilkan form tambah mahasiswa
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Menyimpan data mahasiswa baru (Proses ganda ke tabel users & mahasiswas)
     */
    public function store(Request $request)
    {
        // Validasi input yang ketat demi integritas data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nim' => 'required|string|max:20|unique:mahasiswas',
            'prodi' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:14',
            'angkatan' => 'required|string|size:4',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Amankan pembuatan user kredensial login
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Default password awal mahasiswa
            'role' => 'mahasiswa',
        ]);

        // 2. Handle upload file foto profil secara aman
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pasfoto', 'public');
        }

        // 3. Simpan data spesifik akademik ke tabel mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'semester' => $request->semester,
            'angkatan' => $request->angkatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan ke dalam sistem.');
    }

    /**
     * Menghapus data mahasiswa secara aman (Soft Deletes)
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Hapus juga akun user terkait agar tidak bisa login selama statusnya dihapus
        $user = User::findOrFail($mahasiswa->user_id);
        
        $mahasiswa->delete(); // Soft delete pemicu di tabel mahasiswa
        $user->delete();      // Soft delete pemicu di tabel user

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil dinonaktifkan.');
    }
}