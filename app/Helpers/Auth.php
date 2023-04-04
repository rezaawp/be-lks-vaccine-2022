<?php

namespace App\Helpers;

use App\Models\Society;
use App\Models\Token;

class Auth
{
    static function user()
    {
        $token = request()->header('Authorization', false);
        $find_token = Token::with('user')->where('token', $token)->first();
        if ($find_token) {
            return $find_token['user'];
        }
    }

    static function userId()
    {
        return self::user()['id'];
    }

    static function society()
    {
        return Society::where('user_id', self::userId())->first();
    }
}
