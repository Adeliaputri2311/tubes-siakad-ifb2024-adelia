<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Ubah Mata Kuliah') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Perbarui nama komponen atau bobot SKS mata kuliah terdaftar.</p>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            <form action="{{ route('admin.matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Kode Mata Kuliah (Kunci Utama - Tidak Dapat Diubah)</label>
                    <div class="relative">
                        <input type="text" value="{{ $matakuliah->kode_matakuliah }}" 
                               class="block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-400 font-mono shadow-inner text-sm px-4 py-3 cursor-not-allowed select-none" readonly>
                        <span class="absolute right-4 top-3.5 text-sm" title="Primary key locked">🔒</span>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="nama_matakuliah" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matakuliah" id="nama_matakuliah" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" maxlength="50" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 @error('nama_matakuliah') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror" required>
                    @error('nama_matakuliah')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="sks" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Bobot SKS (1 s/d 6)</label>
                    <input type="number" name="sks" id="sks" value="{{ old('sks', $matakuliah->sks) }}" min="1" max="6" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 @error('sks') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror" required>
                    @error('sks')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.matakuliah.index') }}" class="bg-slate-100 hover:bg-slate-200/80 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                        Perbarui Mata Kuliah
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>