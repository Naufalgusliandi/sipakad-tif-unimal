@extends('layouts.sipakad')

@section('title', 'Input Evaluasi Nilai')
@section('page_category', 'Aktivitas Academic')
@section('page_title', 'Rekapitulasi Komponen Penilaian')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md animate-fade-in">
        <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="mb-6">
    <a href="{{ route('dosen.nilai.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7M3 12h18"></path></svg>
        Kembali ke Filter
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="p-4 bg-slate-900/40 border border-slate-800 rounded-xl text-xs">
        <span class="text-slate-500 font-semibold uppercase tracking-wider block">Mata Kuliah Kurikulum</span>
        <span class="text-slate-200 font-bold text-sm block mt-1">{{ $mkSelected->nama_mk }}</span>
        <span class="text-purple-400 font-mono mt-0.5 block">{{ $mkSelected->kode_mk }} ({{ $mkSelected->sks }} SKS)</span>
    </div>
    <div class="p-4 bg-slate-900/40 border border-slate-800 rounded-xl text-xs">
        <span class="text-slate-500 font-semibold uppercase tracking-wider block">Kelas / Rombongan Belajar</span>
        <span class="text-slate-200 font-bold text-sm block mt-1">Kelas {{ $kelasSelected->nama_kelas }}</span>
        <span class="text-slate-400 mt-0.5 block">Semester: {{ $mkSelected->semester }}</span>
    </div>
    <div class="p-4 bg-gradient-to-br from-purple-950/20 to-indigo-950/20 border border-purple-500/10 rounded-xl text-xs flex items-center">
        <div>
            <span class="text-purple-400 font-bold uppercase tracking-wider block mb-1">Ketetapan Formula Otomatis (SIPAKAD)</span>
            <p class="text-slate-400 font-mono text-[10px] leading-relaxed">
                Nilai Akhir = (Tugas × 20%) + (Quiz × 15%) + (UTS × 30%) + (UAS × 35%)
            </p>
        </div>
    </div>
</div>

<form action="{{ route('dosen.nilai.store') }}" method="POST">
    @csrf
    <input type="hidden" name="page" value="{{ request('page', 1) }}">
    <input type="hidden" name="kelas_id" value="{{ $kelasSelected->id }}">
    <input type="hidden" name="mata_kuliah_id" value="{{ $mkSelected->id }}">

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-900/40 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                        <th class="px-6 py-4 w-1/4">Nama Mahasiswa</th>
                        <th class="px-6 py-4 text-center w-32">Tugas (20%)</th>
                        <th class="px-6 py-4 text-center w-32">Quiz (15%)</th>
                        <th class="px-6 py-4 text-center w-32">UTS (30%)</th>
                        <th class="px-6 py-4 text-center w-32">UAS (35%)</th>
                        <th class="px-6 py-4 text-center bg-purple-500/5 w-24">Akhir</th>
                        <th class="px-6 py-4 text-center bg-indigo-500/5 w-20">Huruf</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @forelse($mahasiswas as $mhs)
                        @php 
                            $currentNilai = $mhs->nilai->first(); 
                        @endphp
                        <tr class="hover:bg-slate-900/10 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-200 block">{{ $mhs->user->name }}</span>
                                <span class="text-xs font-mono text-slate-500 tracking-wider mt-0.5 block">{{ $mhs->nim }}</span>
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <input type="number" step="0.01" min="0" max="100" name="tugas[{{ $mhs->id }}]" value="{{ old('tugas.'.$mhs->id, $currentNilai->tugas ?? '') }}" placeholder="0" class="w-20 text-center bg-slate-950/50 border border-slate-800 rounded-lg px-2 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-purple-500 font-mono">
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <input type="number" step="0.01" min="0" max="100" name="quiz[{{ $mhs->id }}]" value="{{ old('quiz.'.$mhs->id, $currentNilai->quiz ?? '') }}" placeholder="0" class="w-20 text-center bg-slate-950/50 border border-slate-800 rounded-lg px-2 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-purple-500 font-mono">
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <input type="number" step="0.01" min="0" max="100" name="uts[{{ $mhs->id }}]" value="{{ old('uts.'.$mhs->id, $currentNilai->uts ?? '') }}" placeholder="0" class="w-20 text-center bg-slate-950/50 border border-slate-800 rounded-lg px-2 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-purple-500 font-mono">
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                <input type="number" step="0.01" min="0" max="100" name="uas[{{ $mhs->id }}]" value="{{ old('uas.'.$mhs->id, $currentNilai->uas ?? '') }}" placeholder="0" class="w-20 text-center bg-slate-950/50 border border-slate-800 rounded-lg px-2 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-purple-500 font-mono">
                            </td>

                            <td class="px-6 py-4 text-center bg-purple-500/5 font-bold text-slate-100 font-mono">
                                {{ $currentNilai ? number_format($currentNilai->nilai_akhir, 2) : '-' }}
                            </td>

                            <td class="px-6 py-4 text-center bg-indigo-500/5 font-bold">
                                @if($currentNilai)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ in_array($currentNilai->nilai_huruf, ['A','B+','B']) ? 'bg-emerald-500/10 text-emerald-400' : 'bg-amber-500/10 text-amber-400' }}">
                                        {{ $currentNilai->nilai_huruf }}
                                    </span>
                                @else
                                    <span class="text-slate-600">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                <span class="text-xs">Tidak ditemukan mahasiswa aktif di tingkat semester ini untuk diolah nilainya.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-6">
        {{ $mahasiswas->links() }}
    </div>

    @if($mahasiswas->count() > 0)
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('dosen.nilai.index') }}" class="px-5 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-xs font-semibold text-slate-400 hover:text-white transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-xs font-bold rounded-xl shadow-md hover:from-purple-500 hover:to-indigo-500 transition-all">
                Simpan & Hitung Nilai Akhir
            </button>
        </div>
    @endif
</form>
@endsection