<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i= 1; $i <= 10 ; $i++) { 
            Company::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'logo' => Str::random(10),
                'website' => Str::random(10)
            ]);
        }
    }
}
