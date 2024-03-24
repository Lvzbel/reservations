<?php

namespace App\Modules\AvailableTimes\Command;

use App\Models\AvailableTime;
use Carbon\Carbon;

class CreateAvailableTimeCommand
{
    public function execute(int $providerId, Carbon $startDate, Carbon $endDate): AvailableTime
    {
        $availableTime = new AvailableTime();
        $availableTime->provider_id = $providerId;
        $availableTime->start_time = $startDate;
        $availableTime->end_time = $endDate;
        $availableTime->save();

        return $availableTime;
    }
}
