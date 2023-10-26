<?php

namespace App\Actions;

use App\Http\Resources\API\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ValidatorActions
{
    /**
     * @param $request
     * @return array
     */
    public function validatorStore($request): array
    {
        $errors = [];
        $successes = [];

        foreach ($request->all() as $key => $items) {
            $validator = Validator::make($items, [
                'equipment_type_id' => 'required|integer',
                'serial_number' => 'required|string',
                'desc' => 'required|string',
            ]);
            if ($validator->fails()) {
                $errors[$key] = $validator->errors()->all();
                continue;
            }

            $equipment = Equipment::create($items);
            $successes[$key] = new EquipmentResource($equipment);
        }
        $validateData['errors'] = $errors;
        $validateData['success'] = $successes;
        return $validateData;
    }

    /**
     * @param $request
     * @param $id
     * @return MessageBag|EquipmentResource
     */
    public function validatorUpdate($request, $id): MessageBag | EquipmentResource
    {
        $validator = Validator::make($request->all(), [
            'equipment_type_id' => 'required|integer',
            'serial_number' => 'required|string',
            'desc' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $validator->messages();
        }

        $id->update($request->all());

        return new EquipmentResource($id);
    }
}
