<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Cont\UserController;
use Closure;

class UserLogin
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
        $result = (new UserController())::autoLogin();

        if (!$result) {
            return redirect('/');
        }

        return $next($request);
    }
}
