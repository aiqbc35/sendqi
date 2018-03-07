<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Cont\UserController;
use Closure;

class MobileLogin
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
            return redirect('/mobile/login');
        }

        return $next($request);
    }
}
