@php
    // Interseptor Data untuk Efisiensi Query View-Level
    $mhs = \App\Models\Mahasiswa::where('npm', Auth::user()->identitas_id)->with('dosen')->first();
    $krs_diambil = \App\Models\Krs::where('npm', Auth::user()->identitas_id)->with('matakuliah')->get();
    $total_sks = $krs_diambil->sum(function($item) { return $item->matakuliah->sks ?? 0; });
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Selamat datang di pusat pemantauan akademik mahasiswa.</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">SKS Semester Ini</span>
                    <span class="text-3xl font-bold text-slate-800 block">
                        {{ $total_sks }} <span class="text-xs font-medium text-slate-400">/ 24</span>
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">
                        Beban Akademik Aktif
                    </span>
                </div>
                <div class="h-12 w-12 bg-blue-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    📝
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Mata Kuliah Diambil</span>
                    <span class="text-3xl font-bold text-slate-800 block">
                        {{ $krs_diambil->count() }}
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                        Kelas Terdaftar
                    </span>
                </div>
                <div class="h-12 w-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    📚
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Status KRS</span>
                    <span class="text-xl font-bold text-slate-800 block pt-1">
                        {{ $total_sks > 0 ? 'TERKONTRAK' : 'BELUM ISI' }}
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold {{ $total_sks > 0 ? 'text-emerald-600 bg-emerald-50' : 'text-amber-600 bg-amber-50' }} px-2 py-0.5 rounded-md mt-1">
                        {{ $total_sks > 0 ? 'Terverifikasi Sistem' : 'Aksi Diperlukan' }}
                    </span>
                </div>
                <div class="h-12 w-12 bg-purple-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    📌
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Semester Berjalan</span>
                    <span class="text-2xl font-bold text-slate-800 block pt-1">
                        GENAP
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md mt-1">
                        Tahun Ajaran 2026/2027
                    </span>
                </div>
                <div class="h-12 w-12 bg-amber-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    🗓️
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-8 rounded-3xl text-white relative overflow-hidden shadow-lg shadow-blue-100">
                    <div class="relative z-10 max-w-md space-y-3">
                        <span class="bg-blue-500/50 text-blue-100 text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-md">Portal Mahasiswa</span>
                        <h3 class="text-xl font-bold">Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-xs text-blue-100/80 leading-relaxed">
                            Akses pengisian Kartu Rencana Studi (KRS) telah dibuka penuh. Pastikan Anda berkonsultasi terlebih dahulu dengan Dosen Wali sebelum melakukan finalisasi beban SKS semester ini.
                        </p>
                    </div>
                    <div class="absolute -right-10 -bottom-10 h-40 w-40 bg-blue-500/20 rounded-full blur-2xl"></div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Dosen Wali Anda</h4>
                        <span class="text-[10px] bg-emerald-50 text-emerald-600 font-bold px-2 py-0.5 rounded-md">AKTIF</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-slate-100 text-slate-600 rounded-xl font-bold flex items-center justify-center text-sm uppercase border border-slate-200">
                            {{ isset($mhs->dosen->nama) ? substr($mhs->dosen->nama, 0, 2) : 'DS' }}
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-sm font-bold text-slate-800 truncate">{{ $mhs->dosen->nama ?? 'Belum Diplot' }}</span>
                            <span class="text-[11px] text-slate-400 font-medium font-mono mt-0.5">NIDN: {{ $mhs->nidn ?? '-' }}</span>
                        </div>
                    </div>
                    <p class="text-[11px] text-slate-400 leading-relaxed bg-slate-50 p-3 rounded-xl border border-slate-100/50">
                        Dosen wali bertanggung jawab penuh atas persetujuan rencana studi, peninjauan kartu hasil studi (KHS), dan bimbingan akademik Anda selama masa perkuliahan.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-3 text-xs font-medium text-slate-600">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider pb-2 border-b border-slate-100 mb-2">Identitas Mahasiswa</h4>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Nama Lengkap</span>
                        <span class="font-bold text-slate-800 text-right">{{ $mhs->nama ?? Auth::user()->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">NPM</span>
                        <span class="font-mono font-bold text-slate-800">{{ $mhs->npm ?? Auth::user()->identitas_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Program Studi</span>
                        <span class="font-bold text-slate-800">Teknik Informatika</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Fakultas</span>
                        <span class="font-bold text-slate-800">Fakultas Teknik</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>