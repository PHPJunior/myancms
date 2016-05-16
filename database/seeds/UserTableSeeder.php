<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credentials = [
            'email'    => 'admin@gmail.com',
            'password' => '123456',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        Sentinel::registerAndActivate($credentials);
    }
}
