<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $customer = DB::table('customers')->pluck('id');
        foreach (range(1, 100) as $index) {
            Animal::create([
                'customer_id' => $faker->randomElement($customer),
                'animal_name' => $faker->name(),
                'animal_type' => $faker->randomElement(['Dog', 'Cat', 'Bird', 'Rabbit', 'Hamster', 'Hedgehog']),
                'age' => $faker->numberBetween($min = 1, $max = 100),
                'gender' => $faker->randomElement(['Male', 'Female']),
                // "images" => $faker->image(
                //     "public/uploads/animals",
                //     640,
                //     480,
                //     null,
                //     false
                // ),
            ]);
        }
    }
}