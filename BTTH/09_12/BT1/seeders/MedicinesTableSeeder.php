<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 50; $i++) {
            DB::table('medicines')->insert([
                'name'       => $faker->word(), 
                'brand'      => $faker->optional()->company(), 
                'dosage'     => $faker->randomElement(['10mg tablets', '500mg capsules', '5ml syrup', '100mg injections']), 
                'form'       => $faker->randomElement(['tablet', 'capsule', 'syrup', 'injection']), 
                'price'      => $faker->randomFloat(2, 1, 500), 
                'stock'      => $faker->numberBetween(0, 1000), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
