@extends('layouts.sipakad')

@section('title', 'Unduh Materi')
@section('page_category', 'Portal Akademik')
@section('page_title', 'Repositori Materi Kuliah')

@section('content')

@if (session('info'))
    <div class="mb-6 p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl text-sm flex items-center gap-3 shadow-sm">
        <svg class="w-5 h-5 shrink-0 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <span class="font-medium">{{ session('info') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($materis as $materi)
        <div class="bg-white border border-slate-200 rounded-2xl p-6 flex flex-col justify-between hover:border-emerald-500/40 hover:shadow-lg hover:shadow-slate-100 transition-all duration-300 relative group overflow-hidden shadow-sm">
            
            <div>
                <div class="flex flex-col gap-1 mb-3">
                    <!-- PERBAIKAN: Menampilkan Kode MK dan Nama MK Lengkap di Atas Kartu Materi -->
                    <span class="text-[10px] font-bold uppercase px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200 tracking-wider self-start line-clamp-1">
                        {{ $materi->mataKuliah->kode_mk }} - {{ $materi->mataKuliah->nama_mk }}
                    </span>
                    <span class="text-[11px] font-medium text-slate-400 mt-1">
                        {{ $materi->created_at->diffForHumans() }}
                    </span>
                </div>

                <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition-colors line-clamp-2 mb-2">
                    {{ $materi->judul }}
                </h4>
                <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-4">
                    {{ $materi->deskripsi ?? 'Tidak ada deskripsi tambahan dari pengampu.' }}
                </p>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-2">
                <div class="flex items-center gap-2 overflow-hidden mr-2">
                    <div class="h-7 w-7 rounded-lg bg-slate-100 flex items-center justify-center text-[10px] text-slate-600 font-bold uppercase shrink-0 border border-slate-200">
                        {{ substr($materi->dosen->user->name, 0, 2) }}
                    </div>
                    <span class="text-xs font-semibold text-slate-600 truncate" title="{{ $materi->dosen->user->name }}">
                        {{ $materi->dosen->user->name }}
                    </span>
                </div>

                <a href="{{ asset('storage/' . $materi->file_path) }}" download class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold rounded-xl hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all shadow-sm shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                    </svg>
                    Unduh
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-1 md:col-span-2 lg:col-span-3 p-12 bg-white border border-dashed border-slate-300 text-center rounded-2xl shadow-sm flex flex-col items-center justify-center">
            <div class="h-12 w-12 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center mb-3 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18"></path>
                </svg>
            </div>
            <h5 class="text-sm font-bold text-slate-700 mb-1">Repositori Kosong</h5>
            <p class="text-xs text-slate-400 max-w-sm mx-auto leading-relaxed">Belum ada dokumen berkas materi kuliah yang didistribusikan untuk semester akademik Anda saat ini.</p>
        </div>
    @endforelse
</div>
<div class="mt-6">
    {{ $materis->links() }}
</div>
@endsection