<?php

namespace App\Helpers;

use App\Models\Token;
use Illuminate\Http\Request;

class Auth
{

    // function untuk akses data society masyarakat
    static function society()
    {
        $token = request()->header('Authorization');
        if (!$token) {
            return null;
        }

        $find_token = Token::where('token', $token)->first();
        if ($find_token) {
            return Token::with('user.society')->first()['user']['society'];
        }

        return "no success";
    }

    // Auth::user()
    static function user()
    {
        $token = request()->header('Authorization');
        if (!$token) {
            return null;
        }

        $find_token = Token::where('token', $token)->first();
        if ($find_token) {
            return Token::with('user.role')->first()['user'];
        }

        return null;
    }

    static function logout()
    {
        $token = request()->header('Authorization');
        if (!$token) {
            return false;
        }

        $find_token = Token::where('token', $token)->first();
        if ($find_token) {
            return $find_token->delete() ? true : false;
        }

        return false;
    }
}
