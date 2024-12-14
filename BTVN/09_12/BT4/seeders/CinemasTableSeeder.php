<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cinemas')->insert([
            [
                'id' => 601,
                'name' => 'CVG Vincom',
                'location' => 'Vincom Center, Hà Nội',
                'total_seats' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
