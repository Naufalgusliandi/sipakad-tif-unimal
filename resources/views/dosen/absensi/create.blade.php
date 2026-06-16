@extends('layouts.sipakad')

@section('title', 'Input Presensi')
@section('page_category', 'Aktivitas Akademik')
@section('page_title', 'Lembar Presensi Mahasiswa')

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm flex items-center gap-3 backdrop-blur-md animate-fade-in">
        <svg class="w-5 h-5 shrink-0 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>
@endif

<div class="mb-6">
    <a href="{{ route('dosen.absensi.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors group">
        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7M3 12h18"></path></svg>
        Kembali ke Filter
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="p-4 bg-slate-900/40 border border-slate-800 rounded-xl text-xs">
        <span class="text-slate-500 font-semibold uppercase tracking-wider block">Mata Kuliah</span>
        <span class="text-slate-200 font-bold text-sm block mt-1">{{ $mkSelected->nama_mk }}</span>
        <span class="text-indigo-400 font-mono mt-0.5 block">{{ $mkSelected->kode_mk }} ({{ $mkSelected->sks }} SKS)</span>
    </div>
    <div class="p-4 bg-slate-900/40 border border-slate-800 rounded-xl text-xs">
        <span class="text-slate-500 font-semibold uppercase tracking-wider block">Kelas Akademik</span>
        <span class="text-slate-200 font-bold text-sm block mt-1">Kelas {{ $kelasSelected->nama_kelas }}</span>
        <span class="text-slate-400 mt-0.5 block">Semester Target: {{ $mkSelected->semester }}</span>
    </div>
    <div class="p-4 bg-slate-900/40 border border-slate-800 rounded-xl text-xs">
        <span class="text-slate-500 font-semibold uppercase tracking-wider block">Sesi Pertemuan</span>
        <span class="text-purple-400 font-bold text-lg block mt-0.5">Pertemuan Ke-{{ $pertemuan }}</span>
    </div>
</div>

<form action="{{ route('dosen.absensi.store') }}" method="POST">
    @csrf
    <input type="hidden" name="kelas_id" value="{{ $kelasSelected->id }}">
    <input type="hidden" name="mata_kuliah_id" value="{{ $mkSelected->id }}">
    <input type="hidden" name="pertemuan_ke" value="{{ $pertemuan }}">

    <div class="flex flex-wrap items-center gap-4 mb-6 bg-slate-900/20 border border-slate-800/60 p-4 rounded-xl backdrop-blur-md">
        <div class="flex items-center gap-2 text-xs text-slate-400">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path></svg>
            <span>Tanggal:</span>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required class="bg-slate-950 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500">
        </div>
        <div class="flex items-center gap-2 text-xs text-slate-400">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Jam Mulai:</span>
            <input type="time" name="jam" value="{{ date('H:i') }}" required class="bg-slate-950 border border-slate-800 rounded-lg px-2.5 py-1.5 text-xs text-slate-200 focus:outline-none focus:border-indigo-500">
        </div>
    </div>

    <div class="bg-slate-900/20 border border-slate-800/60 backdrop-blur-xl rounded-2xl overflow-hidden mb-6">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-900/40 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">NIM</th>
                    <th class="px-6 py-4 text-center w-[450px]">Opsi Presensi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                @forelse($mahasiswas as $mhs)
                    @php
                        // CARI DATA KEHADIRAN MAHASISWA DI DATABASE UNTUK PERTEMUAN INI
                        $getAbsen = \App\Models\Absensi::where('mahasiswa_id', $mhs->id)
                                        ->where('kelas_id', $kelasSelected->id)
                                        ->where('mata_kuliah_id', $mkSelected->id)
                                        ->where('pertemuan_ke', $pertemuan)
                                        ->first();
                        
                        // KUNCI: Jika data sudah ada di DB, pakai status tersebut. Jika belum ada, default-kan ke 'Hadir'
                        $statusAktif = $getAbsen ? $getAbsen->status : 'Hadir'; 
                    @endphp
                    <tr class="hover:bg-slate-900/10 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-200">
                            {{ $mhs->user->name }}
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-500 tracking-wider">
                            {{ $mhs->nim }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-3 abs-group">
                                
                                <label class="radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center
                                    {{ $statusAktif == 'Hadir' ? 'active-hadir' : 'normal-mode text-emerald-400' }}">
                                    <input type="radio" name="status[{{ $mhs->id }}]" value="Hadir" {{ $statusAktif == 'Hadir' ? 'checked' : '' }} class="hidden">
                                    <span>Hadir</span>
                                </label>

                                <label class="radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center
                                    {{ $statusAktif == 'Izin' ? 'active-izin' : 'normal-mode text-amber-400' }}">
                                    <input type="radio" name="status[{{ $mhs->id }}]" value="Izin" {{ $statusAktif == 'Izin' ? 'checked' : '' }} class="hidden">
                                    <span>Izin</span>
                                </label>

                                <label class="radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center
                                    {{ $statusAktif == 'Sakit' ? 'active-sakit' : 'normal-mode text-blue-400' }}">
                                    <input type="radio" name="status[{{ $mhs->id }}]" value="Sakit" {{ $statusAktif == 'Sakit' ? 'checked' : '' }} class="hidden">
                                    <span>Sakit</span>
                                </label>

                                <label class="radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center
                                    {{ $statusAktif == 'Alfa' ? 'active-alfa' : 'normal-mode text-rose-400' }}">
                                    <input type="radio" name="status[{{ $mhs->id }}]" value="Alfa" {{ $statusAktif == 'Alfa' ? 'checked' : '' }} class="hidden">
                                    <span>Alfa</span>
                                </label>
                                
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                            <span class="text-xs">Tidak ditemukan mahasiswa aktif di semester {{ $mkSelected->semester }} untuk mengikuti mata kuliah ini.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($mahasiswas->count() > 0)
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('dosen.absensi.index') }}" class="px-5 py-2.5 bg-slate-900 border border-slate-800 rounded-xl text-xs font-semibold text-slate-400 hover:text-white transition-colors">Batal</a>
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold rounded-xl shadow-md hover:from-indigo-500 hover:to-purple-500 transition-all">
                Simpan Presensi Kelas
            </button>
        </div>
    @endif
</form>

<style>
    .normal-mode { bg-color: rgba(2, 6, 23, 0.4); border-color: #1e293b; color: #64748b; }
    .normal-mode:hover { border-color: rgba(99, 102, 241, 0.2); }
    
    /* Warna Menyala Saat Opsi Terpilih Aktif */
    .active-hadir { background-color: rgba(16, 185, 129, 0.2) !important; color: #34d399 !important; border-color: rgba(16, 185, 129, 0.4) !important; }
    .active-izin { background-color: rgba(245, 158, 11, 0.2) !important; color: #fbbf24 !important; border-color: rgba(245, 158, 11, 0.4) !important; }
    .active-sakit { background-color: rgba(59, 130, 246, 0.2) !important; color: #60a5fa !important; border-color: rgba(59, 130, 246, 0.4) !important; }
    .active-alfa { background-color: rgba(239, 68, 68, 0.2) !important; color: #f87171 !important; border-color: rgba(239, 68, 68, 0.4) !important; }
</style>

<script>
    document.querySelectorAll('.abs-group input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const rowContainer = this.closest('.abs-group');
            const allLabels = rowContainer.querySelectorAll('.radio-label');
            
            // Atur ulang semua tombol di baris mahasiswa tersebut ke mode default (mati)
            allLabels.forEach(label => {
                const currentInput = label.querySelector('input');
                label.className = "radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center bg-slate-950/40 border-slate-800 ";
                
                if (currentInput.value == 'Hadir') label.classList.add('text-slate-500', 'hover:text-emerald-400');
                if (currentInput.value == 'Izin') label.classList.add('text-slate-500', 'hover:text-amber-400');
                if (currentInput.value == 'Sakit') label.classList.add('text-slate-500', 'hover:text-blue-400');
                if (currentInput.value == 'Alfa') label.classList.add('text-slate-500', 'hover:text-rose-400');
            });

            // Nyalakan warna bold pekat murni pada opsi yang baru saja diklik dosen
            const chosenLabel = this.closest('.radio-label');
            if (this.value == 'Hadir') chosenLabel.className = "radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center active-hadir";
            if (this.value == 'Izin') chosenLabel.className = "radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center active-izin";
            if (this.value == 'Sakit') chosenLabel.className = "radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center active-sakit";
            if (this.value == 'Alfa') chosenLabel.className = "radio-label px-4 py-2 rounded-xl text-xs font-bold cursor-pointer transition-all border select-none min-w-[75px] text-center active-alfa";
        });
    });
</script>
@endsection