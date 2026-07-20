<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100">
        <!-- BRANDING LOGO -->
        <div class="mb-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white font-bold text-2xl shadow-lg shadow-emerald-900/20 mb-3">
                S
            </div>
            <h2 class="text-xl font-bold text-slate-800">SIPAKAD UNIMAL</h2>
            <p class="text-xs text-slate-500">Sistem Informasi Akademik Terpadu</p>
        </div>

        <!-- CARD VERIFIKASI -->
        <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl shadow-slate-200/50 rounded-3xl border border-slate-200/80">
            <!-- ICON MAIL -->
            <div class="mx-auto w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-5 border border-emerald-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-center text-slate-900 mb-2">Verifikasi Email Anda</h3>
            
            <p class="text-xs text-center text-slate-500 leading-relaxed mb-6">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. 
            </p>

            <!-- NOTIFIKASI UANG TERKIRIM (STATUS) -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-medium text-emerald-700 text-center flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Tautan verifikasi baru telah dikirimkan ke alamat email Anda.</span>
                </div>
            @endif

            <!-- TOMBOL AKSI -->
            <div class="space-y-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-xs rounded-xl shadow-md shadow-emerald-900/10 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
                        </svg>
                        <span>Kirim Ulang Email Verifikasi</span>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-4 bg-transparent hover:bg-slate-100 text-slate-500 hover:text-slate-700 font-semibold text-xs rounded-xl transition-colors">
                        Keluar (Log Out)
                    </button>
                </form>
            </div>
        </div>

        <!-- FOOTER -->
        <p class="text-[11px] text-slate-400 mt-8">
            &copy; {{ date('Y') }} Universitas Malikussaleh. All rights reserved.
        </p>
    </div>
</x-guest-layout>