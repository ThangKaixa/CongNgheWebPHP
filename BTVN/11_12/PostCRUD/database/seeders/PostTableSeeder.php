<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Testing\Fakes\Fake;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Khởi tạo đối tương faker
        $faker = Faker::create();
        // Chạy vòng lặp xác định số bản ghi và kiểu dữ liệu từ Faker
        for ($i = 0; $i < 5; $i++) {
            DB::Table('posts')->insert([
                'title' => $faker->sentence,
                'body' => $faker->paragraphs
            ]);
            }
    }
}
