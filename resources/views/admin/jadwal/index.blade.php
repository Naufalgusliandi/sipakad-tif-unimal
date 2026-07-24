@extends('layouts.sipakad')

@section('title', 'Manajemen Jadwal')
@section('page_category', 'Master Data')
@section('page_title', 'Jadwal Perkuliahan Aktif')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.jadwal.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-600/15 hover:from-indigo-500 hover:to-blue-500 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7-7H5.5"></path></svg>
        Susun Jadwal Kuliah
    </a>
</div>

<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[700px] text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-900/40 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                    <th class="px-4 sm:px-6 py-3.5 sm:py-4">Waktu & Hari</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Mata Kuliah</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Kelas</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Ruangan</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Dosen Pengampu</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                @forelse($jadwals as $jadwal)
                    <tr class="hover:bg-slate-900/30 transition-colors group">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <span class="block font-bold text-slate-200">{{ $jadwal->hari }}</span>
                            <span class="text-xs text-slate-500 font-mono mt-0.5 block">
                                {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }} WIB
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <span class="font-semibold text-slate-200 group-hover:text-indigo-400 transition-colors block">{{ $jadwal->mataKuliah->nama_mk }}</span>
                            <span class="text-xs text-indigo-400 font-mono mt-0.5 block">{{ $jadwal->mataKuliah->kode_mk }} ({{ $jadwal->mataKuliah->sks }} SKS)</span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/10">
                                {{ $jadwal->kelas->nama_kelas }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-400 font-medium">
                            {{ $jadwal->ruangan->nama_ruangan }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-slate-400">
                            {{ $jadwal->dosen->user->name }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">
                            <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan jadwal kuliah ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-500 hover:text-rose-400 hover:bg-rose-500/5 rounded-lg transition-all" title="Hapus Jadwal">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"></path></svg>
                            <span class="text-xs">Belum ada agenda jadwal perkuliahan yang disusun untuk semester ini.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection