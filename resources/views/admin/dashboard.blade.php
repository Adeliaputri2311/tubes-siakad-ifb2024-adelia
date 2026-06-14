<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Selamat datang kembali di pusat kendali administrasi akademik.</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Dosen</span>
                    <span class="text-3xl font-bold text-slate-800 block">
                        {{ \App\Models\Dosen::count() }}
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                        Tenaga Pengajar Aktif
                    </span>
                </div>
                <div class="h-12 w-12 bg-indigo-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    👨‍🏫
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Total Mahasiswa</span>
                    <span class="text-3xl font-bold text-slate-800 block">
                        {{ \App\Models\Mahasiswa::count() }}
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                        Terdaftar Aktif
                    </span>
                </div>
                <div class="h-12 w-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    🎓
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Mata Kuliah</span>
                    <span class="text-3xl font-bold text-slate-800 block">
                        {{ \App\Models\Matakuliah::count() }}
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">
                        Kurikulum Aktif
                    </span>
                </div>
                <div class="h-12 w-12 bg-purple-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    📚
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between transition hover:shadow-md">
                <div class="space-y-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Jadwal Kuliah</span>
                    <span class="text-3xl font-bold text-slate-800 block">
                        {{ \App\Models\Jadwal::count() }}
                    </span>
                    <span class="inline-flex items-center text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md">
                        Terbit Semester Ini
                    </span>
                </div>
                <div class="h-12 w-12 bg-amber-50 rounded-xl flex items-center justify-center text-xl shadow-inner">
                    📅
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 p-8 rounded-3xl text-white relative overflow-hidden shadow-lg shadow-indigo-100">
                    <div class="relative z-10 max-w-md space-y-3">
                        <span class="bg-indigo-500/50 text-indigo-100 text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-md">Pusat Kendali</span>
                        <h3 class="text-xl font-bold">Sistem Informasi Akademik Universitas Suryakancana</h3>
                        <p class="text-xs text-indigo-100/80 leading-relaxed">Kelola semua data master institusi, verifikasi dosen pembimbing akademik, serta monitor jalannya ploting kelas perkuliahan melalui satu dasbor terintegrasi.</p>
                    </div>
                    <div class="absolute -right-10 -bottom-10 h-40 w-40 bg-indigo-500/20 rounded-full blur-2xl"></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-5 pb-2 border-b border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jadwal Baru Terbit</h4>
                        <a href="{{ route('admin.jadwal.index') }}" class="text-[11px] font-bold text-indigo-600 hover:underline">Lihat Semua</a>
                    </div>

                    <div class="space-y-4">
                        @forelse(\App\Models\Jadwal::with(['matakuliah', 'dosen'])->latest()->take(3)->get() as $jdw)
                            <div class="flex items-start space-x-3 p-2 rounded-xl hover:bg-slate-50 transition">
                                <div class="h-8 w-8 bg-slate-100 rounded-lg flex items-center justify-center font-mono text-xs font-bold text-slate-600 shrink-0 uppercase">
                                    {{ $jdw->kelas }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-bold text-slate-800 truncate">{{ $jdw->matakuliah->nama_matakuliah }}</p>
                                    <p class="text-[10px] text-slate-400 truncate mt-0.5">{{ $jdw->dosen->nama }}</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="block text-[10px] font-bold text-slate-700">{{ $jdw->hari }}</span>
                                    <span class="block text-[9px] text-slate-400 mt-0.5">{{ date('H:i', strtotime($jdw->jam)) }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-8">Belum ada jadwal perkuliahan terbit.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 mt-6 flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <span class="text-[10px] font-bold text-indigo-600 block uppercase tracking-wider">Keamanan Data</span>
                        <span class="text-xs font-semibold text-slate-600 block truncate mt-0.5">Integrasi Relasi Database Aman</span>
                    </div>
                    <span class="text-xl">🛡️</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>