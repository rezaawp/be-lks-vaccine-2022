<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societie extends Model
{
    use HasFactory, Authenticatable;
    protected $guarded = ['id'];

    function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'society_id', 'id');;
    }
}
