<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions' => [
                'admin' => true,
            ]
        ]);

        $user = Sentinel::findById(1);

        $user->permissions = [
            'user.create'   => true,
            'user.delete'   => true,
            'user.view '    => true,
            'user.update'   => true
        ];

        $user->save();

        $role = Sentinel::findRoleByName('Administrator');

        $role->users()->attach($user);
    }
}
