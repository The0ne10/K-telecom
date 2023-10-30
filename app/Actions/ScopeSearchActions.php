<?php

namespace App\Actions;

use App\Http\Resources\API\EquipmentResource;
use App\Http\Resources\API\EquipmentTypeResource;
use App\Models\Equipment;
use App\Models\EquipmentType;

class ScopeSearchActions
{
    public function filter($request)
    {
        if ($res = $request->input('serial_number')) {
            $equipment = Equipment::query()->where('serial_number', $res)->first();
            return new EquipmentResource($equipment);
        }
        if ($res = $request->input('desc')) {
            $equipment = Equipment::query()->where('desc', $res)->first();
            return new EquipmentResource($equipment);
        } else
            $equipments = Equipment::query()->paginate(10);

        return EquipmentResource::collection($equipments);
    }

    public function filterType($request)
    {
        if ($res = $request->input('title')) {
            $equipmentType = EquipmentType::query()->where('title', $res)->first();
            return new EquipmentTypeResource($equipmentType);
        }
        if ($res = $request->input('mask')) {
            $equipmentType = EquipmentType::query()->where('mask', $res)->first();
            return new EquipmentTypeResource($equipmentType);
        } else
            $equipmentTypes = EquipmentType::query()->paginate(10);

        return EquipmentTypeResource::collection($equipmentTypes);
    }
}
