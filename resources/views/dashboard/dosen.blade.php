@extends('layouts.sipakad')

@section('title', 'Dosen Dashboard')
@section('page_category', 'Portal Pengajar')
@section('page_title', 'Dashboard Dosen')

@section('content')
<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl p-8 rounded-2xl text-center max-w-2xl mx-auto mt-12">
    <div class="h-14 w-14 bg-purple-500/10 text-purple-400 border border-purple-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-purple-500/5">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 012 2v4a2 2 0 01-2 2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
    </div>
    <h3 class="text-lg font-bold text-white">Selamat Datang di Portal Dosen</h3>
    <p class="text-sm text-slate-400 mt-2 leading-relaxed">Melalui panel ini, Anda dapat mengelola presensi perkuliahan mahasiswa secara real-time, memberikan evaluasi nilai komponen, serta mendistribusikan berkas materi perkuliahan.</p>
</div>
@endsection