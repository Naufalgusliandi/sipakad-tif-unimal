@extends('layouts.sipakad')

@section('title', 'Kelola Nilai')
@section('page_category', 'Aktivitas Akademik')
@section('page_title', 'Evaluasi Nilai Mahasiswa')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="max-w-2xl bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl p-8">
    <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-6 pb-2 border-b border-slate-800/60 flex items-center gap-2">
        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002-2V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 16.114l-2.093-2.094m0 0l-2.093 2.093m2.093-2.093v4.75"></path></svg>
        Filter Lembar Penilaian
    </h3>

    <form action="{{ route('dosen.nilai.create') }}" method="GET" class="space-y-5">
        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kelas / Rombongan Belajar</label>
            <select name="kelas_id" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                <option value="" class="bg-slate-900 text-slate-500">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" class="bg-slate-900 text-slate-300">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Mata Kuliah Yang Diampu</label>
            <select name="mata_kuliah_id" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                <option value="" class="bg-slate-900 text-slate-500">-- Pilih Mata Kuliah --</option>
                @foreach($mata_kuliah as $mk)
                    <option value="{{ $mk->id }}" class="bg-slate-900 text-slate-300">[{{ $mk->kode_mk }}] - {{ $mk->nama_mk }} (Sem {{ $mk->semester }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-xs font-bold rounded-xl shadow-lg shadow-purple-600/15 hover:from-purple-500 hover:to-indigo-500 transition-all tracking-wide uppercase">
            Buka Lembar Evaluasi Nilai
        </button>
    </form>
</div>
@endsection