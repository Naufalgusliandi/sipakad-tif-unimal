@extends('layouts.sipakad')

@section('title', 'Admin Dashboard')
@section('page_category', 'Ringkasan Eksekutif')
@section('page_title', 'Dashboard Utama')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
    
    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-4 sm:p-6 rounded-2xl relative overflow-hidden group hover:border-indigo-500/30 transition-all duration-300">
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

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-4 sm:p-6 rounded-2xl relative overflow-hidden group hover:border-purple-500/30 transition-all duration-300">
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

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-4 sm:p-6 rounded-2xl relative overflow-hidden group hover:border-blue-500/30 transition-all duration-300">
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

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-4 sm:p-6 rounded-2xl relative overflow-hidden group hover:border-emerald-500/30 transition-all duration-300">
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <div class="lg:col-span-2 bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-4 sm:p-6 rounded-2xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 sm:gap-0 mb-4">
            <h4 class="text-sm font-semibold text-slate-300 tracking-wide">Rekapitulasi Status Presensi Mahasiswa</h4>
            <span class="text-[10px] bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold px-2.5 py-1 rounded-full uppercase">Data Realtime</span>
        </div>
        <div class="h-64 relative">
            <canvas id="chartPresensiAdmin"></canvas>
        </div>
    </div>
    
    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-4 sm:p-6 rounded-2xl">
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
<!-- INJEKSI LIBRARY CHART.JS VIA CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('chartPresensiAdmin').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar', // Menggunakan Bar Chart agar akurat menampilkan jumlah per status
            data: {
                labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [
                        {{ $stats['chart_hadir'] }}, 
                        {{ $stats['chart_izin'] }}, 
                        {{ $stats['chart_sakit'] }}, 
                        {{ $stats['chart_alpa'] }}
                    ],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.85)', // Emerald (Hadir)
                        'rgba(59, 130, 246, 0.85)', // Blue (Izin)
                        'rgba(245, 158, 11, 0.85)', // Amber (Sakit)
                        'rgba(239, 68, 68, 0.85)'   // Rose/Red (Alpa)
                    ],
                    borderRadius: 8,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        ticks: { color: '#94a3b8' },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { 
                            color: '#94a3b8',
                            precision: 0,
                            stepSize: 1 // Angka bulat (0, 1, 2, 3...) sesuai jumlah riil mahasiswa
                        },
                        grid: { color: 'rgba(51, 65, 85, 0.2)' }
                    }
                }
            }
        });
    });
</script>
@endsection