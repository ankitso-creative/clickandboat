<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Enums\Auth\Role\RolesEnum;

use Auth;

class OnlyBoatownerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if($user->role == RolesEnum::ADMIN->value)
        {
            return redirect()->route('admin.dashboard');
        }
        elseif($user->role == RolesEnum::BOATOWNER->value)
        {
            return $next($request); 
        }
        elseif($user->role == RolesEnum::CUSTOMER->value)
        {
            return redirect()->route('customer.dashboard');
        }
        else
        {
            return abort(401);
        }

        return abort(401);
    }
}
