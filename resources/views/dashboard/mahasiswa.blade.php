@extends('layouts.sipakad')

@section('title', 'Dashboard Mahasiswa')
@section('page_category', 'Portal Akademik')
@section('page_title', 'Ringkasan Aktivitas Akademik')

@section('content')
<div class="space-y-8">
    
    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-200 mb-2">
        <div class="p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex flex-col md:flex-row items-center gap-5 text-center md:text-left">
                <div class="p-2 bg-emerald-50 rounded-2xl border border-emerald-100 shadow-inner">
                    <img src="{{ asset('images/logo-tif.png') }}" alt="Logo TIF" class="w-24 h-24 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang, {{ auth()->user()->name }}</h1>
                    <p class="text-emerald-700 font-semibold text-sm mt-0.5 tracking-wide uppercase">Prodi {{ $mhs->prodi ?? 'Teknik Informatika' }} • Kelas {{ $mhs->kelas->nama_kelas ?? '-' }}</p>
                    <div class="h-1 w-20 bg-amber-500 rounded-full mt-2 mx-auto md:mx-0"></div>
                </div>
            </div>

            <div class="px-5 py-3 bg-slate-900 rounded-xl border border-slate-800 shadow-sm text-center md:text-right">
                <p class="text-xs text-slate-400 font-medium tracking-wider uppercase">NIM MAHASISWA</p>
                <p class="text-sm font-bold text-amber-400 mt-0.5 font-mono">{{ $mhs->nim ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm flex items-center justify-between group hover:border-emerald-500/30 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Indeks Prestasi Kumulatif</p>
                <h3 class="text-3xl font-extrabold text-slate-900 font-mono tracking-tight">{{ $ipk }}</h3>
                <p class="text-[11px] text-slate-500">Skala Kelulusan 4.00</p>
            </div>
            <div class="h-12 w-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-black text-lg shadow-inner">IPK</div>
        </div>

        <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm flex items-center justify-between group hover:border-emerald-500/30 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Beban SKS Semester</p>
                <h3 class="text-3xl font-extrabold text-slate-900 font-mono tracking-tight">{{ $sks_total }} <span class="text-sm font-bold text-slate-400">SKS</span></h3>
                <p class="text-[11px] text-slate-500">Semester Aktif: Ke-{{ $mhs->semester ?? 1 }}</p>
            </div>
            <div class="h-12 w-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>

        <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm flex items-center justify-between group hover:border-emerald-500/30 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rata-rata Kehadiran</p>
                <h3 class="text-3xl font-extrabold text-slate-900 font-mono tracking-tight">{{ $hadir_pct }}<span class="text-sm font-bold text-slate-400">%</span></h3>
                <p class="text-[11px] {{ $hadir_pct >= 75 ? 'text-emerald-600' : 'text-rose-600' }} font-semibold">
                    {{ $hadir_pct >= 75 ? 'Aman untuk mengikuti ujian' : 'Waspada! Kurang dari batas 75%' }}
                </p>
            </div>
            <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
            </div>
        </div>

    </div>

    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-200 p-8 relative">
        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="flex items-start gap-4">
            <div class="p-3 bg-amber-50 rounded-xl text-amber-600 mt-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <div class="space-y-2">
                <h2 class="text-lg font-bold text-slate-800">Panduan Pemanfaatan Fitur Portal</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Gunakan platform ini untuk memantau akumulasi kehadiran kelas, melihat hasil rekapitulasi penilaian ujian semester pada menu KHS, serta mengunduh berkas materi kuliah resmi yang diunggah oleh dosen pengampu.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection