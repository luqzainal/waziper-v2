<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeviceController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('devices', DeviceController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'check.device.limit'])->group(function () {
    Route::post('/devices', [DeviceController::class, 'store']);
});
