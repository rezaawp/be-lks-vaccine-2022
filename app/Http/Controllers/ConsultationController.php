<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    function store(Request $req)
    {
        $validasi = Validator::make($req->all(), [
            'disease_history' => ['required'],
            'current_symptoms' => ['required']
        ]);

        if ($validasi->fails()) {
            return Response::json(401, 'Validation error', $validasi->errors());
        }

        $dHistory = $req->disease_history;
        $cSymptoms = $req->current_symptoms;
        $societyId = Auth::society()['id'];
        $status = 'pending';

        $consStored = Consultation::create([
            'status' => $status,
            'society_id' => $societyId,
            'disease_history' => $dHistory,
            'current_symptoms' => $cSymptoms
        ]);

        if ($consStored) {
            $dataResult =  ConsultationResource::collection(collect([$consStored]))->first();
            return Response::json(200, 'Request consultation senf succesful', $dataResult);
        } else {
            return Response::json(500, "Error saved consultation");
        }
    }

    function index(Request $re)
    {
        $society_id = Auth::society()['id'];
        $consultations = Consultation::where('society_id', $society_id)->get();
        return Response::json(200, 'Success get data', $consultations);
    }
}
