<?php

use App\Member;
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
        Member::create([
            'name' => 'Nyi Nyi Lwin',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345'),
        ]);
    }
}
