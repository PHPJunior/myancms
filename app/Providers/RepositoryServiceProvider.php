<?php
/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/16/2016
 * Time: 3:54 PM
 */

namespace App\Providers;


use Cartalyst\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\FaceFile\BlogRepositoryInterface',
            'App\Repository\BlogRepository'
        );
    }
}