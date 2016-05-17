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

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {

        $dummy = $this->ask('Enter Module name?(Don\'t contain spacebar..)');

        $title = $this->ask('Enter Module Title?');

        $model_name = $this->ask('Enter Model Class Name?');

        $module_name = $dummy . 'Controller';

        $name = $this->parseName($module_name);

        $path = $this->getPath($name);

        if ($this->alreadyExists($module_name)) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name, $dummy));

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
            $bar = $this->output->createProgressBar(count($user_list));
            foreach ($user_list as $user) {
                $access_data = new UserAccess();
                $access_data->access_data = json_encode($data);
                $access_data->user_id = $user->id;
                $access_data->module_id = $module->id;
                $access_data->save();
                $bar->advance();
            }
            $bar->finish();
        }

        if($model_name != null || $model_name != ' '){
            $this->call('make:model',[
               'name' => $model_name,
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

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    protected function buildClass($name, $dummy)
    {
        $stub = $this->files->get($this->getStub());

        $module = $dummy;

        return $this->replaceNamespace($stub, $name, $module)->replaceClass($stub, $name);
    }


    protected function replaceNamespace(&$stub, $name, $module)
    {

        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );

        $stub = str_replace(
            'DummyModule', strtolower($module), $stub
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
