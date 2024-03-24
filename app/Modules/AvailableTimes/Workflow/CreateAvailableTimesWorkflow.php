<?php

namespace App\Modules\AvailableTimes\Workflow;

use App\Models\AvailableTime;
use App\Modules\AvailableTimes\Command\CreateAvailableTimeCommand;
use Carbon\Carbon;

class CreateAvailableTimesWorkflow
{
    public function execute(int $providerId, Carbon $startDate, Carbon $endDate): AvailableTime|null
    {
        $command = new CreateAvailableTimeCommand();
        if ($this->areDatesValid($startDate, $endDate)) {
            return $command->execute($providerId, $startDate, $endDate);
        }
        return null;
    }
    public function isEndDataGreaterThanStart(Carbon $start, Carbon $end): bool
    {
        return $end->greaterThan($start);
    }

    public function areDatesInSameDay(Carbon $start, Carbon $end): bool
    {
        return $start->isSameDay($end);
    }

    public function areDatesValid(Carbon $start, Carbon $end): bool
    {
        return $this->isEndDataGreaterThanStart($start, $end) && $this->areDatesInSameDay($start, $end);
    }
}
