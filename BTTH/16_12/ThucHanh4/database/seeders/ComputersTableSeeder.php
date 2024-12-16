<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('computers')->insert([
                'computer_name' => "Lab-PC{$i}",
                'model' => $faker->word(),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Ubuntu 22.04', 'macOS Ventura']),
                'processor' => $faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5']),
                'memory' => $faker->randomElement([8, 16, 32]),
                'available' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
