<?php

namespace App\Http\Controllers;

use App\Helpers\Auth;
use App\Models\Consultation;
use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
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
        return $society_id = Auth::society();
        return $consultation = Consultation::where('society_id', $society_id)->first();
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaccine $vaccine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaccine $vaccine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaccine $vaccine)
    {
        //
    }
}
