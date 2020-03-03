<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Employee;
use App\Company;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $company_id = Company::pluck('id');
        foreach ($company_id as $key => $value) {
            Employee::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'company' => $value
            ]);
        } 
    }
}
