<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Users;
use DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker = Faker::create('id_ID');
        // for ($i = 1; $i <= 50; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'username' => $faker->userName,
        //         'address' => $faker->address,
        //         'password' => '123456'
        //     ]);
        // }


    }
}
