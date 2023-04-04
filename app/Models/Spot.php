<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function spot_vaccine()
    {
        return $this->hasMany(SpotVaccine::class, 'spot_id', 'id');
    }

    function vaccinitation() {
        return $this->hasMany(Vaccination::class, 'spot_id', 'id');
    }
}
