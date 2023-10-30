<?php

use App\Http\Controllers\API\EquipmentController;
use App\Http\Controllers\API\EquipmentTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('equipment', EquipmentController::class);
Route::apiResource('equipment-type', EquipmentTypeController::class);


