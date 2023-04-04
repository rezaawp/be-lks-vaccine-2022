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
            
            // variabel yang akan menampung daftar vaksin yang ada dan tidak ada di suatu rumah sakit
            $vaccine_tersedia = [];

            // membuat template vaksin tersedia, vaksin awalnya semuanya false
            foreach ($vaccine_table as $list_vaccine) {
                $vaccine_tersedia[$list_vaccine->name] = false;
            }

            // mengecek dan membandingkan daftar vaksin yang ada dengan vaksin yang tersedia di suatu rumah sakit
            
            foreach($vaccine_table as $list_vaccine){ // mengeluarkan semua list vaksin yang ada

                    foreach($res->vaccine as $vaccine_rs){// mengeluarkan semua vaksin yang ada di rumah sakit tertentu

                        if($list_vaccine->name == $vaccine_rs->vaccine->name){ // kalau list vaksin sama dengan vaksin yang ada di rumah sakit ( artinya vaksin tersebut ada di rumah sakit itu)
                            $vaccine_tersedia[$list_vaccine->name] = true; // vaksin true
                            break;
                        }
                        else{
                            $vaccine_tersedia[$list_vaccine->name] = false; // kalau tidak ada, vaksin false
                        }
                    }
            }

            $res->available_vaccines =  $vaccine_tersedia;
            unset($res->vaccine); // hapus vaksin yang ada di dalam database sebelumnya
            return $res;
        });
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
