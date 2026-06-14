<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // 1. Buat User Admin [cite: 48]
        User::create([
            'name' => 'Administrator SIAKAD',
            'email' => 'admin@siakad.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Data Master Dosen [cite: 57]
        $dosen = Dosen::create(['nidn' => '0411028901', 'nama' => 'Dr. Eko Prasetyo, M.T.']);
        Dosen::create(['nidn' => '0423058502', 'nama' => 'Siti Aminah, M.Kom.']);

        // 3. Data Master Mahasiswa [cite: 59]
        Mahasiswa::create([
            'npm' => '5520124001',
            'nidn' => $dosen->nidn,
            'nama' => 'Adelia Putri'
        ]);

        // 4. Buat User Mahasiswa yang terikat ke NPM [cite: 49]
        User::create([
            'name' => 'Adelia Putri',
            'email' => 'adelia@student.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'identitas_id' => '5520124001',
        ]);

        // 5. Data Master Mata Kuliah [cite: 61]
        Matakuliah::create(['kode_matakuliah' => 'IF53413', 'nama_matakuliah' => 'Pemrograman Web II', 'sks' => 3]);
        Matakuliah::create(['kode_matakuliah' => 'IF53414', 'nama_matakuliah' => 'Basis Data Lanjut', 'sks' => 3]);
    }
}