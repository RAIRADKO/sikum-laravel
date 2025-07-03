<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Opd;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        
        // Menggunakan nama OPD dari dump untuk mencari ID
        $opd_hukum = Opd::where('nama_opd', 'Bagian Hukum Setda')->first();

        $users = [
            [
                'nama' => 'admin',
                'nip' => 'super',
                'password' => Hash::make('admin'), // Ganti 'admin' dengan password yang lebih aman
                'level' => 'admin', // level 'superadmin' diubah menjadi 'admin'
                'id_opd' => $opd_hukum ? $opd_hukum->id_opd : null,
            ],
            [
                'nama' => 'User Hukum',
                'nip' => '11111',
                'password' => Hash::make('11111'), // Ganti '11111' dengan password yang lebih aman
                'level' => 'userhukum',
                'id_opd' => $opd_hukum ? $opd_hukum->id_opd : null,
            ],
        ];

        User::insert($users);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}