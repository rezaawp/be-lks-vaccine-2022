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
            'queue' => $this->queue,
            'dose' => $this->dose,
            'vaccination_date' => $this->date,
            'spot' => collect([$this->spot])->map(function ($spot) {
                return [
                    'id' => $spot->id,
                    'name' => $spot->name,
                    'address' => $spot->address,
                    'serve' => $spot->serve,
                    'capacity' => $spot->capacity,
                    'regional' => collect([$spot->regional])->map(function ($regional) {
                        return [
                            'id' => $regional->id,
                            'province' => $regional->province,
                            'district' => $regional->district
                        ];
                    })->first()
                ];
            })->first(),
            'status' => $this->status,
            'vaccine' => $this->vaccine !== null ? collect([$this->vaccine])->map(function ($vaccine) {
                return [
                    'id' => $vaccine->id,
                    'name' => $vaccine->name
                ];
            })->first() : null,
            'vaccinator' => $this->vaccinator !== null ? collect([$this->vaccinator])->map(function ($vaccinator) {
                return  [
                    'id' => $vaccinator->id,
                    'role' => $vaccinator->role,
                    'name' => $vaccinator->name
                ];
            })->first() : null
        ];
    }
}
