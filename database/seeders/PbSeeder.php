<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pb;
use App\Models\Opd;

class PbSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pb::truncate();

        $opds = Opd::pluck('id_opd', 'nama_opd');

        $pbs = [
            [
                'no_urut' => 1, 'kode_pb' => 'PB0002', 'id_opd' => $opds->get('Dinas Kesehatan Daerah'), 'tgl_pengajuan' => '2025-01-03', 'perihal' => 'Pelaksanaan Pembinaan dan Pengawasan Terhadap Badan Layanan Umum Daerah Bidang Kesehatan', 
                'pemohon' => '', 'tgl_terima' => '2025-01-31', 'tahap1' => '2025-01-03', 'ket1' => 'Diterima', 'tahap2' => NULL, 'ket2' => NULL, 'catatan' => NULL, 'status' => 'Proses', 'tahun' => '2025', 'no_pb' => '1'
            ],
            [
                'no_urut' => 2, 'kode_pb' => 'PB0001', 'id_opd' => $opds->get('Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah'), 'tgl_pengajuan' => '2025-01-03', 'perihal' => 'Pemungutan Opsen Pajak Mineral Bukan Logam dan Batuan dan Bentuk Sinergi Pemungutan Pajak Mineral Bukan Logam dan Batuan dan Opsen Pajak Mineral Bukan Logam dan Batuan', 
                'pemohon' => '', 'tgl_terima' => '2024-12-31', 'tahap1' => '2025-01-03', 'ket1' => 'Diterima', 'tahap2' => NULL, 'ket2' => NULL, 'catatan' => NULL, 'status' => 'Proses', 'tahun' => '2025', 'no_pb' => '2'
            ]
        ];

        Pb::insert($pbs);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}