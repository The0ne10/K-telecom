<?php

namespace App\Http\Controllers\API;

use App\Actions\ValidatorActions;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\MessageBag;

class EquipmentController extends Controller
{

    /**
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $equipments = Equipment::query()->paginate(10);

        return EquipmentResource::collection($equipments);
    }

    /**
     * @param Equipment $id
     * @return EquipmentResource
     */
    public function show(Equipment $id): EquipmentResource
    {
        return new EquipmentResource($id);
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
     * @param Equipment $id
     * @param Request $request
     * @param ValidatorActions $validatorActions
     * @return MessageBag|EquipmentResource
     */
    public function update(Equipment $id, Request $request, ValidatorActions $validatorActions): MessageBag | EquipmentResource
    {
        return $validatorActions->validatorUpdate($request, $id);
    }

    /**
     * @param Equipment $id
     * @return JsonResponse
     */
    public function delete(Equipment $id): JsonResponse
    {
        $id->delete();

        return \response()->json(['message' => 'success delete']);
    }
}
