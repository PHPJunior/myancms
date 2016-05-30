<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class CheckFile
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
            abort(404);
        }
        return $next($request);
    }

    /**
     * @return mixed
     */
    private function alreadyInstalled()
    {
        return File::exists(storage_path('installed'));
    }
}
