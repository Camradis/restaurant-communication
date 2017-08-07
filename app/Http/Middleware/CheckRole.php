<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {

            try {

                if ($request->user()->hasRole($role)) {
                    return $next($request);
                }

            } catch (ModelNotFoundException $exception) {
                abort(403);
            }
        }

        return redirect('/login');
    }
}
