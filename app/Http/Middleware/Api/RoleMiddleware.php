<?php

namespace App\Http\Middleware\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;

use Closure;
use Illuminate\Http\Request;
use Spatie\Role\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = null, $guard = null)
    {

        $authGuard = app('auth')->guard($guard);


        if (!is_null($role)) {
            $roles = is_array($role)
                ? $role
                : explode('|', $role);
        }

        if (is_null($role)) {
            $role = $request->route()->getName();
            $roles = array($role);
        }


        foreach ($roles as $role) {
            if ($authGuard->user()->hasRole($role)) {
                return $next($request);
            }
        }

        return $this->ApiResponse(null,'You cant exist this route',404);
    }
}
