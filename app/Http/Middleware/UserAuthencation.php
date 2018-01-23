<?php

namespace App\Http\Middleware;
use App\Utils\SessionManager;

use Closure;

class UserAuthencation
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
        if (SessionManager::isLogined())
        {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }
    }
}
