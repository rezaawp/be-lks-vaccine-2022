<?php

namespace App\Http\Middleware;

use App\Helpers\Response as HelpersResponse;
use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $token = $request->header('Authorization');
        $find_token = Token::with('user')->where('token', $token)->first();
        if ($find_token && $find_token->expired > time()) {
            $id_card_number = $find_token['user']['id_card_number'];
            $password = $find_token['user']['password'];
            Auth::attempt([
                'id_card_number' => $id_card_number,
                'password' => $password
            ]);
            return $next($request);
        }

        return HelpersResponse::json(401, 'Unauthorized | Invalid Token');
    }
}
