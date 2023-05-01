<?php

namespace App\Http\Resources;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $vaccine_table = Vaccine::all();
        $vaccine_rs = collect($this->spot_vaccine)->map(function ($item) use ($vaccine_table) {
            return $item->vaccine->name;
        });

        $vaccine_available = [];

        foreach ($vaccine_table as $vaccine_list) { // 1 data -> masuk loop, jika kondisi terpenuhi loop berenti, lanjut ke data 2 -> masuk loop jika kondisi terpenuhi loop berenti, lanjut ke data n...
            $vaccine_available[$vaccine_list->name] = false;
            foreach ($vaccine_rs as $vacc_rs) {
                if ($vaccine_list->name === $vacc_rs) {
                    $vaccine_available[$vaccine_list->name] = true;
                    break; // break harus ditambahkan untuk keluar dari looping ini
                } else {
                    $vaccine_available[$vaccine_list->name] = false;
                }
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'serve' => $this->serve,
            'capacity' => $this->capacity,
            'available_vaccine' => $vaccine_available
        ];
    }
}
