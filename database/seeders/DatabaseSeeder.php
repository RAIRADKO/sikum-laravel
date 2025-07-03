<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            OpdSeeder::class,
            UserSeeder::class,
            AssistantSeeder::class,
            SeriSeeder::class,
            SkSeeder::class,
            PbSeeder::class,
            LainSeeder::class,
        ]);
    }
}