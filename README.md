# 📚 SIAKAD FT-UNSUR - Sistem Informasi Akademik

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS Version](https://img.shields.io/badge/TailwindCSS-v4.0-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![PHP Version](https://img.shields.io/badge/PHP-v8.3-777BB4?logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

---

## 📖 A. Deskripsi Singkat Aplikasi

**SIAKAD FT-UNSUR** *(Sistem Informasi Akademik Fakultas Teknik Universitas Suryakancana)* adalah platform digital terintegrasi yang dirancang untuk memfasilitasi pengelolaan kurikulum, jadwal perkuliahan, dan administrasi akademik secara komprehensif.

Aplikasi ini dibangun menggunakan arsitektur modern berbasis **Laravel 11**, **Tailwind CSS v4**, dan database **MySQL**. Sistem ini menerapkan pembatasan hak akses yang ketat melalui *Multi-role Middleware* untuk menjamin keamanan dan segregasi data antar pengguna.

---

## 🎯 B. Penjelasan Fungsi Masing-Masing Halaman

Sistem ini didistribusikan ke dalam beberapa kluster halaman dengan fungsi spesifik sebagai berikut:

### 🌐 1. Kluster Publik & Otentikasi (Sesi Guest)

| Halaman | File | Deskripsi |
|---------|------|-----------|
| **Halaman Utama** | `welcome.blade.php` | Gerbang utama (*landing page*) portal akademik institusi. Memuat informasi umum kapabilitas sistem, ringkasan fitur berjalan, dan navigasi menu utama. |
| **Halaman Masuk** | `auth/login.blade.php` | Form otentikasi pengguna yang memvalidasi kredensial email dan kata sandi, lalu mengarahkan (*redirect*) pengguna ke dashboard sesuai role mereka. |
| **Halaman Registrasi** | `auth/register.blade.php` | Memfasilitasi pembuatan akun mahasiswa baru ke dalam sistem basis data sebelum dapat menggunakan layanan akademik. |

---

### 🔐 2. Panel Kendali Administrasi (Role: Admin)

#### 📊 Dashboard Admin
- **File:** `admin/dashboard.blade.php`
- **Fungsi:** Pusat pemantauan performa data master dengan ringkasan metrik statistik jumlah dosen, mahasiswa, komponen mata kuliah, dan jadwal aktif.

#### 👨‍🏫 Halaman Kelola Data Dosen (`admin/dosen/`)
- **`index.blade.php`** — Memantau tabel induk seluruh dosen terdaftar (NIDN dan Nama)
- **`create.blade.php`** — Formulir input untuk menambahkan data dosen baru ke database
- **`edit.blade.php`** — Memperbarui informasi dosen yang telah ada

#### 👨‍🎓 Halaman Kelola Data Mahasiswa (`admin/mahasiswa/`)
- **`index.blade.php`** — Menampilkan daftar mahasiswa aktif beserta relasi ploting Dosen Wali mereka
- **`create.blade.php`** — Mendaftarkan mahasiswa baru secara manual serta memplot dosen wali penanggung jawabnya
- **`edit.blade.php`** — Mengubah status kelas atau memperbarui relasi bimbingan dosen wali mahasiswa

#### 📚 Halaman Kelola Mata Kuliah (`admin/matakuliah/`)
- **`index.blade.php`** — Menampilkan manifes kurikulum program studi beserta bobot SKS masing-masing
- **`create.blade.php`** — Menambah silabus mata kuliah baru dengan proteksi input `kode_matakuliah` rigid sepanjang 8 karakter sesuai blueprint ERD
- **`edit.blade.php`** — Mengubah nama mata kuliah atau bobot akademik dengan status Primary Key teruji (kunci internal terkunci)

#### 📅 Halaman Kelola Jadwal Kuliah (`admin/jadwal/`)
- **`index.blade.php`** — Memantau seluruh jadwal kelas perkuliahan aktif yang telah diterbitkan pada semester berjalan
- **`create.blade.php`** — Form ploting relasi (*pivot space*) untuk mengikat data Komponen Mata Kuliah, Dosen Pengajar, Huruf Kelas, Hari, dan Jam Pelaksanaan
- **`edit.blade.php`** — Melakukan penjadwalan ulang jika terjadi konflik alokasi ruang atau waktu mengajar dosen

---

### 👤 3. Portal Akademik Transaksional (Role: Mahasiswa)

| Halaman | File | Deskripsi |
|---------|------|-----------|
| **Dashboard Mahasiswa** | `mahasiswa/dashboard.blade.php` | Pusat kendali personal mahasiswa dengan ringkasan identitas diri lengkap (Nama, NPM, Prodi, Fakultas), status akademik, dan ringkasan KRS. |
| **Pengisian KRS** | `mahasiswa/krs/index.blade.php` | Area transaksi akademik utama yang menampilkan kelas berhasil dikontrak dengan opsi Drop MK, serta form untuk menambah mata kuliah baru. |
| **Cetak KRS PDF** | `mahasiswa/krs/cetak.blade.php` | Merender lembar fisik bukti Kartu Rencana Studi resmi dengan struktur tabel HTML murni yang siap untuk pencetakan. |
| **Pengaturan Akun** | `profile/edit.blade.php` | Ruang privasi bagi mahasiswa untuk memperbarui nama profil akun, alamat email, serta enkripsi keamanan kata sandi baru. |

---

## 💻 C. Spesifikasi Teknologi

| Komponen | Teknologi |
|----------|-----------|
| **Framework Utama** | Laravel 11.x |
| **Bahasa Pemrograman** | PHP 8.3 |
| **Sistem Basis Data** | MySQL / MariaDB |
| **Desain & Interaksi** | Tailwind CSS (Engine v4) & Alpine.js |
| **Ekstensi PDF** | Barryvdh Laravel DomPDF (v3.x) |

---

## 🚀 D. Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek SIAKAD pada server lokal Anda:

### 1️⃣ Kloning Repositori

```bash
git clone https://github.com/Adeliaputri2311/tubes-siakad-ifb2024-adelia.git
cd tubes-siakad-ifb2024-adelia
```

### 2️⃣ Pemasangan Dependensi

Unduh seluruh package PHP dan library frontend yang dibutuhkan:

```bash
composer require barryvdh/laravel-dompdf
composer install
npm install
```

### 3️⃣ Konfigurasi Environment (.env)

Salin berkas konfigurasi default dan sesuaikan parameter basis data Anda:

```bash
cp .env.example .env
```

Hasilkan kunci enkripsi aplikasi yang baru:

```bash
php artisan key:generate
```

Buka file `.env` dan pastikan konfigurasi basis data sesuai dengan lingkungan lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad-app
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Migrasi & Seeding

Jalankan perintah migrasi untuk menyuntikkan seluruh skema tabel beserta data seed bawaan sistem:

```bash
php artisan migrate --seed
```

### 5️⃣ Penyegaran Sistem & Eksekusi

Bersihkan seluruh cache views terkompilasi, jalankan compiler aset Vite, dan aktifkan server lokal:

```bash
php artisan view:clear
php artisan optimize:clear
npm run dev
```

Buka terminal baru, lalu jalankan server utama:

```bash
php artisan serve
```

✅ **Aplikasi kini dapat diakses penuh melalui tautan:** [`http://localhost:8000`](http://localhost:8000)

---

## 👨‍💻 E. Profil Pengembang

| Field | Keterangan |
|-------|-----------|
| **Nama** | Adelia Putri |
| **NPM** | 5520124034 |
| **Program Studi** | Teknik Informatika |
| **Konteks Proyek** | Tugas Besar Mata Kuliah Pemrograman Web II |

---

## 📄 Lisensi

Proyek aplikasi sistem informasi akademik ini didistribusikan di bawah ketentuan [MIT License](LICENSE).

---

<div align="center">

**Made with ❤️ by Adelia Putri**

</div>
