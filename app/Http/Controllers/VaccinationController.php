<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Models\Consultation;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validate = Validator::make($request->all(), [
            'date' => ['required', 'date'],
            'spot_id' => ['required']
        ]);

        if ($validate->fails()) {
            return Response::json(401, 'Invalid field', $validate->errors());
        }

        $date = $request->date;
        $spot_id = $request->spot_id;

        $society_id = Auth::society()['id'];
        $consultation = Consultation::where('society_id', $society_id)->get();

        // $last_consultation = 

        // validasi bahwa sudah diterima konsultasi nya
        foreach ($consultation as $consult) {
            if ($consult['status']  !== 'accepted') {
                return Response::json(401, 'Your consultation must be accepted by doctor before');
                break;
            }
        }

        $vaccination = Vaccination::where('society_id', $society_id)->get();
        $last_vaccination = $vaccination[$vaccination->count() - 1];

        $_30hari = time() + (60 * 60 * 24 * 30);
        foreach ($vaccination as $item) {
            if (strtotime($item['date']) < $_30hari) {
                return Response::json(401, 'Wait at least +30 days from 1st vaccinations');
            };
        }

        return $consultation[0];
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccination $vaccination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccination $vaccination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaccination $vaccination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccination $vaccination)
    {
        //
    }
}
