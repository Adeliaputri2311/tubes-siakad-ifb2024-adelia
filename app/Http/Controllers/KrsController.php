<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        dd([
            'user' => $user,
            'identitas_id' => $user->identitas_id,
            'mahasiswa' => Mahasiswa::where('npm', $user->identitas_id)->first(),
        ]);
    }

    public function store(Request $request) {
        $npm = Auth::user()->identitas_id;
        
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
        ]);

        // Validasi: Cegah double input mata kuliah yang sama
        $exists = Krs::where('npm', $npm)->where('kode_matakuliah', $request->kode_matakuliah)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Mata kuliah ini sudah Anda ambil.');
        }

        Krs::create([
            'npm' => $npm,
            'kode_matakuliah' => $request->kode_matakuliah
        ]);

        return redirect()->route('mahasiswa.krs.index')->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroy($id) {
        $krs = Krs::findOrFail($id);
        
        // Proteksi: Pastikan mahasiswa hanya bisa menghapus KRS miliknya sendiri
        if ($krs->npm !== Auth::user()->identitas_id) {
            abort(403);
        }

        $krs->delete();
        return redirect()->route('mahasiswa.krs.index')->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }

    public function cetak()
    {
        $user = auth()->user();
        
        // Ambil data mahasiswa berdasarkan identitas_id (NPM) pengguna yang login
        $mahasiswa = \App\Models\Mahasiswa::where('npm', $user->identitas_id)->with('dosen')->firstOrFail();
        
        // Ambil daftar KRS yang diambil oleh mahasiswa tersebut
        $krs_diambil = \App\Models\Krs::where('npm', $user->identitas_id)->with('matakuliah')->get();

        // Load view khusus cetak dan teruskan datanya
        $pdf = Pdf::loadView('mahasiswa.krs.cetak', compact('mahasiswa', 'krs_diambil'));
        
        // Stream otomatis membuka PDF di browser sebelum diunduh
        return $pdf->stream('KRS_' . $mahasiswa->npm . '.pdf');
    }
}