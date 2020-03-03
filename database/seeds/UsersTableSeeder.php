<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'transisi.id',
            'email' => 'admin@transisi.id',
            'password' => Hash::make('transisi')
        ]);
    }
}
