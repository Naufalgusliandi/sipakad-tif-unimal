<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIPAKAD UNIMAL - @yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ── INJEKSI CSS GLOBAL MODERN & USER FRIENDLY (CLEAN SAAS INTERFACE) ── */
        
        /* 1. Keterbacaan Utama: Amankan semua teks data agar hitam pekat dan kontras tinggi */
        main p, main td, main th, main h1, main h2, main h3, main label, main span:not([class*="text-"]) {
            color: #0f172a !important; /* Slate 900 */
        }
        main .text-slate-300, main .text-slate-400, main .text-slate-500, main .text-slate-600 {
            color: #475569 !important; /* Slate 600 untuk deskripsi/sub-teks */
        }

        /* 2. Transformasi Komponen: Kartu dan Tabel Menjadi Putih Bersih Dengan Efek Shadow Lembut */
        main .bg-slate-900, main .bg-slate-900\/40, main .bg-slate-950\/40, main .bg-slate-900\/20, main .bg-slate-900\/50, main .bg-slate-950 {
            background-color: #ffffff !important;
            background-image: none !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05) !important;
            border-radius: 1rem !important;
        }
        
        /* 3. Pembatas Baris Tabel yang Tipis & Bersih */
        main border, main .border-slate-800, main .border-slate-800\/60, main .border-slate-800\/80, main td, main th {
            border-color: #f1f5f9 !important; /* Slate 100 */
        }

        /* 4. Desain Input Form yang Ergonomis & Nyaman di Mata */
        main input, main select, main textarea {
            background-color: #ffffff !important;
            color: #0f172a !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 0.75rem !important;
            padding: 0.625rem 1rem !important;
            transition: all 0.2s ease !important;
        }
        main input:focus, main select:focus, main textarea:focus {
            border-color: #10b981 !important; /* Hijau Emerald */
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1) !important;
            outline: none !important;
        }

        /* 5. Standarisasi Tombol Utama (Bawaan Indigo/Purple) Menjadi Hijau Emerald */
        main .bg-gradient-to-r.from-indigo-600, 
        main .bg-gradient-to-r.from-purple-600, 
        main .bg-indigo-600,
        main button[type="submit"]:not([class*="text-slate"]),
        main a.bg-indigo-600,
        main a.bg-blue-600 {
            background: linear-gradient(135deg, #047857, #059669) !important; 
            color: #ffffff !important;
            border: none !important;
            border-radius: 0.75rem !important;
            font-weight: 700 !important;
            transition: all 0.2s ease !important;
        }
        main .bg-indigo-600:hover, main button[type="submit"]:hover {
            opacity: 0.95 !important;
            transform: translateY(-1px) !important;
        }
        
        /* Pengecualian Khusus: Pastikan Teks di Dalam Tombol Utama Tetap Berwarna Putih */
        main .bg-gradient-to-r.from-indigo-600 *, main .bg-indigo-600 * {
            color: #ffffff !important;
        }

        /* 6. Tombol Aksi Mikro di Dalam Tabel (Edit, Hapus, Cetak) Tetap Berwarna Semarak */
        main a[class*="text-slate-500"]:hover {
            background-color: #f1f5f9 !important;
        }
        main a[title*="Cetak"] svg, main a[title*="Cetak"] {
            color: #4f46e5 !important; /* Biru/Indigo Khusus Cetak */
        }
        main button[title*="Hapus"] svg, main button[title*="Hapus"] {
            color: #e11d48 !important; /* Merah Khusus Hapus */
        }

        /* Scrollbar Cerah Minimalis */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen overflow-x-hidden relative selection:bg-emerald-500/20">

    <div class="flex min-h-screen overflow-hidden">
        
        <aside class="w-72 bg-emerald-950 border-r border-emerald-900 p-6 flex flex-col justify-between hidden lg:flex shrink-0 z-20 shadow-xl shadow-slate-900/5">
            <div>
                <div class="flex items-center gap-3.5 px-2 mb-8">
                    <div class="h-11 w-11 bg-white p-1 rounded-xl flex items-center justify-center shadow-md border border-slate-100 shrink-0">
                        <img src="{{ asset('images/logo-tif.png') }}" alt="Logo TIF" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold tracking-tight text-white">SIPAKAD</h1>
                        <p class="text-[10px] font-bold text-amber-400 tracking-wider uppercase">T. Informatika UNIMAL</p>
                    </div>
                </div>

                <nav class="space-y-1.5">
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5 shadow-sm" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        <span class="text-sm" style="color: inherit !important;">Dashboard</span>
                    </a>

                    <span class="block pt-5 pb-1 px-4 text-[11px] font-bold text-emerald-400/50 tracking-widest uppercase">Master Data</span>
                    
                    <a href="{{ route('admin.mahasiswa.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }} group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="text-sm" style="color: inherit !important;">Mahasiswa</span>
                    </a>

                    <a href="{{ route('admin.dosen.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dosen.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }} group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v4a2 2 0 01-2 2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        <span class="text-sm" style="color: inherit !important;">Dosen</span>
                    </a>

                    <a href="{{ route('admin.mata-kuliah.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.mata-kuliah.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }} group">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span class="text-sm" style="color: inherit !important;">Mata Kuliah</span>
                    </a>

                    <a href="{{ route('admin.kelas.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.kelas.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="text-sm" style="color: inherit !important;">Kelas</span>
                    </a>

                    <a href="{{ route('admin.ruangan.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.ruangan.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="text-sm" style="color: inherit !important;">Ruangan</span>
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.jadwal.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jadwal.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Jadwal Kuliah</span>
                        </a>
                    @endif

                    <span class="block pt-5 pb-1 px-4 text-[11px] font-bold text-emerald-400/50 tracking-widest uppercase">Aktivitas Akademik</span>

                    @if(auth()->user()->role === 'dosen')
                        <a href="{{ route('dosen.absensi.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.absensi.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 112-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Kelola Absensi</span>
                        </a>
                    @endif

                    @if(auth()->user()->role === 'dosen')
                        <a href="{{ route('dosen.nilai.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.nilai.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002-2V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 16.114l-2.093-2.094m0 0l-2.093 2.093m2.093-2.093v4.75"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Kelola Nilai</span>
                        </a>
                    @endif

                    @if(auth()->user()->role === 'mahasiswa')
                        <span class="block pt-5 pb-1 px-4 text-[11px] font-bold text-emerald-400/50 tracking-widest uppercase">Panel Mahasiswa</span>

                        <a href="{{ route('mahasiswa.presensi') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.presensi') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Lihat Presensi</span>
                        </a>

                        <a href="{{ route('mahasiswa.khs') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.khs') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002-2V6.108c0-1.135-.845-2.098-1.976-2.192"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Kartu Hasil Studi (KHS)</span>
                        </a>

                        <a href="{{ route('mahasiswa.materi.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.materi.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Unduh Materi Kuliah</span>
                        </a>

                        <a href="{{ route('mahasiswa.krs.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.krs.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Isi KRS Manual</span>
                        </a>
                    @endif

                    @if(auth()->user()->role === 'dosen')
                        <a href="{{ route('dosen.materi.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.materi.*') ? 'bg-amber-500 text-emerald-950 font-bold shadow-md' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"></path></svg>
                            <span class="text-sm" style="color: inherit !important;">Kelola Materi</span>
                        </a>
                    @endif
                </nav>
            </div>

            <div class="border-t border-emerald-900/60 pt-4 flex items-center justify-between bg-emerald-900/20 p-3 rounded-2xl border border-emerald-800/40">
                <div class="flex items-center gap-3 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=059669&color=fff&bold=true" class="h-9 w-9 rounded-xl border border-emerald-500/20 shadow-inner shrink-0" alt="Avatar">
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold truncate" style="color: #ffffff !important;">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] font-bold text-amber-400 capitalize tracking-wider">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" id="form-logout-sipakad" class="shrink-0">
                    @csrf
                    <button type="submit" class="p-2 text-emerald-300 hover:text-rose-400 hover:bg-white/5 rounded-xl transition-all duration-200" title="Keluar Sistem">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden bg-slate-100">
            
            <header class="h-20 border-b border-slate-200 bg-white flex items-center justify-between px-8 shrink-0 z-10 shadow-sm">
                <div>
                    <h2 class="text-sm font-bold text-emerald-700 tracking-wide uppercase text-[10px]" style="color: #047857 !important;">@yield('page_category', 'Sistem Informasi Akademik')</h2>
                    <h1 class="text-xl font-extrabold text-slate-900 tracking-tight mt-0.5" style="color: #0f172a !important;">@yield('page_title', 'Dashboard')</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200/60 px-4 py-2 rounded-xl tracking-wide font-mono" style="color: #064e3b !important;">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 custom-scrollbar">
                
                @if (session('error'))
                    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-700 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

    </div>

</body>
</html>