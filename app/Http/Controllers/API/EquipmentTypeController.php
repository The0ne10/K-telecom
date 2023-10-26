<?php

namespace App\Http\Controllers\API;

use App\Actions\StoreEquipmentTypeActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentType\StoreRequest;
use App\Http\Resources\API\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentTypeController extends Controller
{
    /**
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $equipment_types = EquipmentType::query()->paginate(10);
        return EquipmentTypeResource::collection($equipment_types);
    }

    /**
     * @param StoreRequest $request
     * @param StoreEquipmentTypeActions $storeEquipmentTypeActions
     * @return JsonResponse
     */
    public function store(StoreRequest $request, StoreEquipmentTypeActions $storeEquipmentTypeActions): JsonResponse
    {
        $data = $request->validated();
        $data['mask'] = $storeEquipmentTypeActions::getMask();

        EquipmentType::create($data);

        return response()->json(["message" => "success :)"]);
    }

    /**
     * @param EquipmentType $id
     * @return EquipmentTypeResource
     */
    public function show(EquipmentType $id): EquipmentTypeResource
    {
        return new EquipmentTypeResource($id);
    }

    /**
     * @param EquipmentType $id
     * @return JsonResponse
     */
    public function delete(EquipmentType $id): JsonResponse
    {
        $id->delete();
        return response()->json(['message' => 'success']);
    }
}
