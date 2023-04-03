<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Helpers\Response;
use App\Models\Consultation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function index()
    {
        $society_id = Auth::society()['id'];
        $consultations = Consultation::with('medical.user')->where('society_id', $society_id)->get();
        return Response::json(200, 'Success get data', $consultations);
    }

    public function store(Request $request)
    {
        try {
            $validasi = Validator::make(
                $request->all(),
                [
                    'disease_history' => ['required'],
                    'current_symptoms' => ['required']
                ]
            );

            if ($validasi->fails()) {
                return Response::json(403, 'Validation Error', $validasi->errors());
            }

            $society_id = Auth::society()['id'];
            $disease_history = $request['disease_history'];
            $current_symtomps = $request['current_symptoms'];

            $consultation_stored = Consultation::create([
                'society_id' => $society_id,
                'disease_history' => $disease_history,
                'current_symptoms' => $current_symtomps
            ]);

            return Response::json(200, 'Request consultation send successful!', $consultation_stored);
        } catch (Exception $e) {
            if (env('APP_ENV') === 'local') {
                return Response::json(500, 'Server Internal Error', $e->getMessage());
            }
            return Response::json(500, 'Server Internal Error');
        }
    }
}
