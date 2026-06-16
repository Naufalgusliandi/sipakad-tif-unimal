@extends('layouts.sipakad')

@section('title', 'Admin Dashboard')
@section('page_category', 'Ringkasan Eksekutif')
@section('page_title', 'Dashboard Utama')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-6 rounded-2xl relative overflow-hidden group hover:border-indigo-500/30 transition-all duration-300">
        <div class="absolute -right-3 -bottom-3 text-slate-800/20 group-hover:text-indigo-500/5 group-hover:scale-110 transition-all duration-300">
            <svg class="w-32 h-32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Mahasiswa</p>
            <div class="p-2 bg-indigo-500/10 text-indigo-400 rounded-xl border border-indigo-500/20 text-xs font-semibold">MHS</div>
        </div>
        <h3 class="text-3xl font-bold mt-4 text-white tracking-tight">{{ $stats['total_mahasiswa'] }}</h3>
        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
            <span class="text-indigo-400 font-medium">Aktif</span> Terdata di Sistem
        </p>
    </div>

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-6 rounded-2xl relative overflow-hidden group hover:border-purple-500/30 transition-all duration-300">
        <div class="absolute -right-3 -bottom-3 text-slate-800/20 group-hover:text-purple-500/5 group-hover:scale-110 transition-all duration-300">
            <svg class="w-32 h-32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v4a2 2 0 01-2 2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Dosen</p>
            <div class="p-2 bg-purple-500/10 text-purple-400 rounded-xl border border-purple-500/20 text-xs font-semibold">DSN</div>
        </div>
        <h3 class="text-3xl font-bold mt-4 text-white tracking-tight">{{ $stats['total_dosen'] }}</h3>
        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
            <span class="text-purple-400 font-medium">Staf Pengajar</span> TI Unimal
        </p>
    </div>

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-6 rounded-2xl relative overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
        <div class="absolute -right-3 -bottom-3 text-slate-800/20 group-hover:text-blue-500/5 group-hover:scale-110 transition-all duration-300">
            <svg class="w-32 h-32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Mata Kuliah</p>
            <div class="p-2 bg-blue-500/10 text-blue-400 rounded-xl border border-blue-500/20 text-xs font-semibold">MK</div>
        </div>
        <h3 class="text-3xl font-bold mt-4 text-white tracking-tight">{{ $stats['total_mata_kuliah'] }}</h3>
        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
            <span class="text-blue-400 font-medium">Kurikulum</span> Terintegrasi
        </p>
    </div>

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-6 rounded-2xl relative overflow-hidden group hover:border-emerald-500/30 transition-all duration-300">
        <div class="absolute -right-3 -bottom-3 text-slate-800/20 group-hover:text-emerald-500/5 group-hover:scale-110 transition-all duration-300">
            <svg class="w-32 h-32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
        </div>
        <div class="flex items-center justify-between">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kehadiran Hari Ini</p>
            <div class="p-2 bg-emerald-500/10 text-emerald-400 rounded-xl border border-emerald-500/20 text-xs font-semibold">LIVE</div>
        </div>
        <h3 class="text-3xl font-bold mt-4 text-emerald-400 tracking-tight">{{ $stats['kehadiran_hari_ini'] }}</h3>
        <p class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
            <span class="text-emerald-400 font-medium">Presensi</span> Real-time Perkuliahan
        </p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-6 rounded-2xl">
        <h4 class="text-sm font-semibold text-slate-300 mb-4 tracking-wide">Grafik Trend Presensi Kuliah</h4>
        <div class="h-64 flex flex-col items-center justify-center border border-dashed border-slate-800/80 rounded-xl text-slate-500">
            <svg class="w-8 h-8 mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            <span class="text-xs font-medium">Analisis Chart.js Akan Diintegrasikan pada Tahap 10</span>
        </div>
    </div>
    
    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-6 rounded-2xl">
        <h4 class="text-sm font-semibold text-slate-300 mb-4 tracking-wide">Pengumuman Terbaru</h4>
        <div class="space-y-4">
            <div class="p-3.5 bg-slate-900/40 border border-slate-800 rounded-xl">
                <span class="text-[10px] bg-indigo-500/10 text-indigo-400 px-2 py-0.5 rounded border border-indigo-500/20 font-bold uppercase tracking-wider">Akademik</span>
                <h5 class="text-xs font-semibold text-slate-200 mt-1.5">Persiapan Pengisian KRS Semester Genap</h5>
                <p class="text-[11px] text-slate-500 mt-1">Dihimbau kepada seluruh mahasiswa...</p>
            </div>
        </div>
    </div>
</div>
@endsection