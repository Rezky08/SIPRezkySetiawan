<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Redirect;

class RoleValidator
{
    use Redirect;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        $role = $user->role;
        if (in_array($role->name, $roles)) {
            return $next($request);
        } else {
            return $this->redirectByRole($role->name);
        }
    }
}
