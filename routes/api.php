<?php

use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
   Route::apiResource('/providers', ProviderController::class);
   Route::apiResource('/clients', ClientController::class);
   Route::apiResource('/times', AvailableTimeController::class);
});
