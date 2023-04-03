<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Models\Spot;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $vaccine_table = Vaccine::all();
        $spot = Spot::with(['vaccine.vaccine'])->get()->map(function ($res, $index) use ($vaccine_table) {

            $vaccine = collect($res->vaccine)->map(function ($v, $i) use ($vaccine_table) {
                return [
                    $v['vaccine']['name'] => true
                ];
            })->collapse();

            $res->available_vaccines = $vaccine;
            unset($res->vaccine);
            return $res;
        });


        // Menambahkan vaccine yang tidak terdaftar = false
        // $spot_result = $spot->map(function ($res) use ($vaccine_table) {
        //     // $keys_vaccine = [];
        //     if (count($res->available_vaccines)) {
        //         $keys_vaccine = collect($res->available_vaccines)->keys();
        //     };
        //     $res->keys = $keys_vaccine;
        //     $result_available_vaccine = $vaccine_table->map(function ($v_b, $i) use ($keys_vaccine) {
        //         if (isset($keys_vaccine[$i]) && $keys_vaccine[$i] === $v_b['name']) {
        //             return [$v_b['name'] => true];
        //         } else {
        //             return [$v_b['name'] => false];
        //         }
        //     })->collapse();
        //     $res->available_vaccines = $result_available_vaccine;
        //     return $res;
        // });
        return Response::json(200, 'Success get spots', $spot);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($spot_id)
    {
        $date = date('Y-m-d');
        if (request()->date) {
            $date = request()->date;
        }

        $society_id = Auth::society()['id'];
        $vaccinations_count = Vaccination::where('society_id', $society_id)->where('date', $date)->count();
        $spot = collect([Spot::find($spot_id)])->map(function ($item) use ($vaccinations_count, $date) {
            $item->vaccination_count = $vaccinations_count;
            return $item;
        })->first();

        return Response::json(200, 'Success get data', [
            'date' => $date,
            'spot' => $spot,
            'vaccinations_count' => $vaccinations_count
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        //
    }
}
