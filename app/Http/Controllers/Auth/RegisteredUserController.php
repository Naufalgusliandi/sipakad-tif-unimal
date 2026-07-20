<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data akun dasar pendaftaran
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nim' => ['required', 'string', 'min:9', 'max:20', 'unique:mahasiswas,nim'],
        ]);

        // 1. EKSTRAKSI TAHUN ANGKATAN DARI 2 DIGIT PERTAMA NIM
        $duaDigitDepan = substr($request->nim, 0, 2);
        $angkatanOtomatis = '20' . $duaDigitDepan;

        // 2. ALGORITMA HITUNG SEMESTER DINAMIS
        $tahunSekarang = 2026; 
        $selisihTahun = $tahunSekarang - (int)$angkatanOtomatis;
        
        $semesterOtomatis = $selisihTahun * 2;

        if ($semesterOtomatis < 1) {
            $semesterOtomatis = 1;
        }

        if ($semesterOtomatis > 14) $semesterOtomatis = 14;

        // 3. Simpan Kredensial Login Utama ke tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        // 4. Simpan Profil Mahasiswa
        Mahasiswa::create([
            'user_id'   => $user->id,
            'kelas_id'  => null,
            'nim'       => $request->nim,
            'prodi'     => 'Teknik Informatika',
            'semester'  => $semesterOtomatis, 
            'angkatan'  => $angkatanOtomatis, 
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard'));
    }
}