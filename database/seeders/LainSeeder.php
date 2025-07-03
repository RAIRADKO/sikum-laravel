<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Lain;
use App\Models\Opd;

class LainSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Lain::truncate();

        $opds = Opd::pluck('id_opd', 'nama_opd');

        // Data final dengan penambahan 'kode_lain'
        $lains = [
            [
                'kode_lain' => 'L0001', // Menambahkan nilai untuk kode_lain
                'no_urut' => 1,
                'id_opd' => $opds->get('Bagian Hukum Setda'), 
                'tgl_pengajuan' => '2025-01-01', 
                'perihal' => 'FASILITASI PENYUSUNAN KEPUTUSAN KEPALA PERANGKAT DAERAH', 
                'pemohon' => 'PURWOREJO', 
                'tgl_terima' => '2025-01-01', 
                'tahap1' => '2025-01-01', 
                'status' => 'Selesai', 
                'tahun' => '2025',
            ]
        ];
        
        Lain::insert($lains);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}