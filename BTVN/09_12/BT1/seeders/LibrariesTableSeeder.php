<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('libraries')->insert([
            [
                'id' => 101,
                'name' => 'Thư viện IT Đại học ABC',
                'address' => '123 Đường X, Hà Nội',
                'contact_number' => '0123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
