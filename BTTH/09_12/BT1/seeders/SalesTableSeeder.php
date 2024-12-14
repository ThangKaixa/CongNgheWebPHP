<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $medicineIds = DB::table('medicines')->pluck('medicine_id')->toArray();

        if (empty($medicineIds)) {
            $this->command->info('Bảng medicines không có dữ liệu! Hãy chạy MedicinesSeeder trước.');
            return;
        }

        for ($i = 0; $i < 50; $i++) {
            DB::table('sales')->insert([
                'medicine_id'     => $faker->randomElement($medicineIds), // Chọn ngẫu nhiên 1 `medicine_id`
                'quantity'        => $faker->numberBetween(1, 100),       // Số lượng từ 1 đến 100
                'sale_date'       => $faker->dateTimeBetween('-1 year', 'now'), // Ngày bán trong 1 năm gần đây
                'customer_phone'  => $faker->optional()->numerify('##########'), // Số điện thoại hoặc NULL
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
