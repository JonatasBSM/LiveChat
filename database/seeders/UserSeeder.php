<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            $faker = Factory::create();
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt($faker->password)
            ]);
        }
    }
}
