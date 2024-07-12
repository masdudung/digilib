<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10000; $i++) {
            Author::create([
                'name' => $faker->name,
                'bio' => $faker->text,
                'birthdate' => $faker->date
            ]);
        }
    }
}
