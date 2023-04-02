<?php

namespace App\Http\Middleware;

use App\Helpers\Response as HelpersResponse;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        switch ($role) {
            case 'doctor':
                if(Role::hasRole('doctor')){
                    return $next($request);
                } else {
                    return HelpersResponse::json(401, 'Unauthorized | For Doctor');
                }
                break;
            case 'society':
                if(Role::hasRole('society')){
                    return $next($request);
                } else {
                    return HelpersResponse::json(401, 'Unauthorized | For Society');
                }
                break;
            case 'officer':
                if(Role::hasRole('officer')){
                    return $next($request);
                } else {
                    return HelpersResponse::json(401, 'Unauthorized | For Officer');
                }
                break;
            default:
                return HelpersResponse::json(401, 'Role Not Found');
        }
    }
}
