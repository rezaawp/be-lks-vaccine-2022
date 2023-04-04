<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'born_date' => $this->society->born_date,
            'gender' => $this->society->gender,
            'address' => $this->society->address,
            'token' => $this->token,
            'regional' => RegionalResource::collection(collect([$this->society->regional]))->first()
            // 'regional' => $this->regio
        ];
    }
}
