<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            ['module_name' => 'admin', 'module_title' => 'Admin'],
            ['module_name' => 'module', 'module_title' => 'Module'],
            ['module_name' => 'role', 'module_title' => 'Role'],
            ['module_name' => 'setting', 'module_title' => 'Setting'],
            ['module_name' => 'cms', 'module_title' => 'CMS Page'],
            ['module_name' => 'blog', 'module_title' => 'blog']
        ]);
    }
}
