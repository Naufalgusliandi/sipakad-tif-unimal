@extends('layouts.sipakad')

@section('title', 'Tambah Mahasiswa')
@section('page_category', 'Master Data')
@section('page_title', 'Registrasi Mahasiswa Baru')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.mahasiswa.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7M3 12h18"></path></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl p-8 max-w-4xl border border-slate-800/40">
    
    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-xl text-xs space-y-1">
            <p class="font-bold">Gagal menyimpan data! Silakan periksa kembali inputan Anda:</p>
            <ul class="list-disc list-inside opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap tanpa gelar" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email Mahasiswa</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@mhs.unimal.ac.id" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">NIM (Nomor Induk Mahasiswa)</label>
                <input type="text" name="nim" value="{{ old('nim') }}" required placeholder="Contoh: 230180021" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all font-mono">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Program Studi</label>
                <input type="text" name="prodi" value="Teknik Informatika" readonly class="w-full bg-slate-950/80 border border-slate-800/80 rounded-xl px-4 py-3 text-sm text-slate-500 font-medium cursor-not-allowed">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Semester Saat Ini</label>
                <select name="semester" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all cursor-pointer">
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" class="bg-slate-900 text-slate-300" {{ old('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tahun Angkatan</label>
                <input type="text" name="angkatan" value="{{ old('angkatan', date('Y')) }}" required placeholder="Contoh: 2024" maxlength="4" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/50 transition-all">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pasfoto Profil (Opsional)</label>
            <div class="border-2 border-dashed border-slate-800 rounded-xl p-6 text-center hover:border-slate-700 transition-colors relative bg-slate-950/10">
                <input type="file" name="foto" id="foto-input" accept="image/jpeg,image/png,image/jpg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                
                <div class="space-y-1" id="upload-placeholder">
                    <svg class="mx-auto h-8 w-8 text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4-4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                    <div class="text-sm text-slate-400">
                        <span class="text-indigo-400 font-semibold">Klik untuk unggah file</span> atau seret gambar ke sini
                    </div>
                    <p class="text-xs text-slate-500">Mendukung ekstensi PNG, JPG, JPEG hingga ukuran maksimal 2MB</p>
                </div>
                
                <div id="preview-container" class="hidden flex flex-col items-center gap-2">
                    <img id="image-preview" src="#" alt="Pratinjau Foto" class="h-28 w-28 object-cover rounded-xl border border-slate-700 shadow-md">
                    <button type="button" id="remove-preview" class="text-xs text-rose-400 hover:underline z-20 relative">Ganti Gambar</button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-800/60">
            <a href="{{ route('admin.mahasiswa.index') }}" class="px-5 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-xs font-semibold text-slate-400 hover:text-white transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-xs font-semibold rounded-xl shadow-md shadow-indigo-600/10 hover:from-indigo-500 hover:to-blue-500 transition-all">Simpan Data Mahasiswa</button>
        </div>
    </form>
</div>

<script>
    const fotoInput = document.getElementById('foto-input');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removePreview = document.getElementById('remove-preview');

    fotoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                imagePreview.setAttribute('src', this.result);
                uploadPlaceholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            });
            reader.readAsDataURL(file);
        }
    });

    removePreview.addEventListener('click', function(e) {
        e.preventDefault();
        fotoInput.value = '';
        uploadPlaceholder.classList.remove('hidden');
        previewContainer.classList.add('hidden');
        imagePreview.setAttribute('src', '#');
    });
</script>
@endsection