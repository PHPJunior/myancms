<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class CheckInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->alreadyInstalled()) {
            return $next($request);
        }

        return Redirect::to('install/welcome');
    }

    /**
     * @return mixed
     */
    private function alreadyInstalled()
    {
        return File::exists(storage_path('installed'));
    }
}
