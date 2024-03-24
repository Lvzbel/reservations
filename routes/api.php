<?php

use App\Http\Controllers\AvailableTimeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
   Route::apiResource('/providers', ProviderController::class);
   Route::apiResource('/clients', ClientController::class);
   Route::apiResource('/times', AvailableTimeController::class);
   Route::post('times/slots', [AvailableTimeController::class, 'requestTimeSlotsByDay']);
   Route::apiResource('/reservations', ReservationController::class);
   Route::post('/reservations/confirm', [ReservationController::class, 'confirmReservation']);
});
