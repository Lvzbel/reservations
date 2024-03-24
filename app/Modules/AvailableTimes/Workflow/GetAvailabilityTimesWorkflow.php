<?php

namespace App\Modules\AvailableTimes\Workflow;
use App\Modules\AvailableTimes\Queries\GetAvailableTimesQuery;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class GetAvailabilityTimesWorkflow
{
    public GetAvailableTimesQuery $getAvailableTimesQuery;
    public function __construct()
    {
        return $this->getAvailableTimesQuery = new GetAvailableTimesQuery();
    }
    public function get(int $providerId, Carbon $date):  array
    {
        $data = $this->getAvailableTimesQuery->execute($providerId, $date);
        $timeSlots = $this->createTimeSlotsArray($data->provider_id, $data->start_time, $data->end_time);

        return $timeSlots;
    }

    public function formatAvailabilityTime(int $providerId, Carbon $startTime, Carbon $endTime): array
    {
        return [
            'providerId' => $providerId,
            'startTime' => $startTime->toDateTimeString(),
            'endTime' => $endTime->toDateTimeString(),
        ];
    }

    public function createTimeSlotsArray(int $providerId, Carbon $startTime, Carbon $endTime): array
    {
        $interval = CarbonInterval::minute(15);

        $timeSlots = [];

        while ($startTime->lessThan($endTime)) {
            $formattedStartTime = $startTime;
            $formattedEndTime = $startTime->copy()->add($interval);

            $timeSlots[] = [
                $this->formatAvailabilityTime($providerId, $formattedStartTime, $formattedEndTime)
            ];

            $startTime->add($interval);
        }

        return $timeSlots;
    }
}
