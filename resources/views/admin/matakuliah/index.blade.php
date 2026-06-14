<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Master Data Mata Kuliah') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Kelola kurikulum, kode komponen, dan bobot SKS program studi.</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
            <span class="text-xs font-semibold text-slate-500 px-2">Ringkasan Tabel Kurikulum</span>
            <a href="{{ route('admin.matakuliah.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10 flex items-center space-x-1.5">
                <span>➕</span>
                <span>Tambah Mata Kuliah</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-3.5 rounded-2xl shadow-sm text-sm flex items-center space-x-3" role="alert">
                <span class="text-base">✅</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 w-full text-left">
                    <thead class="bg-slate-50/70">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/4">Kode MK</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-1/2">Nama Mata Kuliah</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-1/6">Bobot Akademik</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-center w-1/4">Aksi Kontrol</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($matakuliahs as $mk)
                            <tr class="hover:bg-slate-50/50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-semibold text-slate-700">{{ $mk->kode_matakuliah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">{{ $mk->nama_matakuliah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-center">
                                    <span class="inline-flex items-center bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg">
                                        {{ $mk->sks }} SKS
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center space-x-1">
                                    <a href="{{ route('admin.matakuliah.edit', $mk->kode_matakuliah) }}" class="text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100/70 px-3 py-1.5 rounded-xl text-xs transition font-semibold inline-block">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('admin.matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini? Seluruh jadwal kuliah dan KRS mahasiswa terkait akan ikut terhapus otomatis.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100/70 px-3 py-1.5 rounded-xl text-xs transition font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 whitespace-nowrap text-sm text-slate-400 text-center italic bg-slate-50/30">
                                    <span class="block text-2xl mb-1">📭</span>
                                    Belum ada data mata kuliah yang terdaftar di database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>