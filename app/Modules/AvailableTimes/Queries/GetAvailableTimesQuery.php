<?php

namespace App\Modules\AvailableTimes\Queries;

use App\Models\AvailableTime;
use Carbon\Carbon;

class GetAvailableTimesQuery
{
    public function execute(int $providerId, string $date): AvailableTime|null
    {
        $result = AvailableTime::where(['provider_id' => $providerId])
            ->whereDate('start_time', $date)
            ->first();

        return $result;
    }
}
