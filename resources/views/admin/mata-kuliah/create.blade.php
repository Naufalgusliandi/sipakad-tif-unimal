@extends('layouts.sipakad')

@section('title', 'Tambah Mata Kuliah')
@section('page_category', 'Master Data')
@section('page_title', 'Registrasi Mata Kuliah Baru')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.mata-kuliah.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7M3 12h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl p-4 sm:p-8 w-full max-w-4xl">
    
    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs space-y-1">
            <p class="font-bold">Gagal memproses data! Silakan koreksi kembali form berikut:</p>
            <ul class="list-disc list-inside opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mata-kuliah.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kode Mata Kuliah</label>
                <input type="text" name="kode_mk" value="{{ old('kode_mk') }}" required placeholder="Contoh: IF3112" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all font-mono">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" value="{{ old('nama_mk') }}" required placeholder="Contoh: Pemrograman Berorientasi Objek" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Bobot SKS</label>
                <select name="sks" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                    @for($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" class="bg-slate-900" {{ old('sks') == $i ? 'selected' : '' }}>{{ $i }} SKS</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Semester Kurikulum</label>
                <select name="semester" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" class="bg-slate-900" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="flex flex-col-reverse sm:flex-row items-center sm:justify-end gap-3 pt-4 border-t border-slate-800/60">
    <a href="{{ route('admin.mata-kuliah.index') }}" class="w-full sm:w-auto text-center px-5 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-xs font-semibold text-slate-400 hover:text-white transition-colors">Batal</a>
    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-xs font-semibold rounded-xl shadow-md shadow-indigo-600/10 hover:from-indigo-500 hover:to-blue-500 transition-all">Simpan Mata Kuliah</button>
</div>
    </form>
</div>
@endsection