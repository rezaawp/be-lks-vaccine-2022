<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Token extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static function generateToken($username, $password)
    {
        $tokenStored = Token::create([
            'token' => md5($username . bcrypt($password)),
            'user_id' => Auth::user()->id,
            'expired' => time() + 60 * (int)env('EXP_TOKEN')
        ]);

        if ($tokenStored) {
            return $tokenStored['token'];
        }
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    static function getExpired()
    {
        return time() + 60 * (int)env('EXP_TOKEN');
    }
}
