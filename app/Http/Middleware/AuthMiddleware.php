<?php

namespace App\Http\Middleware;

use App\Helpers\Response as HelpersResponse;
use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization', false);
        if ($token) {
            $find_token = Token::where('token', $token)->first();
            if ($find_token) {
                if (time() < (int)$find_token['expired']) {
                    return $next($request);
                }
            }
        }

        return HelpersResponse::json(401, 'Invalid token', [], 'Your token is invalid');
    }
}
