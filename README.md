# SIAKAD UNSUR - Sistem Informasi Akademik

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS Version](https://img.shields.io/badge/TailwindCSS-v4.0-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![PHP Version](https://img.shields.io/badge/PHP-v8.3-777BB4?logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

## A. Deskripsi Singkat Aplikasi

**SIAKAD UNSUR** (Sistem Informasi Akademik Universitas Suryakancana) adalah platform digital terintegrasi yang dirancang untuk memfasilitasi pengelolaan kurikulum, jadwal perkuliahan, dan administrasi rencana studi secara mandiri pada Program Studi Teknik Informatika. 

Aplikasi ini dibangun menggunakan arsitektur modern berbasis **Laravel 11**, **Tailwind CSS v4**, dan database **MySQL**. Sistem ini menerapkan pembatasan hak akses yang ketat (*Multi-role Middleware*) untuk memisahkan otoritas antara **Panel Administrasi Admin** and **Portal Akademik Mahasiswa**. Fitur transaksional unggulan pada aplikasi ini meliputi kalkulator validasi pagu SKS maksimum otomatis untuk mencegah kelebihan beban studi, pencegahan redundansi pengambilan kelas (*double-input check*), serta mesin cetak dokumen fisik Kartu Rencana Studi (KRS) resmi berformat PDF menggunakan ekstensi **DomPDF**. Keseluruhan komponen antarmuka dirancang seragam menggunakan standar estetika **Royal Blue Premium SaaS Style** guna menjamin scannability dan pengalaman pengguna yang optimal.

## B. Penjelasan Fungsi Masing-Masing Halaman

Sistem ini didistribusikan ke dalam beberapa kluster halaman dengan fungsi spesifik sebagai berikut:

### 1. Kluster Publik & Otentikasi (Sesi Guest)
* **Halaman Utama (`welcome.blade.php`):** Berfungsi sebagai gerbang utama (*landing page*) portal akademik institusi. Halaman ini memuat informasi umum kapabilitas sistem, ringkasan fitur berjalan, serta menyediakan tautan navigasi langsung menuju proses masuk (*Log In*) maupun pendaftaran (*Register*).
* **Halaman Masuk (`auth/login.blade.php`):** Berfungsi sebagai form otentikasi pengguna. Halaman ini memvalidasi kredensial email dan kata sandi, lalu secara otomatis mengarahkan (*redirect*) pengguna ke dasbor internal yang sesuai dengan hak akses akun (*role*) mereka.
* **Halaman Registrasi (`auth/register.blade.php`):** Berfungsi untuk memfasilitasi pembuatan akun mahasiswa baru ke dalam sistem basis data sebelum dapat menggunakan layanan akademik.

### 2. Panel Kendali Administrasi (Role: Admin)
* **Dashboard Admin (`admin/dashboard.blade.php`):** Berfungsi sebagai pusat pemantauan performa data master. Menampilkan ringkasan metrik statistik jumlah dosen, mahasiswa, komponen mata kuliah, dan total ploting jadwal aktif dalam bentuk widget card premium.
* **Halaman Kelola Data Dosen (`admin/dosen/`):**
  * `index.blade.php`: Berfungsi untuk memantau tabel induk seluruh dosen terdaftar (NIDN dan Nama).
  * `create.blade.php`: Berfungsi sebagai formulir input untuk menambahkan data dosen baru ke database.
  * `edit.blade.php`: Berfungsi untuk memperbarui informasi dosen yang telah ada.
* **Halaman Kelola Data Mahasiswa (`admin/mahasiswa/`):**
  * `index.blade.php`: Berfungsi untuk menampilkan daftar mahasiswa aktif beserta relasi ploting Dosen Wali mereka.
  * `create.blade.php`: Berfungsi untuk mendaftarkan mahasiswa baru secara manual serta memplot dosen wali penanggung jawabnya.
  * `edit.blade.php`: Berfungsi untuk mengubah status kelas atau memperbarui relasi bimbingan dosen wali mahasiswa.
* **Halaman Kelola Mata Kuliah (`admin/matakuliah/`):**
  * `index.blade.php`: Berfungsi menampilkan manifes kurikulum program studi beserta bobot SKS masing-masing.
  * `create.blade.php`: Berfungsi untuk menambah silabus mata kuliah baru dengan proteksi input `kode_matakuliah` rigid sepanjang 8 karakter sesuai blueprint ERD tugas besar.
  * `edit.blade.php`: Berfungsi untuk mengubah nama mata kuliah atau bobot akademik dengan status Primary Key teruji (kunci internal terkunci).
* **Halaman Kelola Jadwal Kuliah (`admin/jadwal/`):**
  * `index.blade.php`: Berfungsi memantau seluruh jadwal kelas perkuliahan aktif yang telah diterbitkan pada semester berjalan.
  * `create.blade.php`: Berfungsi sebagai form ploting relasi (*pivot space*) untuk mengikat data Komponen Mata Kuliah, Dosen Pengajar, Huruf Kelas, Hari, dan Jam Pelaksanaan menjadi satu kesatuan.
  * `edit.blade.php`: Berfungsi untuk melakukan penjadwalan ulang jika terjadi konflik alokasi ruang atau waktu mengajar dosen.

### 3. Portal Akademik Transaksional (Role: Mahasiswa)
* **Dashboard Mahasiswa (`mahasiswa/dashboard.blade.php`):** Berfungsi sebagai pusat kendali personal mahasiswa. Halaman ini memuat ringkasan identitas diri lengkap (Nama, NPM, Prodi, Fakultas), status verifikasi kontrak, jumlah kelas terdaftar, dan akumulasi SKS berjalan secara *real-time*.
* **Halaman Pengisian KRS (`mahasiswa/krs/index.blade.php`):** Berfungsi sebagai area transaksi akademik utama. Sisi atas menampilkan ringkasan kelas yang berhasil dikontrak (disertai tombol *Drop MK* dan indikator akumulasi SKS maksimal 24). Sisi bawah menampilkan daftar pilihan jadwal perkuliahan yang tersedia untuk diambil (dilengkapi pengubah status dinamis *✓ Sudah Diambil*).
* **Halaman Cetak KRS PDF (`mahasiswa/krs/cetak.blade.php`):** Berfungsi khusus untuk merender lembar fisik bukti Kartu Rencana Studi resmi. Tampilan dirancang menggunakan struktur tabel HTML murni dan CSS standar (bebas Flexbox/Grid) agar hasil cetak via DomPDF presisi, rapi, dan tidak pecah.
* **Halaman Pengaturan Akun (`profile/edit.blade.php`):** Berfungsi sebagai ruang privasi bagi mahasiswa untuk memperbarui nama profil akun, alamat email, serta enkripsi keamanan kata sandi baru. Halaman ini dilengkapi dengan komponen *Session Alert Banner* statis yang Anda dan aman dari kegagalan skrip front-end.

## C. Spesifikasi Teknologi

* **Framework Utama:** Laravel 11.x
* **Bahasa Pemrograman:** PHP 8.3
* **Sistem Basis Data:** MySQL / MariaDB
* **Desain & Interaksi:** Tailwind CSS (Engine v4) & Alpine.js
* **Ekstensi PDF:** Barryvdh Laravel DomPDF (v3.x)

## D. Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek SIAKAD pada server lokal Anda:

### 1. Kloning Repositori
git clone https://github.com/Adeliaputri2311/tubes-siakad-ifb2024-adelia.git
cd tubes-siakad-ifb2024-adelia

### 2. Pemasangan Dependensi

Unduh seluruh package PHP dan library frontend yang dibutuhkan:
composer require barryvdh/laravel-dompdf
composer install
npm install

### 3. Konfigurasi Environment (.env)

Salin berkas konfigurasi default dan sesuaikan parameter basis data Anda:
cp .env.example .env

Hasilkan kunci enkripsi aplikasi yang baru:
php artisan key:generate


Buka file `.env` dan pastikan nama database Anda sesuai:
**DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad-app
DB_USERNAME=root
DB_PASSWORD=**

### 4. Migrasi & Seeding

Jalankan perintah migrasi untuk menyuntikkan seluruh skema tabel beserta data seed bawaan sistem:
php artisan migrate --seed

### 5. Penyegaran Sistem & Eksekusi

Bersihkan seluruh cache views terkompilasi, jalankan compiler aset Vite, dan aktifkan server lokal:
php artisan view:clear
php artisan optimize:clear
npm run dev

Buka terminal baru, lalu jalankan server utama:

**php artisan serve**

Aplikasi kini dapat diakses penuh melalui tautan: `http://localhost:8000`.

## E. Profil Pengembang

* **Nama:** Adelia Putri
* **NPM:** 5520124034
* **Program Studi:** Teknik Informatika
* **Konteks Proyek:** Tugas Besar Mata Kuliah Pemrograman Web II

## 📄 Lisensi

Proyek aplikasi sistem informasi akademik ini didistribusikan di bawah ketentuan [MIT License](https://www.google.com/search?q=LICENSE).
