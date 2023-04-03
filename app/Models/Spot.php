<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spot extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function vaccine()
    {
        return $this->hasMany(SpotVaccine::class, 'spot_id');
    }

    function regional()
    {
        return $this->belongsTo(Regional::class, 'regional_id', 'id');
    }
}
