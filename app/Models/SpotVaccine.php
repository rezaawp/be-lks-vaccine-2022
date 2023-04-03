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
        // return DB::table('spot_vaccines')->rightJoin('vaccines', 'spot_vaccines.vaccine_id', '=', 'vaccines.id')->get();
        return $this->belongsTo(Vaccine::class, 'vaccine_id', 'id');
    }
}
