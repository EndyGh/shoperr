<?php

namespace App\Http\Middleware;

use Closure;
use \Auth as Auth;

class CheckRole
{
    /**
     * Check user role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role string
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        if (Auth::user()->can($role . '-access')) {
            return $next($request);
        }

        return response('blank', 404);
    }
}
