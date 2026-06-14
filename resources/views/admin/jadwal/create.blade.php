<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Terbitkan Jadwal Kuliah') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Plot kombinasi kurikulum, kelas, ruang, jam, dan penanggung jawab kelas.</p>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
            <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="space-y-1.5">
                    <label for="kode_matakuliah" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Mata Kuliah</label>
                    <select name="kode_matakuliah" id="kode_matakuliah" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3" required>
                        <option value="" disabled selected class="text-slate-300">-- Pilih Komponen Kurikulum --</option>
                        @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                {{ $mk->nama_matakuliah }} ({{ $mk->kode_matakuliah }} • {{ $mk->sks }} SKS)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label for="nidn" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Dosen Pengajar</label>
                    <select name="nidn" id="nidn" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3" required>
                        <option value="" disabled selected class="text-slate-300">-- Pilih Penanggung Jawab Kelas --</option>
                        @foreach($dosens as $dsn)
                            <option value="{{ $dsn->nidn }}" {{ old('nidn') == $dsn->nidn ? 'selected' : '' }}>
                                {{ $dsn->nama }} (NIDN: {{ $dsn->nidn }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1.5">
                        <label for="kelas" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kelas (1 Karakter)</label>
                        <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" maxlength="1" placeholder="Contoh: A" 
                               class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm font-mono text-center px-4 py-3 uppercase placeholder-slate-300 @error('kelas') border-red-300 @enderror" required>
                        @error('kelas') <p class="text-red-500 text-[11px] mt-1 font-medium">⚠️ {{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label for="hari" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Hari Pelaksanaan</label>
                        <select name="hari" id="hari" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3" required>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label for="jam" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Jam Kuliah Mulai</label>
                        <input type="time" name="jam" id="jam" value="{{ old('jam', '08:00') }}" 
                               class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3" required>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.jadwal.index') }}" class="bg-slate-100 hover:bg-slate-200/80 text-slate-600 font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                        Terbitkan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>