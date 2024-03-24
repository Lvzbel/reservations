<?php

namespace App\Http\Controllers;

use App\Modules\Resevations\Workflows\CreateReservationWorkflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function store(Request $request, CreateReservationWorkflow $createReservationWorkflow)
    {
        Validator::make($request->all(), [
            'providerId' => 'required|integer',
            'clientId' => 'required|integer',
            'startTime' => 'required|date',
            'endTime' => 'required|date',
        ]);

        $reservation = $createReservationWorkflow->execute(
            $request->input('providerId'),
            $request->input('clientId'),
            Carbon::parse($request->input('startTime')),
            Carbon::parse($request->input('endTime')),
        );

        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create reservation.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $reservation,
        ]);
    }
}
