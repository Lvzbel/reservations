<?php

namespace Tests\Unit\AvailableTimes;

use App\Modules\AvailableTimes\Workflow\GetAvailabilityTimesWorkflow;
use Carbon\Carbon;
use Tests\TestCase;

class GetAvailableTimesWorkflowTest extends TestCase
{
    public GetAvailabilityTimesWorkflow $getAvailabilityTimesWorkflow;
    public function setUp() : void
    {
        parent::setUp();
        $this->getAvailabilityTimesWorkflow = new GetAvailabilityTimesWorkflow();
    }

    public function test_availability_format()
    {
        $startTime = Carbon::tomorrow()->setHour(8);
        $endTime = Carbon::tomorrow()->setHour(9);
        $providerId = 1;

        $result = $this->getAvailabilityTimesWorkflow->formatAvailabilityTime($providerId, $startTime, $endTime);

        $this->assertEquals($providerId, $result['providerId']);
        $this->assertEquals($startTime->toDateTimeString(), $result['startTime']);
        $this->assertEquals($endTime->toDateTimeString(), $result['endTime']);
    }

    public function test_create_time_slots()
    {
        $startTime = Carbon::tomorrow()->setHour(8);
        $endTime = Carbon::tomorrow()->setHour(9);
        $providerId = 1;

        $result = $this->getAvailabilityTimesWorkflow->createTimeSlotsArray($providerId, $startTime, $endTime);

        // In an hour time there should be 4 15min time slots
        $this->assertCount(4, $result);
    }
}
