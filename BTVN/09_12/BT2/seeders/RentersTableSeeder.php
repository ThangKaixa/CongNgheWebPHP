<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('renters')->insert([
            [
                'id' => 201,
                'name' => 'Nguyễn Văn A',
                'phone_number' => '0987654321',
                'email' => 'nva@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}