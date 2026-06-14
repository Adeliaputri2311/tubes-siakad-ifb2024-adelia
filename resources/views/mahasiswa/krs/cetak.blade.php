<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->npm }}</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0 0; font-size: 11px; color: #666; }
        
        .meta-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .meta-table td { padding: 4px 0; vertical-align: top; }
        .meta-table td.label { width: 18%; font-weight: bold; }
        .meta-table td.colon { width: 2%; }
        
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th { background-color: #f8fafc; border: 1px solid #cbd5e1; padding: 10px; font-size: 11px; font-weight: bold; text-transform: uppercase; text-align: left; }
        .data-table td { border: 1px solid #e2e8f0; padding: 10px; vertical-align: middle; }
        .data-table tr:nth-child(even) { background-color: #fdfdfd; }
        
        .total-row { font-weight: bold; background-color: #f1f5f9 !important; }
        .text-center { text-align: center; }
        .font-mono { font-family: 'Courier New', Courier, monospace; }
        
        .footer-sign { width: 100%; margin-top: 50px; }
        .footer-sign td { width: 50%; text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>UNIVERSITAS SURYAKANCANA</h2>
        <h2>FAKULTAS TEKNIK</h2>
        <h2>PROGRAM STUDI TEKNIK INFORMATIKA</h2>
        <p>Jl. Pasir Gede Raya, Bojongherang, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43216</p>
    </div>

    <h3 style="text-align: center; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">KARTU RENCANA STUDI (KRS)</h3>

    <table class="meta-table">
        <tr>
            <td class="label">NPM</td>
            <td class="colon">:</td>
            <td class="font-mono" style="font-weight: bold;">{{ $mahasiswa->npm }}</td>
            <td class="label">Semester</td>
            <td class="colon">:</td>
            <td>Ganjil / Genap</td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="colon">:</td>
            <td>{{ $mahasiswa->nama }}</td>
            <td class="label">Tahun Akademik</td>
            <td class="colon">:</td>
            <td>2026/2027</td>
        </tr>
        <tr>
            <td class="label">Dosen Wali</td>
            <td class="colon">:</td>
            <td>{{ $mahasiswa->dosen->nama ?? '-' }}</td>
            <td class="label">Program Studi</td>
            <td class="colon">:</td>
            <td>Teknik Informatika</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 8%; text-align: center;">No</th>
                <th style="width: 22%;">Kode MK</th>
                <th style="width: 50%;">Mata Kuliah</th>
                <th style="width: 20%; text-align: center;">Bobot SKS</th>
            </tr>
        </thead>
        <tbody>
            @php $total_sks = 0; @endphp
            @forelse($krs_diambil as $index => $krs)
                @php $total_sks += $krs->matakuliah->sks; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="font-mono">{{ $krs->kode_matakuliah }}</td>
                    <td>{{ $krs->matakuliah->nama_matakuliah }}</td>
                    <td class="text-center">{{ $krs->matakuliah->sks }} SKS</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px; color: #94a3b8; font-style: italic;">
                        Belum ada Kartu Rencana Studi yang diambil untuk semester ini.
                    </td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="3" style="text-align: right; padding-right: 20px; text-transform: uppercase; font-size: 11px;">Total Beban Akademik:</td>
                <td class="text-center">{{ $total_sks }} SKS</td>
            </tr>
        </tbody>
    </table>

    <table class="footer-sign">
        <tr>
            <td>
                <p>Mengetahui,</p>
                <p style="margin-bottom: 60px;">Dosen Wali</p>
                <p style="font-weight: bold; text-decoration: underline;">{{ $mahasiswa->dosen->nama ?? '............................................' }}</p>
                <p style="font-size: 10px; color: #666; margin-top: 2px;">NIDN. {{ $mahasiswa->nidn ?? '-----------' }}</p>
            </td>
            <td>
                <p>Cianjur, {{ date('d F C') }}</p> <p style="margin-bottom: 60px;">Mahasiswa</p>
                <p style="font-weight: bold; text-decoration: underline;">{{ $mahasiswa->nama }}</p>
                <p style="font-size: 10px; color: #666; margin-top: 2px;">NPM. {{ $mahasiswa->npm }}</p>
            </td>
        </tr>
    </table>

</body>
</html>