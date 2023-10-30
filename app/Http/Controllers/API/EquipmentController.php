<?php

namespace App\Http\Controllers\API;

use App\Actions\ScopeSearchActions;
use App\Actions\ValidatorActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\UpdateRequest;
use App\Http\Resources\API\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\Framework\isEmpty;

class EquipmentController extends Controller
{


    /**
     * @param Request $request
     * @param ScopeSearchActions $scopeSearchActions
     * @return JsonResource
     */
    public function index(Request $request, ScopeSearchActions $scopeSearchActions): JsonResource
    {
        return $scopeSearchActions->filter($request);
    }

    /**
     * @param Equipment $equipment
     * @return EquipmentResource
     */
    public function show(Equipment $equipment): EquipmentResource
    {
        return new EquipmentResource($equipment);
    }

    /**
     * @param Request $request
     * @param ValidatorActions $validatorActions
     * @return array
     */
    public function store(Request $request, ValidatorActions $validatorActions): array
    {
        return $validatorActions->validatorStore($request);
    }


    /**
     * @param Equipment $equipment
     * @param UpdateRequest $request
     * @param ValidatorActions $validatorActions
     * @return EquipmentResource|JsonResponse
     */
    public function update(Equipment $equipment, UpdateRequest $request, ValidatorActions $validatorActions)
    {
        $data = $request->validated();

        if (strlen($validatorActions->validatorUpdate($data)) == 10) {
            $data['serial_number'] = $validatorActions->validatorUpdate($data);
        } else {
            return \response()->json(['ошибка' => $validatorActions->validatorUpdate($data)]);
        };

        $equipment->update($data);
        return new EquipmentResource($equipment);
    }

    /**
     * @param Equipment $equipment
     * @return JsonResponse
     */
    public function delete(Equipment $equipment): JsonResponse
    {
        $equipment->delete();

        return \response()->json(['message' => 'success delete']);
    }
}
