<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sk;
use App\Models\Opd;

class SkSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Sk::truncate();

        $opds = Opd::pluck('id_opd', 'nama_opd');

        $sks = [
            [
                'no_urut' => 1, 'kode_sk' => 'SK0008', 'id_opd' => $opds->get('Dinas Pemberdayaan Perempuan dan Perlindungan Anak serta Pemberdayaan Masyarakat dan Desa'),
                'tgl_pengajuan' => '2025-01-02', 'perihal' => 'Penetapan Penerima dan Besaran Penerimaan Bantuan Keuangan Yang Bersifat Khusus Kepada Pemerintah Desa Untuk Pemberian Penghasilan Bagi Staf Perangkat Desa Tahun Anggaran 2025',
                'pemohon' => 'Laksana Sakti, AP. MSi', 'tgl_terima' => '2025-01-14', 'tahap1' => '2025-01-08', 'catatan' => 'Surat Nomor 400.10.2.2/14/2025 Tanggal 3 Januari 2025', 'status' => 'Proses', 'tahun' => '2025', 'no_sk' => NULL
            ],
            [
                'no_urut' => 2, 'kode_sk' => 'SK0001', 'id_opd' => $opds->get('Dinas Komunikasi, Informatika, Statistik dan Persandian (Urusan Statistik)'),
                'tgl_pengajuan' => '2025-01-10', 'perihal' => 'Penyebarluasan Data Statistik Sektoral Daerah Kabupaten Purworejo Dalam E-Walidata Sistem Informasi Pembangunan Daerah Republik',
                'pemohon' => '', 'tgl_terima' => '2025-01-10', 'tahap1' => NULL, 'catatan' => NULL, 'status' => 'Proses', 'tahun' => '2025', 'no_sk' => NULL
            ]
        ];

        Sk::insert($sks);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}