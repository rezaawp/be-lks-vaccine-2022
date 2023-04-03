<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Http\Resources\VaccinationResource;
use App\Models\Consultation;
use App\Models\Vaccination;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinationController extends Controller
{
    public function index()
    {
        $society_id = Auth::society()['id'];
        $vaccinations = Vaccination::with(['medicals.user', 'vaccine', 'spot.regional'])->where('society_id', $society_id)->get();
        $response = VaccinationResource::collection($vaccinations);

        $result = [
            'vaccinations' => $response
        ];

        return Response::json(200, 'Success get data', $result);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
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
            $last_consultation = count($consultation) > 0 ?  $consultation[count($consultation) - 1] : null;

            // validasi bahwa sudah diterima konsultasi nya
            foreach ($consultation as $consult) {
                if ($consult['status']  !== 'accepted') {
                    return Response::json(401, 'Your consultation must be accepted by doctor before');
                    break;
                }
            }

            $vaccination = Vaccination::where('society_id', $society_id)->get();
            $last_vaccination = count($vaccination) > 0 ?  $vaccination[count($vaccination) - 1] : null;

            // vaccinatation list based on date
            $vaccination_list = $vaccination->filter(function ($item) use ($date) {
                // return $item['id'] == 1;
                return $item['date'] === $date;
            });

            // return $vaccination_list;
            $queue = 1;

            if ($vaccination_list || count($vaccination_list) > 0) {
                $queue = count($vaccination_list) + 1;
            }

            $_30hari = time() + (60 * 60 * 24 * 30);
            foreach ($vaccination as $item) {
                if (strtotime($item['date']) > $_30hari) {
                    return Response::json(401, 'Wait at least +30 days from 1st vaccinations');
                };
            }

            $vaccine_id = 1;

            if ($last_vaccination) {
                $vaccine_id = $last_vaccination['vaccine_id'] + 1;
            }

            $vaccination_stored = Vaccination::create([
                'queue' => $queue,
                'dose' => $vaccine_id,
                'spot_id' => $spot_id,
                'date' => $date,
                'society_id' => $society_id,
                'vaccine_id' => $vaccine_id,
            ]);

            return Response::json(201, "$vaccine_id vaccination registered", $vaccination_stored);
        } catch (Exception $e) {
            if (env('APP_ENV') == 'local') {
                return Response::json(500, 'Server Internal error', $e->getMessage());
            }

            return Response::json(500, 'Server Internal Error');
        }
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
