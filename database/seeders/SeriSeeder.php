<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asumsi nama model adalah 'Seri' dan nama tabel 'seris'
        // Jika berbeda, sesuaikan.
        DB::table('seris')->truncate(); 

        $seris = [
            ['kodeseri' => 'PB', 'keterangan' => 'Peraturan Bupati'],
            ['kodeseri' => 'SK', 'keterangan' => 'Surat Keputusan Bupati'],
        ];

        DB::table('seris')->insert($seris);
    }
}