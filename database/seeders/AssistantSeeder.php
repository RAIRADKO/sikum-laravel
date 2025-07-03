<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assistant;
use Illuminate\Support\Facades\DB;

class AssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assistant::truncate();

        $assistants = [
            ['nama' => 'Asisten Pemerintahan & Kesejahteraan Rakyat'],
            ['nama' => 'Asisten Perekonomian & Pembangunan'],
            ['nama' => 'Asisten Administrasi & Umum'],
        ];

        Assistant::insert($assistants);
    }
}