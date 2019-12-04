<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Config;

class CheckRequestApi {

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}