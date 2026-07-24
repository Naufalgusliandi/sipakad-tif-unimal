@extends('layouts.sipakad')
@section('title', 'KHS Mahasiswa')
@section('page_category', 'Portal Akademik')
@section('page_title', 'Kartu Hasil Studi (KHS)')

@section('content')
<div class="space-y-6">
    
    <!-- TOMBOL CETAK -->
    <div class="flex justify-end print-hide">
    <button onclick="window.print()" class="w-full sm:w-auto px-5 py-2.5 text-white font-bold text-xs rounded-xl shadow-md flex items-center justify-center gap-2 transition-all transform active:scale-95 hover:shadow-lg" style="background: linear-gradient(135deg, #047857, #059669) !important; color: #ffffff !important; border: none !important;">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03$.48.062$.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.617 0-1.11-.51-1.07-1.122L6.34 18m11.32 0h-11.32M9 10.5h.008v.008H9V10.5zm3 0h.008v.008H12V10.5zm3 0h.008v.008H15V10.5z"></path>
            </svg>
            <span style="color: #ffffff !important;">Cetak KHS</span>
        </button>
    </div>

    <!-- AREA DOKUMEN UTAMA KHS -->
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm print-target p-2">
        
        <!-- HEADER KAMPUS SAAT DI PRINT -->
        <div class="hidden print-header p-6 border-b border-slate-300 text-center mb-6">
            <h2 class="text-xl font-extrabold text-slate-900 uppercase">UNIVERSITAS MALIKUSSALEH</h2>
            <h3 class="text-base font-bold text-slate-700 uppercase">FAKULTAS TEKNIK - TEKNIK INFORMATIKA</h3>
            <p class="text-xs text-slate-400 font-mono mt-1">Sistem Informasi Akademik Terpadu (SIPAKAD)</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <th class="px-4 sm:px-6 py-3.5 sm:py-4">Mata Kuliah</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Tugas</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Quiz</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">UTS</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">UAS</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center bg-emerald-50 text-emerald-800">Nilai Akhir</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center bg-amber-50 text-amber-800">Huruf</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($nilais as $nilai)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                                <span class="font-bold text-slate-900 block">{{ $nilai->mataKuliah->nama_mk }}</span>
                                <span class="text-xs font-mono text-slate-400 mt-0.5 block">{{ $nilai->mataKuliah->kode_mk }} ({{ $nilai->mataKuliah->sks }} SKS)</span>
                            </td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-mono text-xs">{{ number_format($nilai->tugas, 1) }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-mono text-xs">{{ number_format($nilai->quiz, 1) }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-mono text-xs">{{ number_format($nilai->uts, 1) }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-mono text-xs">{{ number_format($nilai->uas, 1) }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center bg-emerald-50/40 font-bold font-mono text-emerald-700">{{ number_format(($nilai->tugas*0.2)+($nilai->quiz*0.15)+($nilai->uts*0.3)+($nilai->uas*0.35), 2) }}</td>
                            <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center bg-amber-50/40 font-extrabold text-amber-700">
                                @php $na = ($nilai->tugas*0.2)+($nilai->quiz*0.15)+($nilai->uts*0.3)+($nilai->uas*0.35); @endphp
                                {{ $na >= 85 ? 'A' : ($na >= 78 ? 'B+' : ($na >= 70 ? 'B' : ($na >= 63 ? 'C+' : ($na >= 55 ? 'C' : ($na >= 40 ? 'D' : 'E'))))) }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-6 py-12 text-center text-slate-400 text-xs">Belum ada komponen nilai resmi yang dipublikasikan oleh dosen pengampu.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- RINGKASAN IPK DI BAWAH HALAMAN KHS -->
        <div class="p-4 sm:p-6 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-4 rounded-xl">
    <div class="text-xs text-slate-500">
        * IPK dihitung berdasarkan akumulasi seluruh bobot nilai matakuliah kurikulum yang sah.
    </div>
    <div class="flex items-center justify-between w-full sm:w-auto gap-4">
        <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Indeks Prestasi Kumulatif (IPK):</span>
        <span class="text-xl font-black text-indigo-600 font-mono bg-indigo-50 px-4 py-1.5 border border-indigo-200 rounded-xl shadow-inner">
            {{ $ipk ?? '0.00' }}
        </span>
    </div>
</div>
    </div>
</div>

<style>
@media print {
    /* Elemen-elemen ini HANYA akan menghilang SAAT tombol cetak diklik (di kertas PDF) */
    aside, 
    nav, 
    h1, 
    header,
    .flex.justify-end,
    #sidebar-menu { 
        display: none !important; 
    }
    
    /* Dokumen KHS otomatis melebar penuh mengisi kertas A4 portrait */
    .print-target { 
        position: absolute !important; 
        left: 0 !important; 
        top: 0 !important; 
        width: 100% !important; 
        border: none !important; 
        box-shadow: none !important;
        padding: 0 !important;
    }
    
    /* Kop Surat Resmi Universitas Malikussaleh otomatis muncul di draf PDF */
    .print-header { 
        display: block !important; 
    }
}
</style>
@endsection