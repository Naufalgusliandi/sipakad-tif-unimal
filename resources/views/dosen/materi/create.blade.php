@extends('layouts.sipakad')

@section('title', 'Unggah Berkas Materi')
@section('page_category', 'Portal Pengajar')
@section('page_title', 'Publikasi Berkas Kuliah')

@section('content')
<div class="mb-6">
    <a href="{{ route('dosen.materi.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7M3 12h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl p-8 max-w-4xl">
    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs space-y-1">
            <p class="font-bold">Gagal memproses berkas! Silakan koreksi form berikut:</p>
            <ul class="list-disc list-inside opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dosen.materi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Mata Kuliah</label>
                <select name="mata_kuliah_id" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                    <option value="" class="bg-slate-900 text-slate-500">-- Pilih Mata Kuliah --</option>
                    @foreach($mata_kuliah as $mk)
                        <option value="{{ $mk->id }}" class="bg-slate-900 text-slate-300">[{{ $mk->kode_mk }}] - {{ $mk->nama_mk }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Kelas Distribusi</label>
                <select name="kelas_id" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                    <option value="" class="bg-slate-900 text-slate-500">-- Pilih Kelas Target --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" class="bg-slate-900 text-slate-300">Kelas {{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Judul Materi Pembelajaran</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Pertemuan 3 - Arsitektur Neural Network" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Ringkasan / Deskripsi Tugas (Opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Berikan instruksi tambahan atau resume materi di sini..." class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all resize-none">{{ old('deskripsi') }}</textarea>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Berkas Dokumen Kuliah</label>
            <div class="border-2 border-dashed border-slate-800 rounded-xl p-6 text-center hover:border-slate-700 transition-colors relative bg-slate-950/10">
                <input type="file" name="file_materi" id="file-materi-input" required accept=".pdf,.ppt,.pptx,.doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                
                <div class="space-y-1" id="placeholder-text">
                    <svg class="mx-auto h-8 w-8 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"></path></svg>
                    <div class="text-sm text-slate-400">
                        <span class="text-indigo-400 font-semibold">Pilih file dokumen</span> atau seret dokumen ke sini
                    </div>
                    <p class="text-xs text-slate-500 font-medium">Mendukung Format: PDF, PPT, PPTX, DOC, DOCX (Maksimal 10MB)</p>
                </div>
                
                <div id="file-name-container" class="hidden flex flex-col items-center gap-1.5">
                    <div class="p-2.5 bg-indigo-500/10 text-indigo-400 rounded-xl border border-indigo-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                    </div>
                    <span id="file-name-text" class="text-xs font-semibold text-slate-200 truncate max-w-xs">Nama_File.pdf</span>
                    <button type="button" id="change-file" class="text-[11px] text-rose-400 hover:underline z-20 relative">Ganti Dokumen</button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-800/60">
            <a href="{{ route('dosen.materi.index') }}" class="px-5 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-xs font-semibold text-slate-400 hover:text-white transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-semibold rounded-xl shadow-md">Publikasikan Materi</button>
        </div>
    </form>
</div>

<script>
    const fileInput = document.getElementById('file-materi-input');
    const placeholderText = document.getElementById('placeholder-text');
    const fileNameContainer = document.getElementById('file-name-container');
    const fileNameText = document.getElementById('file-name-text');
    const changeFile = document.getElementById('change-file');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            fileNameText.textContent = file.name;
            placeholderText.classList.add('hidden');
            fileNameContainer.classList.remove('hidden');
        }
    });

    changeFile.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.value = '';
        placeholderText.classList.remove('hidden');
        fileNameContainer.classList.add('hidden');
    });
</script>
@endsection