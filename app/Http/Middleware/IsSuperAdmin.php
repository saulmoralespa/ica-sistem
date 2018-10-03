<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class IsSuperAdmin
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

        if (\Auth::check() && \Auth::user()->role_id !== Role::SUPERADMIN)
            return redirect('/');
        return $next($request);
    }
}
