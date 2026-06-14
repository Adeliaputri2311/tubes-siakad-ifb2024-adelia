<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index() {
        $mahasiswas = Mahasiswa::with('dosen')->get();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create() {
        $dosens = Dosen::all();
        return view('admin.mahasiswa.create', compact('dosens'));
    }

    public function store(Request $request) {
        $request->validate([
            'npm' => 'required|string|size:10|unique:mahasiswa,npm',
            'nama' => 'required|string|max:50',
            'nidn' => 'required|exists:dosen,nidn',
        ]);
        Mahasiswa::create($request->all());
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function edit($npm) {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $dosens = Dosen::all();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    public function update(Request $request, $npm) {
        $mahasiswa = Mahasiswa::findOrFail($npm);
        $request->validate([
            'nama' => 'required|string|max:50',
            'nidn' => 'required|exists:dosen,nidn',
        ]);
        $mahasiswa->update($request->only('nama', 'nidn'));
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy($npm) {
        Mahasiswa::findOrFail($npm)->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}