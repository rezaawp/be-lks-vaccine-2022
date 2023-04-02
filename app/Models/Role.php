<?php

namespace App\Models;

use App\Helpers\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static function assignRole($role, $user_id)
    {
        switch ($role) {
            case 'doctor':
                return parent::create([
                    'doctor' => true,
                    'user_id' => $user_id
                ]);
                break;
            case 'society':
                return parent::create([
                    'society' => true,
                    'user_id' => $user_id
                ]);
                break;
            case 'officer':
                return parent::create([
                    'officer' => true,
                    'user_id' => $user_id
                ]);
                break;
            default:
                return [];
        }
    }

    static function hasRole($role)
    {
        $user_role = Auth::user()['role'];
        switch ($role) {
            case 'doctor':
                if ($user_role['doctor']) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'society':
                if ($user_role['society']) {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'officer':
                if ($user_role['officer']) {
                    return true;
                } else {
                    return false;
                }
                break;
            default:
                return [];
        }
    }
}
