@extends('layouts.sipakad')

@section('title', 'Manajemen Ruangan')
@section('page_category', 'Master Data')
@section('page_title', 'Data Ruangan Kampus')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl p-6 h-fit">
        <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-4 pb-2 border-b border-slate-800/60">Tambah Ruangan</h3>
        
        <form action="{{ route('admin.ruangan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" required placeholder="Contoh: Lab AI, Ruang 102" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Lokasi / Gedung (Opsional)</label>
                <input type="text" name="lokasi" placeholder="Contoh: Gedung J Lt. 2" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>
            
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-xs font-semibold rounded-xl shadow-md shadow-indigo-600/10 hover:from-indigo-500 hover:to-blue-500 transition-all">
                Simpan Ruangan
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-900/40 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Ruangan</th>
                        <th class="px-6 py-4">Lokasi / Gedung</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    @forelse($ruangans as $ruang)
                        <tr class="hover:bg-slate-900/30 transition-colors group">
                            <td class="px-6 py-4 font-semibold text-slate-200 group-hover:text-indigo-400 transition-colors">
                                {{ $ruang->nama_ruangan }}
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                {{ $ruang->lokasi ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.ruangan.destroy', $ruang->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-500 hover:text-rose-400 hover:bg-rose-500/5 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                <span class="text-xs">Belum ada master data ruangan di dalam sistem.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($ruangans->hasPages())
            <div class="px-6 py-4 border-t border-slate-800 bg-slate-900/20">
                {{ $ruangans->links() }}
            </div>
        @endif
    </div>

</div>
@endsection