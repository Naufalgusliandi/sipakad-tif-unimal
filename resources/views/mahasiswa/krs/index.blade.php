@extends('layouts.sipakad')

@section('title', 'Kontrak KRS Manual')
@section('page_category', 'Panel Mahasiswa')
@section('page_title', 'Kartu Rencana Studi (KRS)')

@section('content')
<div class="space-y-8" main>
    
    <!-- BANNER MEKANISME -->
    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-200 p-4 sm:p-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4 text-center md:text-left flex-col md:flex-row">
            <div class="p-3 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.381-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Mekanisme Pengisian KRS</h3>
                <p class="text-xs text-slate-500 mt-0.5">Silakan pilih mata kuliah yang tersedia di bawah ini sesuai dengan beban skema semester aktif Anda saat ini.</p>
            </div>
        </div>
        <div class="px-4 py-2 bg-amber-500 text-emerald-950 font-bold text-xs rounded-xl shadow-sm tracking-wide uppercase">
            Semester {{ auth()->user()->mahasiswa->semester ?? '-' }}
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-800 rounded-2xl text-sm flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <!-- TABEL 1: MATA KULIAH YANG SUDAH DIAMBIL -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-900/5 overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-slate-100 bg-emerald-50/40 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-4">
    <div>
        <h4 class="text-sm font-bold text-emerald-900 uppercase tracking-wider">Mata Kuliah Yang Sudah Diambil (KRS Aktif)</h4>
        <p class="text-xs text-slate-400 mt-0.5">Daftar kurikulum kelas yang berhasil Anda amankan di semester ini.</p>
    </div>
    <!-- Tombol Cetak KRS Digital -->
    <button onclick="window.print()" class="w-full sm:w-auto px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow-md flex items-center justify-center gap-2">
        Cetak Lembar KRS
    </button>
</div>

        <div class="overflow-x-auto print-area">
            <table class="w-full min-w-[650px] text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-4 sm:px-6 py-3.5 sm:py-4 w-20">No</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 w-32">Kode MK</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Nama Mata Kuliah</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center w-24">SKS</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center w-28">Semester</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center w-40 print-hide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php $has_ambil = false; $no_ambil = 1; @endphp
                    @foreach($matakuliah_tersedia as $mk)
                        @if(in_array($mk->id, $id_mk_diambil))
                            @php $has_ambil = true; @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors bg-emerald-50/10">
                                <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-semibold text-slate-900 font-mono">{{ $no_ambil++ }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-bold text-emerald-800 font-mono uppercase tracking-wide">{{ $mk->kode_mk }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-bold text-slate-900">{{ $mk->nama_mk }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-extrabold text-slate-900 text-center font-mono">{{ $mk->sks }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-semibold text-slate-900 text-center font-mono">Tk. {{ $mk->semester }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center print-hide">
                                    <form method="POST" action="{{ route('mahasiswa.krs.batal', $mk->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs rounded-xl transition-all shadow-sm transform active:scale-95">
                                            Batalkan Kontrak
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if(!$has_ambil)
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm font-medium text-slate-400">
                                Anda belum mengambil mata kuliah apa pun untuk semester ini.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABEL 2: DAFTAR PILIHAN MATA KULIAH YANG BELUM DIAMBIL -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-xl shadow-slate-900/5 overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-slate-100 bg-slate-50/50">
            <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Mata Kuliah Yang Belum Diambil (Ditawarkan)</h4>
            <p class="text-xs text-slate-400 mt-0.5">Silakan pilih kelas kurikulum di bawah ini untuk mengisi beban akademik Anda.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[650px] text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100/70 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-4 sm:px-6 py-3.5 sm:py-4 w-20">No</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 w-32">Kode MK</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Nama Mata Kuliah</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center w-24">SKS</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center w-28">Semester</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center w-40">Status Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php $no_tawar = 1; @endphp
                    @forelse($matakuliah_tersedia as $mk)
                        @if(!in_array($mk->id, $id_mk_diambil))
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-semibold text-slate-900 font-mono">{{ $no_tawar++ }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-bold text-slate-800 font-mono uppercase tracking-wide">{{ $mk->kode_mk }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-bold text-slate-900">{{ $mk->nama_mk }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-extrabold text-slate-900 text-center font-mono">{{ $mk->sks }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-sm font-semibold text-slate-900 text-center font-mono">Tk. {{ $mk->semester }}</td>
<td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                                    <form method="POST" action="{{ route('mahasiswa.krs.ambil', $mk->id) }}">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all shadow-md transform active:scale-95" style="background: linear-gradient(135deg, #047857, #059669) !important; color: #ffffff !important; border:none !important;">
                                            Ambil Kelas
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm font-medium text-slate-400">
                                Belum ada daftar kurikulum mata kuliah yang dibuka untuk tingkat semester Anda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
@media print {
    /* Sembunyikan elemen navigasi dan tabel penawaran di kertas hasil cetakan */
    aside, 
    nav, 
    header,
    .bg-white overflow-hidden shadow-sm, 
    .bg-slate-50\/50 button, 
    .print-hide { 
        display: none !important; 
    }
    
    /* Sembunyikan tabel kedua (Mata Kuliah Belum Diambil) agar tidak mengotori kertas */
    .bg-white:has(.bg-slate-50\/50) ~ .bg-white {
        display: none !important;
    }
    
    /* Melebarkan area tabel KRS aktif secara presisi */
    .print-area { 
        position: absolute !important; 
        left: 0 !important; 
        top: 0 !important; 
        width: 100% !important; 
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection