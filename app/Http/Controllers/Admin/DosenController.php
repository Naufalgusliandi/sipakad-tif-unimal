<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Menampilkan daftar dosen dengan fitur Pencarian & Pagination
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Optimasi Eager Loading untuk mencegah N+1 Query Problem
        $dosens = Dosen::with('user')
            ->when($search, function ($query, $search) {
                $query->where('nidn', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->where('role', 'dosen');
                      });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.dosen.index', compact('dosens', 'search'));
    }

    /**
     * Menampilkan form tambah dosen
     */
    public function create()
    {
        return view('admin.dosen.create');
    }

    /**
     * Menyimpan data dosen baru ke sistem
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nidn' => 'required|string|max:20|unique:dosens',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Buat user akun login dosen
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('dosen123'), // Default password awal akun dosen
            'role' => 'dosen',
        ]);

        // 2. Handle upload foto profil dosen
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pasfoto_dosen', 'public');
        }

        // 3. Simpan data spesifik ke tabel dosens
        Dosen::create([
            'user_id' => $user->id,
            'nidn' => $request->nidn,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen pengajar berhasil ditambahkan ke dalam sistem.');
    }

    /**
     * Menghapus dosen secara aman (Soft Deletes)
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);
        
        $dosen->delete();
        $user->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil dinonaktifkan dari sistem akademik.');
    }
}