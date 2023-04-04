<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Resources\ShowSpotResource;
use App\Http\Resources\SpotResource;
use App\Models\Spot;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    function index()
    {
        $dataSpot = Spot::with('spot_vaccine.vaccine')->get();
        $spotRes = SpotResource::collection(collect($dataSpot));

        return Response::json(200, 'Success get all data', $spotRes);
    }

    function show($spotId)
    {
        $reqDate = request()->date;
        $date = date('Y-m-d');
        if ($reqDate) {
            $date = $reqDate;
        }

        $spot = Spot::with(['vaccinitation' => function (Builder $q) use ($date) {
            $q->where('date', $date)->get();
        }])->where('id', $spotId)->get();

        $spotResult = $spot->map(function ($spot) {
            $spot->vaccinitation_count = count($spot->vaccinitation);
            unset($spot->vaccinitation);
            unset($spot->regional_id);
            unset($spot->created_at);
            unset($spot->updated_at);
            return $spot;
        })->first();

        $spotResult = collect([
            'date' => $date,
            'spot' => $spotResult,
            'vaccinations_count' => $spotResult['vaccinitation_count']
        ]);

        unset($spotResult['spot']['vaccinitation_count']);

        return Response::json(200, 'Success get data', $spotResult);
    }
}
