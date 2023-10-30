<?php

namespace App\Http\Controllers\API;

use App\Actions\ScopeSearchActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentType\StoreRequest;
use App\Http\Resources\API\EquipmentTypeResource;
use App\Models\EquipmentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class EquipmentTypeController extends Controller
{
    /**
     * @return JsonResource
     */
    public function index(Request $request, ScopeSearchActions $scopeSearchActions)
    {
        return $scopeSearchActions->filterType($request);
    }

    /**
     * @param StoreRequest $request

     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        EquipmentType::create($data);

        return response()->json(["message" => "success :)"]);
    }

    /**
     * @param EquipmentType $id
     * @return EquipmentTypeResource
     */
    public function show(EquipmentType $equipmentType): EquipmentTypeResource
    {
        return new EquipmentTypeResource($equipmentType);
    }

    /**
     * @param EquipmentType $id
     * @return JsonResponse
     */
    public function delete(EquipmentType $equipmentType): JsonResponse
    {
        $equipmentType->delete();
        return response()->json(['message' => 'success']);
    }
}
