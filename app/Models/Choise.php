<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choise extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function votes()
    {
        return $this->hasMany(Vote::class, 'choise_id', 'id');
    }
}
