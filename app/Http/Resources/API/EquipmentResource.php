<?php

namespace App\Http\Resources\API;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{

    public bool $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {

        return [
            'id' => $this->id,
            'equipment_type' => new EquipmentTypeResource($this->equipmentType),
            'serial_number' => $this->serial_number,
            'desc' => $this->desc,
        ];
    }
}
