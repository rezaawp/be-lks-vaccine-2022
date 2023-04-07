<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function choise()
    {
        return $this->belongsTo(Choise::class, 'choise_id', 'id');
    }
}
