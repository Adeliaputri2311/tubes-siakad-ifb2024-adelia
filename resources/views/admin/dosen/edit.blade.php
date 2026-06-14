<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Ubah Data Dosen') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Perbarui dokumen informasi identitas pengetikan dosen.</p>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            <form action="{{ route('admin.dosen.update', $dosen->nidn) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">NIDN (Kunci Utama - Tidak Dapat Diubah)</label>
                    <div class="relative">
                        <input type="text" value="{{ $dosen->nidn }}" 
                               class="block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-400 font-mono shadow-inner text-sm px-4 py-3 cursor-not-allowed select-none" readonly>
                        <span class="absolute right-4 top-3.5 text-sm" title="Primary key locked">🔒</span>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap beserta Gelar</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $dosen->nama) }}" maxlength="50" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                    @error('nama')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.dosen.index') }}" class="bg-slate-100 hover:bg-slate-200/80 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>