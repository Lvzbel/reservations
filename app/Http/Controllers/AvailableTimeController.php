<?php

namespace App\Http\Controllers;

use App\Modules\AvailableTimes\Workflow\CreateAvailableTimesWorkflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AvailableTimeController extends Controller
{
    public function store(Request $request, CreateAvailableTimesWorkflow $createAvailableTimesWorkflow): \Illuminate\Http\JsonResponse
    {
        Validator::make($request->all(), [
            'providerId' => 'required|integer',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        $availableTime = $createAvailableTimesWorkflow->execute(
            $request->input('providerId'),
            Carbon::parse($request->input('startDate')),
            Carbon::parse($request->input('endDate'))
        );

        if (!$availableTime) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create available time.',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $availableTime,
        ]);
    }
}
