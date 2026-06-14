<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // 1. Tampilkan Daftar Dosen
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.dosen.index', compact('dosens'));
    }

    // 2. Tampilkan Form Tambah Dosen
    public function create()
    {
        return view('admin.dosen.create');
    }

    // 3. Simpan Data Dosen Baru (Proses Validasi & Insert)
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|size:10|unique:dosen,nidn', // Harus tepat 10 Karakter sesuai ERD
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.size' => 'NIDN harus berukuran tepat 10 karakter.',
            'nidn.unique' => 'NIDN sudah terdaftar di sistem.',
            'nama.required' => 'Nama dosen wajib diisi.',
        ]);

        Dosen::create($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil ditambahkan.');
    }

    // 4. Tampilkan Form Edit Dosen
    public function edit($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view('admin.dosen.edit', compact('dosen'));
    }

    // 5. Perbarui Data Dosen (Proses Validasi & Update)
    public function update(Request $request, $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);

        $request->validate([
            'node_matakuliah' => 'required|string|max:50', // Tetap string max 50 untuk nama
        ], [
            'nama.required' => 'Nama dosen wajib diisi.',
        ]);

        $dosen->update($request->only('nama'));

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil diperbarui.');
    }

    // 6. Hapus Data Dosen
    public function destroy($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil dihapus.');
    }
}