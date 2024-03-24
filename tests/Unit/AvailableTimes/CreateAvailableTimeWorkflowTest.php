<?php

namespace Tests\Unit\AvailableTimes;

use App\Modules\AvailableTimes\Workflow\CreateAvailableTimesWorkflow;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
class CreateAvailableTimeWorkflowTest extends TestCase
{
    public CreateAvailableTimesWorkflow $availableTimesWorkflow;
    public function setUp(): void
    {
        parent::setUp();
        $this->availableTimesWorkflow = new CreateAvailableTimesWorkflow();
    }

    public function test_if_end_date_is_greater_than_end_date(): void
    {
        $tomorrowAtEightAM = Carbon::tomorrow()->setHour(8)->setMinute(0)->setSecond(0);
        $tomorrowAtFivePM = Carbon::tomorrow()->setHour(17)->setMinute(0)->setSecond(0);
        $result = $this->availableTimesWorkflow->isEndDataGreaterThanStart($tomorrowAtEightAM, $tomorrowAtFivePM);

        $this->assertTrue($result);
    }

    public function test_if_start_date_is_later_than_end_date(): void
    {
        $tomorrowAtEightAM = Carbon::tomorrow()->setHour(8)->setMinute(0)->setSecond(0);
        $tomorrowAtFivePM = Carbon::tomorrow()->setHour(17)->setMinute(0)->setSecond(0);
        $result = $this->availableTimesWorkflow->isEndDataGreaterThanStart($tomorrowAtFivePM, $tomorrowAtEightAM);

        $this->assertFalse($result);
    }

    public function test_if_both_dates_are_in_the_same_day()
    {
        $start = Carbon::tomorrow()->setHour(8);
        $end = Carbon::tomorrow()->setHour(17);
        $result = $this->availableTimesWorkflow->areDatesInSameDay($start, $end);

        $this->assertTrue($result);
    }

    public function test_when_dates_are_in_different_day()
    {
        $start = Carbon::now()->setHour(8);
        $end = Carbon::tomorrow()->setHour(17);
        $result = $this->availableTimesWorkflow->areDatesInSameDay($start, $end);

        $this->assertFalse($result);
    }
}

