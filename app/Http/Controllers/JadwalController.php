<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index() {
        $jadwals = Jadwal::with(['matakuliah', 'dosen'])->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create() {
        $matakuliahs = Matakuliah::all();
        $dosens = Dosen::all();
        return view('admin.jadwal.create', compact('matakuliahs', 'dosens'));
    }

    public function store(Request $request) {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn' => 'required|exists:dosen,nidn',
            'kelas' => 'required|string|size:1',
            'hari' => 'required|string|max:10',
            'jam' => 'required',
        ]);
        
        $data = $request->all();
        $data['jam'] = date('Y-m-d H:i:s', strtotime($request->jam)); // Format standard timestamp

        Jadwal::create($data);
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Kuliah berhasil diterbitkan.');
    }

    public function destroy($id) {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal Kuliah berhasil dihapus.');
    }
}