<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Tambah Data Dosen') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Daftarkan tenaga pendidik baru ke dalam sistem database.</p>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            <form action="{{ route('admin.dosen.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-1.5">
                    <label for="nidn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">NIDN (Nomor Induk Dosen Nasional)</label>
                    <input type="text" name="nidn" id="nidn" value="{{ old('nidn') }}" maxlength="10" placeholder="Masukkan 10 digit NIDN" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm font-mono px-4 py-3 placeholder-slate-300 @error('nidn') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                    @error('nidn')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap beserta Gelar</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" maxlength="50" placeholder="Nama Lengkap" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 placeholder-slate-300 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
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
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>