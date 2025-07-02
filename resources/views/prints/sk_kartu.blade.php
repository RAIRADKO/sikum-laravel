<!DOCTYPE html>
<html>
<head>
    <title>Kartu Kendali - {{ $sk->kode_sk }}</title>
    <style>
        /* Tambahkan CSS dasar untuk cetak di sini */
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>KARTU KENDALI</h1>
    <h2>PRODUK HUKUM: SURAT KEPUTUSAN</h2>
    <hr>
    <h3>Kode: {{ $sk->kode_sk }}</h3>
    <p><strong>Perihal:</strong> {{ $sk->perihal }}</p>
    <p><strong>OPD Pemohon:</strong> {{ $sk->opd->nama_opd }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Tahapan Proses</th>
                <th>Tanggal Selesai</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 6; $i++)
            <tr>
                <td>{{ config('sikum.tahapan_sk.' . $i) }}</td>
                <td>{{ optional($sk->{'tahap'.$i})->format('d/m/Y H:i') }}</td>
                <td>{{ $sk->{'ket'.$i} }}</td>
            </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>