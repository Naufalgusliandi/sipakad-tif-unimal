@extends('layouts.sipakad')

@section('title', 'Kelola Presensi')
@section('page_category', 'Aktivitas Akademik')
@section('page_title', 'Presensi Perkuliahan')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="max-w-2xl bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl p-8">
    <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-6 pb-2 border-b border-slate-800/60 flex items-center gap-2">
        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"></path></svg>
        Filter Kelas Perkuliahan
    </h3>

    <form action="{{ route('dosen.absensi.create') }}" method="GET" class="space-y-5">
        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Rombongan Belajar / Kelas</label>
            <select name="kelas_id" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                <option value="" class="bg-slate-900 text-slate-500">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" class="bg-slate-900 text-slate-300">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Mata Kuliah Kurikulum</label>
            <select name="mata_kuliah_id" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                <option value="" class="bg-slate-900 text-slate-500">-- Pilih Mata Kuliah --</option>
                @foreach($mata_kuliah as $mk)
                    <option value="{{ $mk->id }}" class="bg-slate-900 text-slate-300">[{{ $mk->kode_mk }}] - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pertemuan Ke-</label>
            <select name="pertemuan_ke" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                @for($i = 1; $i <= 16; $i++)
                    <option value="{{ $i }}" class="bg-slate-900 text-slate-300">Pertemuan {{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/15 hover:from-indigo-500 hover:to-purple-500 transition-all tracking-wide uppercase">
            Buka Lembar Presensi
        </button>
    </form>
</div>
@endsection