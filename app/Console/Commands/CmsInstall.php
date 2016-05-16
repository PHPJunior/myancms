<?php

namespace App\Console\Commands;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Console\Command;

class CmsInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myancms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install MyanCMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $first_name = $this->ask('Enter First Name');
        $last_name = $this->ask('Enter Last Name');
        $email = $this->ask('Enter Email.)');
        $password = $this->ask('Enter Password');

        $credentials = [
            'email'    => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ];

        $user = Sentinel::registerAndActivate($credentials);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions' => [
                'admin' => true,
            ]
        ]);

        $role = Sentinel::findRoleByName('Administrator');

        $role->users()->attach($user);

    }
}
