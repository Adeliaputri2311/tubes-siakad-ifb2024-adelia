<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Tambah Mahasiswa Baru') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Daftarkan dokumen mahasiswa baru beserta dosen wali ke dalam sistem.</p>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-1.5">
                    <label for="npm" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">NPM (Nomor Pokok Mahasiswa)</label>
                    <input type="text" name="npm" id="npm" value="{{ old('npm') }}" maxlength="10" placeholder="Masukkan 10 digit NPM mahasiswa" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm font-mono px-4 py-3 placeholder-slate-300 @error('npm') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                    @error('npm')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="nama" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Lengkap Mahasiswa</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" maxlength="50" placeholder="Masukkan nama lengkap sesuai identitas resmi" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 placeholder-slate-300 @error('nama') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                    @error('nama')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="nidn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Dosen Wali (Pembimbing Akademik)</label>
                    <select name="nidn" id="nidn" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 @error('nidn') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror" required>
                        <option value="" disabled selected class="text-slate-300">-- Pilih Dosen Pembimbing --</option>
                        @foreach($dosens as $dsn)
                            <option value="{{ $dsn->nidn }}" {{ old('nidn') == $dsn->nidn ? 'selected' : '' }}>
                                {{ $dsn->nama }} (NIDN: {{ $dsn->nidn }})
                            </option>
                        @endforeach
                    </select>
                    @error('nidn')
                        <p class="mt-1 text-xs text-red-500 font-medium flex items-center space-x-1">
                            <span>⚠️</span> <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="bg-slate-100 hover:bg-slate-200/80 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                        Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>