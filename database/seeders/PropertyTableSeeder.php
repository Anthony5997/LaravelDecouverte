<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 40; $i++) {
            Property::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'address' => $faker->address,
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'size' => $faker->numberBetween(35, 450),
                'floor' => $faker->numberBetween(1, 5),
                'room' => $faker->numberBetween(1, 15),
                'price' => $faker->randomDigit,
                'postcode' => $faker->postcode,
                'city' => $faker->city,
            ]);
        }
    }
}
