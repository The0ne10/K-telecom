<?php

namespace App\Actions;

use App\Http\Resources\API\EquipmentResource;
use App\Models\Equipment;
use App\Models\EquipmentType;
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
                'equipment_type_id' => 'required|exists:equipment_types,id',
                'serial_number' => 'required|string',
                'desc' => 'required|string',
            ]);


            if ($validator->fails()) {
                $errors[$key] = $validator->errors()->all();
                continue;
            }


            // validation mask and serial number
            $serialNumber = $validator->getData()['serial_number'];
            $mask = EquipmentType::query()->where('id', $validator->getData()['equipment_type_id'])->pluck('mask')->first();
            $temp = [];

            if (strlen(StoreEquipmentTypeActions::prepareData($mask, $serialNumber)) == 10) {
                if (Equipment::query()->get()->pluck('serial_number')->contains($validator->getData()['serial_number'])) {
                    $errors[$key] = 'оборудование с указанным серийным номером и типом уже есть в базе';
                } else {
                    $temp[] = StoreEquipmentTypeActions::prepareData($mask, $serialNumber);
                }
            } elseif (strlen(StoreEquipmentTypeActions::prepareData($mask, $serialNumber)) < 10) {
                $errors[$key] = 'несоответствие серийного номера маски';
            }

            // Create Equipment
            foreach ($temp as $item) {
                $equipment = Equipment::create([
                    'equipment_type_id' => $validator->getData()['equipment_type_id'],
                    'serial_number' => $item,
                    'desc' => $validator->getData()['desc']
                ]);
                $successes[$key] = new EquipmentResource($equipment);
            }


        }
        $validateData['errors'] = $errors;
        $validateData['success'] = $successes;
        return $validateData;
    }

    /**
     * @param $request
     * @param $id
     * @return string
     */
    public function validatorUpdate($request)
    {
        // validation mask and serial number
        $serialNumber = $request['serial_number'];
        $mask = EquipmentType::query()->where('id', $request['equipment_type_id'])->pluck('mask')->first();

        if (strlen(StoreEquipmentTypeActions::prepareData($mask, $serialNumber)) == 10) {
            if (Equipment::query()->get()->pluck('serial_number')->contains($serialNumber)) {
                return 'оборудование с указанным серийным номером и типом уже есть в базе';
            } else {
                return StoreEquipmentTypeActions::prepareData($mask, $serialNumber);
            }
        } elseif (strlen(StoreEquipmentTypeActions::prepareData($mask, $serialNumber)) < 10) {
            return 'несоответствие серийного номера маски';
        }
    }
}
