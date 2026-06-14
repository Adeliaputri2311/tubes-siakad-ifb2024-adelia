<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Kartu Rencana Studi (KRS)') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Isi dan atur beban perkuliahan Anda untuk semester berjalan.</p>
        </div>
    </x-slot>

    <div class="space-y-8">
        
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-3.5 rounded-2xl shadow-sm text-sm flex items-center space-x-3" role="alert">
                <span class="text-base">✅</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border border-rose-100 text-rose-700 px-5 py-3.5 rounded-2xl shadow-sm text-sm flex items-center space-x-3" role="alert">
                <span class="text-base">⚠️</span>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <span class="text-lg">📋</span>
                    <h3 class="font-bold text-sm text-slate-800 uppercase tracking-wider">KRS Anda Semester Ini</h3>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('mahasiswa.krs.cetak') }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10 flex items-center space-x-1.5">
                        <span>🖨️</span>
                        <span>Cetak KRS (PDF)</span>
                    </a>
                    <span class="text-[11px] font-bold bg-blue-50 text-blue-600 px-2.5 py-1.5 rounded-xl uppercase">Sesi Terbuka</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 w-full text-left">
                    <thead class="bg-slate-50/30">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/5">Kode MK</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/2">Nama Mata Kuliah</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-1/6">Bobot</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-1/4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @php $total_sks = 0; @endphp
                        @forelse($krs_diambil as $krs)
                            @php $total_sks += $krs->matakuliah->sks; @endphp
                            <tr class="hover:bg-slate-50/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-semibold text-slate-700">{{ $krs->kode_matakuliah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">{{ $krs->matakuliah->nama_matakuliah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-center text-slate-700">{{ $krs->matakuliah->sks }} SKS</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <form action="{{ route('mahasiswa.krs.destroy', $krs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan (drop) mata kuliah ini?');">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100/70 px-4 py-1.5 rounded-xl text-xs transition font-semibold">
                                            Drop MK
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm italic bg-slate-50/10">
                                    <span class="block text-2xl mb-1">📭</span>
                                    KRS Anda masih kosong. Silakan pilih daftar mata kuliah yang tersedia di bawah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center text-sm font-bold text-slate-700">
                <span class="tracking-tight text-xs uppercase text-slate-400">Total Beban SKS Diambil:</span>
                <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold {{ $total_sks > 24 ? 'bg-red-50 text-red-700' : 'bg-blue-600 text-white shadow-md shadow-blue-500/10' }}">
                    {{ $total_sks }} / 24 SKS Max
                </span>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center space-x-2">
                <span class="text-lg">📖</span>
                <h3 class="font-bold text-sm text-slate-800 uppercase tracking-wider">Pilihan Mata Kuliah Tersedianya</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 w-full text-left">
                    <thead class="bg-slate-50/30">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/3">Mata Kuliah</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/4">Dosen Pengajar</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-1/12">Kelas</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/6">Waktu & Hari</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-1/6">Status Operasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($jadwals as $jdw)
                            <tr class="hover:bg-slate-50/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-slate-800">{{ $jdw->matakuliah->nama_matakuliah }}</span>
                                        <span class="text-[11px] font-mono text-slate-400 mt-0.5">{{ $jdw->kode_matakuliah }} • {{ $jdw->matakuliah->sks }} SKS</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-700">
                                    {{ $jdw->dosen->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-center text-slate-800">
                                    <span class="bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/50 text-xs">
                                        {{ $jdw->kelas }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-slate-800">{{ $jdw->hari }}</span>
                                        <span class="text-[11px] text-slate-400 mt-0.5">🕒 {{ date('H:i', strtotime($jdw->jam)) }} WIB</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    @if(in_array($jdw->kode_matakuliah, $kode_diambil))
                                        <span class="inline-flex items-center text-[11px] font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-100">
                                            ✓ Sudah Diambil
                                        </span>
                                    @else
                                        <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="kode_matakuliah" value="{{ $jdw->kode_matakuliah }}">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-1.5 px-4 rounded-xl shadow-md shadow-blue-500/10 transition duration-150">
                                                Ambil MK
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>