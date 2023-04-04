<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
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
            'society_id' => $societyId,
            'disease_history' => $dHistory,
            'current_symptoms' => $h
        ]);
    }

    function index(Request $re)
    {
    }
}
