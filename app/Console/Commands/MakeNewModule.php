<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\Models\UserAccess;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class MakeNewModule
 * @package App\Console\Commands
 */
class MakeNewModule extends Command
{
    protected $signature = 'myancms:createmodule ';

    protected $description = 'Create New Module For MyanCMS';

    protected $type = 'Module';

    protected $files;

    protected $views = [
        'index.stub'    => 'index.blade.php',
        'create.stub'   => 'create.blade.php',
        'update.stub'   => 'update.blade.php',
        'view.stub'     => 'view.blade.php',
    ];

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {

        $dummy = $this->ask('Enter Module name?(Don\'t contain spacebar..)');

        $title = $this->ask('Enter Module Title?');

        $model_name = $this->ask('Enter class name to create a new Eloquent model class?');

        $folder = $this->ask('Enter Folder Name For Created Module');

        $route = $this->ask('Enter Route Parameter');

        $module_name = $dummy . 'Controller';

        $name = $this->parseName($module_name);

        $path = $this->getPath($name);

        $folderpath = base_path('resources/views/admin/'.$folder);

        if ($this->alreadyExists($module_name)) {
            $this->error($this->type . ' already exists!');
            return false;
        }

        $content = "Route::resource('$route','$module_name');";

        $this->makeDirectory($path,$folder);
        $this->exportViews($folderpath);

        $this->info('Updated Routes File( module_routes.php ).');

        file_put_contents(
            app_path('Http/module_routes.php'),
            $content,
            FILE_APPEND
        );

        $this->files->put($path, $this->buildClass($name, $dummy, $folder));

        $module = new Module();
        $module->module_name = strtolower($dummy);
        $module->module_title = $title;

        if ($module->save()) {

            $data = [
                'create'  => '0',
                'delete'  => '0',
                'view'    => '0',
                'update'  => '0',
            ];

            $user_list = User::all();

            foreach ($user_list as $user) {
                $access_data = new UserAccess();
                $access_data->access_data = json_encode($data);
                $access_data->user_id = $user->id;
                $access_data->module_id = $module->id;
                $access_data->save();
            }
        }

        if($model_name != null || $model_name != ' '){
            $this->call('make:model',[
               'name' => $model_name, '--migration' => true
            ]);
        }

        $this->info($this->type . ' created successfully.');

    }


    protected function getStub()
    {

        return __DIR__ . '/template/controller.module.stub';

    }

    protected function alreadyExists($rawName)
    {
        $name = $this->parseName($rawName);

        return $this->files->exists($this->getPath($name));
    }

    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }


    protected function parseName($name)
    {
        $rootNamespace = $this->laravel->getNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name);
    }


    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers\Admin';
    }

    protected function makeDirectory($path,$folder)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        if (! is_dir(base_path('resources/views/admin/'.$folder))) {
            mkdir(base_path('resources/views/admin/'.$folder), 0755, true);
        }
    }

    protected function exportViews($folderpath)
    {
        foreach ($this->views as $key => $value) {
            $path = $folderpath.'/'.$value;

            $this->line('<info>Created View:</info> '.$path);

            copy( __DIR__ . '/template/blade/'.$key,$path);
        }
    }

    protected function buildClass($name, $dummy, $folder)
    {
        $stub = $this->files->get($this->getStub());

        $module = $dummy;

        return $this->replaceNamespace($stub, $name, $module, $folder)->replaceClass($stub, $name);
    }


    protected function replaceNamespace(&$stub, $name, $module, $folder)
    {

        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );

        $stub = str_replace(
            'DummyModule', strtolower($module), $stub
        );

        $stub = str_replace(
            'DummyFolder', strtolower($folder), $stub
        );

        $stub = str_replace(
            'DummyRootNamespace', $this->laravel->getNamespace(), $stub
        );

        return $this;
    }

    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }


    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace('DummyClass', $class, $stub);
    }


    protected function getNameInput()
    {
        return $this->argument('name');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
