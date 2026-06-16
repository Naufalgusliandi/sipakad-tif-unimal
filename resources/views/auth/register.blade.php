<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAKAD TIF - Registrasi Akun Academic</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 via-slate-100 to-emerald-50/20 font-sans antialiased min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-200/60 overflow-hidden my-8">
        
        <div class="px-8 pt-8 pb-4 text-center border-b border-slate-100 bg-gradient-to-b from-slate-50 to-white">
            <div class="inline-block p-2 bg-emerald-50 rounded-xl border border-emerald-100 mb-3 shadow-inner">
                <img src="{{ asset('images/logo-tif.png') }}" alt="Logo TIF" class="w-14 h-14 object-contain">
            </div>
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Registrasi Akun Akademik</h2>
            <p class="text-xs font-semibold text-emerald-700 uppercase tracking-wider mt-1">Sistem Informasi Portal Akademik Terpadu</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="p-8 space-y-5">
            @csrf

            <div class="space-y-1.5">
                <label for="name" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Nama Lengkap Sesuai KTM</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="Masukkan nama lengkap">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="space-y-1.5">
                <label for="email" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Alamat Email Akademik</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </span>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="contoh@unimal.ac.id">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="space-y-1.5">
                <label for="nim" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Nomor Induk Mahasiswa (NIM)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </span>
                    <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="Contoh: 2023101001">
                </div>
                <x-input-error :messages="$errors->get('nim')" class="mt-1" />
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </span>
                    <input id="password" type="password" name="password" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="Minimal 8 karakter">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-xs font-bold text-slate-700 tracking-wide uppercase">Ulangi Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                    </span>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium text-slate-900 focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-600/10 transition-all" placeholder="Konfirmasi sandi Anda">
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <button type="submit" class="w-full mt-2 py-3 px-4 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-700/10 hover:shadow-xl hover:shadow-emerald-700/20 transition-all duration-150 transform active:scale-[0.98]">
                Daftarkan Akun
            </button>

            <div class="text-center pt-2 border-t border-slate-100 mt-4">
                <p class="text-sm text-slate-500">
                    Sudah memiliki akun portal? 
                    <a href="{{ route('login') }}" class="font-bold text-amber-600 hover:text-amber-500 hover:underline transition-all">Log In di Sini</a>
                </p>
            </div>

        </form>
    </div>

</body>
</html>