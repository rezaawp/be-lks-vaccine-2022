<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Http\Resources\VaccinationResource;
use App\Models\Consultation;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinationController extends Controller
{
    function store(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'date' => ['date'],
            'spot_id' => ['required']
        ]);

        if ($validate->fails()) {
            return Response::json(401, 'Invalid field', $validate->errors());
        }

        $date = $req['date'] ? $req['date'] : date('Y-m-d');
        $spotId = $req['spot_id'];

        $societyId = Auth::society()['id'];
        $find_vaccination = Vaccination::where('society_id', $societyId)->orderBy('id', 'desc')->first();

        $find_consultation = Consultation::where('society_id', $societyId)->orderBy('id', 'desc')->first();

        if ($find_consultation) {
            if ($find_consultation['status'] !== 'accepted') {
                return Response::json(401, 'Your consultation must be accepted by doctor');
            }
        } else {
            return Response::json(401, 'Before register vaccination. You must be consultation with doctor and wait until accpeted');
        }

        $queue = 1;
        $vaccination_by_date = Vaccination::where('date', $date)->orderBy('id', 'desc')->first();
        if ($vaccination_by_date) {
            $queue = $vaccination_by_date['queue'] + 1;
        }

        $dose = 1;
        if ($find_vaccination) {
            $dose = $find_vaccination['dose'] + 1;
            if (Carbon::parse($find_vaccination['date'])->diffInDays() < 30) {
                return Response::json(401, 'Wait at least +30 days from 1st vaccination');
            }
        }

        $vaccinationStored = Vaccination::create([
            'dose' => $dose,
            'date' => $date,
            'society_id' => $societyId,
            'spot_id' => $spotId,
            'queue' => $queue
        ]);

        return Response::json(200, 'vaccination registered successful', $vaccinationStored);
    }

    function index()
    {
        $vaccination = Vaccination::with(['spot.regional', 'vaccine', 'vaccinator'])->get();
        return VaccinationResource::collection($vaccination);
    }
}
