@extends('layouts.sipakad')
@section('title', 'Presensi Mahasiswa')
@section('page_category', 'Portal Academic')
@section('page_title', 'Rekapitulasi Kehadiran Kuliah')

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">   
        <table class="w-full min-w-[600px] text-left border-collapse">
        <thead>
            <tr class="border-b border-slate-200 bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                <th class="px-4 sm:px-6 py-3.5 sm:py-4">Mata Kuliah Kulikulum</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Pertemuan</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Waktu Presensi</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Status Kehadiran</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
            @forelse($absensis as $absen)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                        <span class="font-bold text-slate-900 block">{{ $absen->mataKuliah->nama_mk }}</span>
                    </td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center font-bold text-slate-600">Pertemuan Ke-{{ $absen->pertemuan_ke }}</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center text-xs font-mono text-slate-500">{{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d M Y') }} | {{ substr($absen->jam, 0, 5) }} WIB</td>
                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold 
                            {{ $absen->status === 'Hadir' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($absen->status === 'Izin' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                            {{ $absen->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-12 text-center text-slate-400 text-xs">Belum ada rekapitulasi absensi kelas yang diinput oleh dosen pengajar.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection