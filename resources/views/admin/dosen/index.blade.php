@extends('layouts.sipakad')

@section('title', 'Manajemen Dosen')
@section('page_category', 'Master Data')
@section('page_title', 'Data Dosen Pengajar')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <form action="{{ route('admin.dosen.index') }}" method="GET" class="w-full sm:w-96 relative">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau NIDN dosen..." class="w-full bg-slate-900/40 border border-slate-800 rounded-xl px-4 py-2.5 pl-10 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 backdrop-blur-sm transition-all">
        <div class="absolute left-3.5 top-3 text-slate-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
    </form>

    <a href="{{ route('admin.dosen.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl text-sm font-semibold shadow-lg shadow-indigo-600/15 hover:from-indigo-500 hover:to-purple-500 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7-7H5.5"></path></svg>
        Tambah Dosen
    </a>
</div>

<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-900/40 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                    <th class="px-4 sm:px-6 py-3.5 sm:py-4">Dosen Pengajar</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">NIDN</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4">Jabatan Akademik</th>
<th class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                @forelse($dosens as $dsn)
                    <tr class="hover:bg-slate-900/30 transition-colors group">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 flex items-center gap-3">
                            @if($dsn->foto)
                                <img src="{{ asset('storage/' . $dsn->foto) }}" class="h-10 w-10 rounded-xl object-cover border border-slate-700" alt="Foto">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($dsn->user->name) }}&background=8b5cf6&color=fff&bold=true" class="h-10 w-10 rounded-xl border border-slate-700" alt="Avatar">
                            @endif
                            <div>
                                <h4 class="font-semibold text-slate-200 group-hover:text-purple-400 transition-colors">{{ $dsn->user->name }}</h4>
                                <p class="text-xs text-slate-500">{{ $dsn->user->email }}</p>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 font-mono text-xs text-slate-400 tracking-wider">
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/10">
                                {{ $dsn->jabatan }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.dosen.destroy', $dsn->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan akun dosen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-500 hover:text-rose-400 hover:bg-rose-500/5 rounded-lg transition-all" title="Hapus Otoritas">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"></path></svg>
                            <span class="text-xs">Tidak ada data dosen yang terekam dalam database sistem.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($dosens->hasPages())
        <div class="px-6 py-4 border-t border-slate-800 bg-slate-900/20">
            {{ $dosens->links() }}
        </div>
    @endif
</div>
@endsection