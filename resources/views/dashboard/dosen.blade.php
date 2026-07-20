@extends('layouts.sipakad')

@section('title', 'Dashboard Dosen')

@section('content')
<div class="space-y-6">

    <!-- HERO HEADER (Aksen Emerald-Teal Gradient) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-teal-950 border border-slate-800 text-white p-8 shadow-xl">
        <!-- Ambient Light Effect -->
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -top-12 w-48 h-48 bg-teal-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-3xl font-extrabold text-white shadow-lg shadow-emerald-950/50 shrink-0 border border-emerald-400/30">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                        <span class="text-[10px] font-bold uppercase tracking-widest bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-3 py-0.5 rounded-full">
                            Portal Akademik Dosen
                        </span>
                        <span class="text-xs text-slate-300 font-mono bg-slate-800/80 px-3 py-0.5 rounded-full border border-slate-700/80">
                            NIDN: {{ $dosen->nidn ?? '-' }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-white mt-1">
                        Selamat Datang, {{ auth()->user()->name }}
                    </h1>

                    <p class="text-slate-300 text-xs sm:text-sm mt-1 font-medium">
                        Program Studi Teknik Informatika • Universitas Malikussaleh
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- RINGKASAN METRIK & GRAFIK -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- KOLOM KIRI: 4 KARTU STATISTIK -->
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-5">
            
            <!-- Card 1: Mata Kuliah (Indigo) -->
            <div class="bg-white border-l-4 border-l-indigo-600 border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Mata Kuliah</p>
                    <span class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </span>
                </div>
                <div class="flex items-baseline gap-2 mt-3">
                    <h2 class="text-3xl font-extrabold text-slate-900">{{ $stats['total_jadwal'] ?? 0 }}</h2>
                    <span class="text-xs text-slate-500 font-medium">Kelas Aktif</span>
                </div>
            </div>

            <!-- Card 2: Materi (Sky) -->
            <div class="bg-white border-l-4 border-l-sky-500 border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Modul & Materi</p>
                    <span class="p-2 rounded-xl bg-sky-50 text-sky-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                    </span>
                </div>
                <div class="flex items-baseline gap-2 mt-3">
                    <h2 class="text-3xl font-extrabold text-slate-900">{{ $stats['total_materi'] ?? 0 }}</h2>
                    <span class="text-xs text-slate-500 font-medium">Berkas</span>
                </div>
            </div>

            <!-- Card 3: Rekap Presensi (Teal) -->
            <div class="bg-white border-l-4 border-l-teal-500 border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Rekap Presensi</p>
                    <span class="p-2 rounded-xl bg-teal-50 text-teal-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                </div>
                <div class="flex items-baseline gap-2 mt-3">
                    <h2 class="text-3xl font-extrabold text-slate-900">{{ $stats['total_absensi'] ?? 0 }}</h2>
                    <span class="text-xs text-slate-500 font-medium">Sesi</span>
                </div>
            </div>

            <!-- Card 4: Status (Emerald-Teal Gradient) -->
            <div class="bg-gradient-to-br from-emerald-800 to-teal-900 text-white border border-emerald-700/80 rounded-2xl p-6 shadow-md flex flex-col justify-between">
                <p class="text-emerald-200 text-xs font-bold uppercase tracking-wider">Status Akademik</p>
                <div class="mt-3">
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Dosen Aktif
                    </h2>
                    <p class="text-xs text-emerald-300/80 mt-1">Semester Genap 2025/2026</p>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: WIDGET GRAFIK KEHADIRAN -->
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-900">Sesi Mengajar</h3>
                    <span class="text-[10px] font-bold bg-teal-50 text-teal-700 px-2.5 py-0.5 rounded-full border border-teal-200">
                        Grafik Sesi
                    </span>
                </div>
                <p class="text-slate-500 text-xs mt-0.5">Persentase aktivitas absensi perkuliahan</p>
            </div>
            <div class="relative h-40 mt-4 flex items-center justify-center">
                <canvas id="dosenChart"></canvas>
            </div>
        </div>

    </div>

    <!-- JADWAL PERKULIAHAN -->
    <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
        <div class="px-8 py-6 bg-slate-50/60 border-b border-slate-200/80 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Jadwal Perkuliahan
                </h2>
                <p class="text-slate-500 text-xs mt-0.5">
                    Daftar kelas yang sedang Anda ampu pada semester berjalan.
                </p>
            </div>
            <span class="text-xs font-mono bg-white text-slate-700 px-3 py-1 rounded-full border border-slate-200 shadow-sm">
                Semester Genap 2025/2026
            </span>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($jadwals as $j)
            <div class="flex flex-col lg:flex-row lg:items-center justify-between p-6 hover:bg-slate-50/80 transition-colors gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-base text-slate-900">
                            {{ $j->mataKuliah->nama_mk }}
                        </h3>
                        <span class="px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200/80">
                            {{ $j->kelas->nama_kelas }}
                        </span>
                    </div>

                    <p class="text-slate-500 text-xs font-mono mt-1">
                        {{ $j->mataKuliah->kode_mk }} • {{ $j->mataKuliah->sks }} SKS
                    </p>
                </div>

                <div class="text-xs font-mono text-slate-600 lg:text-center">
                    <span class="font-bold text-slate-900 bg-slate-100 px-2.5 py-1 rounded-md border border-slate-200/60 inline-block mb-1">{{ $j->hari }}</span>
                    <br>
                    <span class="text-slate-500">{{ $j->jam_mulai }} - {{ $j->jam_selesai }} WIB</span>
                </div>

                <div class="lg:text-center">
                    <span class="px-3 py-1.5 rounded-lg bg-teal-50/60 text-teal-900 border border-teal-200/70 font-semibold text-xs">
                        Ruang {{ $j->ruangan->nama_ruangan }}
                    </span>
                </div>
            </div>
            @empty
            <div class="py-16 text-center">
                <h3 class="text-base font-bold text-slate-700">
                    Belum Ada Jadwal Perkuliahan
                </h3>
                <p class="text-slate-500 text-xs mt-1">
                    Jadwal mengajar akan muncul setelah dialokasikan oleh Program Studi.
                </p>
            </div>
            @endforelse
        </div>
    </div>

</div>

<!-- SCRIPT CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('dosenChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sesi Terlaksana', 'Sesi Tersisa'],
                datasets: [{
                    data: [{{ $stats['total_absensi'] ?? 0 }}, Math.max(16 - ({{ $stats['total_absensi'] ?? 0 }} % 16), 0)],
                    backgroundColor: ['#0d9488', '#e2e8f0'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            font: { size: 11 }
                        }
                    }
                },
                cutout: '72%'
            }
        });
    });
</script>
@endsection