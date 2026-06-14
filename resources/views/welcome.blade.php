<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIAKAD - Universitas Suryakancana</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900 min-h-screen flex flex-col justify-between relative overflow-x-hidden">
        
        <div class="absolute top-0 right-0 -z-10 h-[600px] w-[600px] bg-blue-100/40 rounded-full blur-3xl transform translate-x-1/4 -translate-y-1/4"></div>
        <div class="absolute bottom-0 left-0 -z-10 h-[500px] w-[500px] bg-indigo-100/30 rounded-full blur-3xl transform -translate-x-1/4 translate-y-1/4"></div>

        <header class="max-w-7xl w-full mx-auto px-6 sm:px-8 h-20 flex items-center justify-between z-10">
            <div class="flex items-center space-x-3">
                <div class="h-9 w-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="font-extrabold text-xl text-slate-800 tracking-tight">SIAKAD <span class="text-blue-600 font-medium">FT-UNSUR</span></span>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                            Buka Dashboard →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-bold text-slate-600 hover:text-blue-600 transition px-3 py-2">
                            Log In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                                Registrasi
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-1 max-w-7xl w-full mx-auto px-6 sm:px-8 flex flex-col lg:flex-row items-center justify-center lg:space-x-16 py-12 z-10">
            
            <div class="flex-1 text-center lg:text-left space-y-6 max-w-xl lg:max-w-none mb-16 lg:mb-0">
                <span class="inline-flex items-center {{ Route::has('login') ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-slate-100 text-slate-600 border-slate-200' }} text-[10px] font-bold px-3 py-1.5 rounded-xl border uppercase tracking-wider">
                    Fakultas Teknik Informatika
                </span>
                <h1 class="text-4xl sm:text-5xl font-black text-slate-800 leading-tight tracking-tight">
                    Sistem Informasi Akademik <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Universitas Suryakancana</span>
                </h1>
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed max-w-lg mx-auto lg:mx-0">
                    Gerbang layanan akademik digital terintegrasi untuk pengelolaan data mahasiswa, jadwal perkuliahan institusi, verifikasi dosen pembimbing, dan efisiensi pengisian Kartu Rencana Studi (KRS).
                </p>
                
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-3 sm:space-y-0 sm:space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/20">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl text-sm transition duration-150 shadow-lg shadow-blue-500/20">
                            Masuk ke Portal Portal
                        </a>
                        <a href="#layanan" class="w-full sm:w-auto text-center bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold py-3.5 px-8 rounded-xl text-sm transition duration-150 shadow-sm">
                            Pelajari Fitur
                        </a>
                    @endauth
                </div>
            </div>

            <div class="flex-1 w-full max-w-md lg:max-w-none">
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-xl space-y-6 relative">
                    <div class="flex items-center space-x-2 pb-4 border-b border-slate-100">
                        <div class="h-3 w-3 rounded-full bg-red-400"></div>
                        <div class="h-3 w-3 rounded-full bg-amber-400"></div>
                        <div class="h-3 w-3 rounded-full bg-green-400"></div>
                        <span class="text-[10px] font-mono text-slate-300 ml-2 tracking-tight">siakad.unsur.ac.id/portal</span>
                    </div>

                    <div class="space-y-4" id="layanan">
                        <div class="p-4 bg-slate-50/70 rounded-2xl border border-slate-100/50 flex items-center space-x-4 transition hover:bg-slate-50">
                            <div class="h-10 w-10 bg-blue-50 rounded-xl flex items-center justify-center text-lg shrink-0">📝</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Kontrak KRS Mandiri</h4>
                                <p class="text-[11px] text-slate-400 mt-0.5 leading-relaxed">Pengisian beban studi mahasiswa secara real-time dengan validasi pagu SKS maksimum.</p>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50/70 rounded-2xl border border-slate-100/50 flex items-center space-x-4 transition hover:bg-slate-50">
                            <div class="h-10 w-10 bg-emerald-50 rounded-xl flex items-center justify-center text-lg shrink-0">📅</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Ploting Jadwal & Kurikulum</h4>
                                <p class="text-[11px] text-slate-400 mt-0.5 leading-relaxed">Penyusunan relasi data master kurikulum, alokasi dosen pengajar, dan ruang kelas terpusat.</p>
                            </div>
                        </div>
                        <div class="p-4 bg-slate-50/70 rounded-2xl border border-slate-100/50 flex items-center space-x-4 transition hover:bg-slate-50">
                            <div class="h-10 w-10 bg-purple-50 rounded-xl flex items-center justify-center text-lg shrink-0">🖨️</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Ekspor Dokumen PDF Resmi</h4>
                                <p class="text-[11px] text-slate-400 mt-0.5 whitespace-normal leading-relaxed">Cetak lembar bukti Kartu Rencana Studi langsung menggunakan fungsionalitas engine DomPDF.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <footer class="max-w-7xl w-full mx-auto px-6 sm:px-8 h-16 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 font-medium z-10">
            <span>&copy; 2026 Universitas Suryakancana. All rights reserved.</span>
            <span class="font-mono text-slate-300">Environment: Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
        </footer>

    </body>
</html>