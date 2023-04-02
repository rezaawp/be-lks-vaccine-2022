<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpotVaccine extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vaccine_id', 'id');
    }
}
