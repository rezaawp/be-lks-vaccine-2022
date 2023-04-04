<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function doctor()
    {
        return $this->belongsTo(Medical::class, 'doctor_id', 'id');
    }
}
