<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    function medicals()
    {
        return $this->belongsTo(Medical::class, 'doctor_id', 'id');
    }

    function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id', 'id');
    }

    function spot(){
        return $this->belongsTo(Spot::class, 'spot_id', 'id');
    }
}
