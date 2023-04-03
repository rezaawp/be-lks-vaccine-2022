<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'queue' => $this->queue,
            'dose' => $this->dose,
            'vaccination_date' => $this->date,
            'spot' => SpotResource::collection(collect([$this->spot]))->first(),
            'status' => $this->status,
            'vaccine' => VaccineResource::collection(collect([$this->vaccine]))->first(),
            'vaccinator' => VaccinatorResource::collection(collect([$this->medicals]))->first()
        ];
    }
}
