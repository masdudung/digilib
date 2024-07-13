<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $authorIds = Author::pluck('id')->toArray();
        $authorCount = count($authorIds);

        for ($i = 0; $i < 300; $i++) {
            Book::create([
                'title' => $faker->sentence,
                'author_id' => $authorIds[$i % $authorCount],
                'description' => $faker->paragraph,
                'publish_date' => $faker->date
            ]);
        }
    }
}