<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Hardware_DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hardware_devices')->insert([
            [
                'id' => 3001,
                'device_name' => 'Logitech G502',
                'type' => 'Mouse',
                'status' => true,
                'center_id' => 401,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
