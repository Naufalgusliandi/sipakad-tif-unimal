@extends('layouts.sipakad')

@section('title', 'Kelola Materi')
@section('page_category', 'Portal Pengajar')
@section('page_title', 'Manajemen Materi Kuliah')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="flex justify-end mb-6">
    <a href="{{ route('dosen.materi.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-600/15 hover:from-indigo-500 hover:to-purple-500 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7-7H5.5"></path></svg>
        Unggah Berkas Materi
    </a>
</div>

<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[650px] text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-900/40 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                    <th class="px-4 sm:px-6 py-3.5 sm:py-4">Judul Materi & Deskripsi</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Mata Kuliah</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">Kelas</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">File</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                @forelse($materis as $materi)
                    <tr class="hover:bg-slate-900/30 transition-colors group">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <span class="font-semibold text-slate-200 group-hover:text-indigo-400 transition-colors block">{{ $materi->judul }}</span>
                            <span class="text-xs text-slate-500 block mt-1 max-w-md truncate">{{ $materi->deskripsi ?? 'Tidak ada deskripsi' }}</span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <span class="font-medium text-slate-300 block">{{ $materi->mataKuliah->nama_mk }}</span>
                            <span class="text-xs text-slate-500 font-mono mt-0.5 block">{{ $materi->mataKuliah->kode_mk }}</span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/10">
                                {{ $materi->kelas->nama_kelas }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-center">
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-indigo-400 hover:underline font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                                Lihat Dokumen
                            </a>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">
                            <form action="{{ route('dosen.materi.destroy', $materi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi kuliah ini? File fisik di server akan dihapus permanen.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-500 hover:text-rose-400 hover:bg-rose-500/5 rounded-lg transition-all" title="Hapus Berkas">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18"></path></svg>
                            <span class="text-xs">Anda belum pernah mengunggah materi berkas kuliah di sistem ini.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($materis->hasPages())
        <div class="px-6 py-4 border-t border-slate-800 bg-slate-900/20">
            {{ $materis->links() }}
        </div>
    @endif
</div>
@endsection