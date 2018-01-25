<?php

namespace App\Http\Middleware;

use Closure;
use App\Utils\SessionManager;

class AdminAuthencation
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
        if (SessionManager::isAdmin())
        {
            return $next($request);
        }
        else
        {
            return redirect('login');
        }
    }
}
