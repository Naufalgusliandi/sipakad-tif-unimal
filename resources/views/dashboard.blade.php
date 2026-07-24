<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200/80 mb-8 transition-all hover:shadow-md">
                <div class="p-5 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                    
                    <div class="flex flex-col md:flex-row items-center gap-5 text-center md:text-left">
                        <div class="p-2 bg-emerald-50 rounded-2xl border border-emerald-100/50 shadow-inner">
                            <img src="{{ asset('images/logo-tif.png') }}" alt="Logo Teknik Informatika UNIMAL" class="w-24 h-24 object-contain">
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Portal Akademik Terpadu</h1>
                            <p class="text-emerald-700 font-semibold text-sm mt-0.5 tracking-wide uppercase">Teknik Informatika • Universitas Malikussaleh</p>
                            <div class="h-1 w-20 bg-amber-500 rounded-full mt-2 mx-auto md:mx-0"></div>
                        </div>
                    </div>

                    <div class="px-5 py-3 bg-slate-900 rounded-xl border border-slate-800 shadow-sm text-center md:text-right">
                        <p class="text-xs text-slate-400 font-medium tracking-wider uppercase">Hari & Tanggal Aktif</p>
                        <p class="text-sm font-bold text-amber-400 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
                    </div>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-emerald-100/40 p-5 sm:p-8 relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none"></div>
                
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600 mt-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <div class="space-y-2 max-w-4xl">
                        <h2 class="text-lg font-bold text-slate-800">Panduan Pemanfaatan Fitur Portal</h2>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Gunakan platform ini untuk memantau akumulasi kehadiran kelas, melihat hasil rekapitulasi penilaian ujian semester, serta mengunduh materi kuliah resmi yang diunggah oleh dosen.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>