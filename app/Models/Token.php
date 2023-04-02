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
        $expired = time() + (60 * env('EXP_TOKEN'));
        $token = md5($username . bcrypt($password));
        return parent::create([
            'user_id' => Auth::user()->id,
            'token' => $token,
            'expired' => $expired
        ]);
    }

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
