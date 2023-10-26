<?php

use App\Http\Controllers\API\EquipmentController;
use App\Http\Controllers\API\EquipmentTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('equipment')->group(function () {
    Route::get('/', [EquipmentController::class, 'index']);
    Route::post('/', [EquipmentController::class, 'store']);
    Route::patch('/{id}', [EquipmentController::class, 'update']);
    Route::get('/{id}', [EquipmentController::class, 'show']);
    Route::delete('/{id}', [EquipmentController::class, 'delete']);
});

Route::prefix('equipment-type')->group(function () {
    Route::get('/', [EquipmentTypeController::class, 'index']);
    Route::post('/', [EquipmentTypeController::class, 'store']);
    Route::get('/{id}', [EquipmentTypeController::class, 'show']);
    Route::delete('/{id}', [EquipmentTypeController::class, 'delete']);
});

