<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAKAD TIF - Selamat Datang Kembali</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-emerald-900 via-emerald-800 to-slate-900 p-12 flex-col justify-between relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="flex items-center gap-4 relative z-10">
                <div class="p-2 bg-white/10 backdrop-blur-md rounded-xl border border-white/20">
                    <img src="{{ asset('images/logo-tif.png') }}" alt="Logo TIF" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg tracking-wide">SIPAKAD</h3>
                    <p class="text-emerald-300 text-xs font-semibold uppercase tracking-wider">Teknik Informatika UNIMAL</p>
                </div>
            </div>

            <div class="my-auto space-y-4 relative z-10 max-w-lg">
                <span class="px-3 py-1 bg-amber-500/20 text-amber-300 text-xs font-bold rounded-full border border-amber-500/30 tracking-wider uppercase">Portal Akademik Terpadu</span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-white leading-tight">Membangun Masa Depan Teknologi dari Ranah Malikussaleh</h2>
                <p class="text-slate-300 text-sm leading-relaxed">Akses dashboard informasi mahasiswa, rekapitulasi penilaian ujian, pengelolaan jadwal perkuliahan, dan modul manajemen materi terproteksi dalam satu basis data terintegrasi.</p>
            </div>

            <div class="text-emerald-400/60 text-xs relative z-10 font-medium">
                &copy; {{ date('Y') }} Teknik Informatika Universitas Malikussaleh. All rights reserved.
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-5 sm:p-8 md:p-16 bg-white">
            <div class="w-full max-w-md space-y-5 sm:space-y-8">
                
                <div class="flex flex-col items-center text-center md:hidden mb-4 sm:mb-6">
    <img src="{{ asset('images/logo-tif.png') }}" alt="Logo TIF" class="w-14 h-14 sm:w-20 sm:h-20 object-contain mb-2 sm:mb-3">
                    <h2 class="text-xl font-bold text-slate-950">SIPAKAD TIF UNIMAL</h2>
                    <p class="text-slate-500 text-xs mt-1">Sistem Informasi Portal Akademik Terpadu</p>
                </div>

                <div class="hidden md:block">
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
                    <p class="text-slate-500 text-sm mt-2">Silakan masukkan akun kredensial akademik Anda untuk mengakses dashboard utama.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5 mt-6">
                    @csrf

                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Alamat Email Resmi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="nama@unimal.ac.id">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Kata Sandi Akun</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-emerald-700 hover:text-emerald-600 hover:underline transition-all" href="{{ route('password.request') }}">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </span>
                            <input id="password" type="password" name="password" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 placeholder-slate-400 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500">
                        <label for="remember_me" class="ml-2.5 text-xs font-medium text-slate-600">Biarkan saya tetap masuk pada perangkat ini</label>
                    </div>

                    <button type="submit" class="w-full py-3.5 px-4 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-700/20 hover:shadow-xl hover:shadow-emerald-700/30 transition-all duration-150 transform active:scale-[0.98]">
                        Masuk ke Portal
                    </button>
                </form>

                <div class="text-center pt-2">
                    <p class="text-sm text-slate-500">
                        Belum memiliki akun akademik? 
                        <a href="{{ route('register') }}" class="font-bold text-amber-600 hover:text-amber-500 hover:underline transition-all">Daftar Sekarang</a>
                    </p>
                </div>

            </div>
        </div>

    </div>

</body>
</html>