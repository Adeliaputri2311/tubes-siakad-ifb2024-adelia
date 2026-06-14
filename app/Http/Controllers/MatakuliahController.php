<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // Tampilkan daftar mata kuliah
    public function index() {
        $matakuliahs = Matakuliah::all();
        return view('admin.matakuliah.index', compact('matakuliahs'));
    }

    // Tampilkan form tambah data
    public function create() {
        return view('admin.matakuliah.create');
    }

    // Simpan mata kuliah baru beserta validasinya
    public function store(Request $request) {
        $request->validate([
            'kode_matakuliah' => 'required|string|size:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);
        
        Matakuliah::create($request->all());
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    // Tampilkan form edit data
    public function edit($kode) {
        $matakuliah = Matakuliah::findOrFail($kode);
        // PERBAIKAN: Menambahkan kurung penutup ')' yang hilang setelah fungsi compact()
        return view('admin.matakuliah.edit', compact('matakuliah'));
    }

    // Perbarui data mata kuliah
    public function update(Request $request, $kode) {
        $matakuliah = Matakuliah::findOrFail($kode);
        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);
        
        $matakuliah->update($request->only('nama_matakuliah', 'sks'));
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    // Hapus data mata kuliah
    public function destroy($kode) {
        Matakuliah::findOrFail($kode)->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}