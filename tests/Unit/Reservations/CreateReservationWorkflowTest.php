<?php

namespace Tests\Unit\Reservations;

use App\Modules\Resevations\Workflows\CreateReservationWorkflow;
use Carbon\Carbon;
use Tests\TestCase;

class CreateReservationWorkflowTest extends TestCase
{
    public CreateReservationWorkflow $workflow;
    public function setUp(): void
    {
        parent::setUp();
        $this->workflow = new CreateReservationWorkflow();
    }

    public function test_reservation_is_15_minutes_long()
    {
        $startTime = Carbon::tomorrow()->setHour(8)->setMinute(00);
        $endTime = Carbon::tomorrow()->setHour(8)->setMinute(15);
        $result = $this->workflow->verifyDuration($startTime, $endTime);

        $this->assertTrue($result);
    }

    public function test_reservation_with_invalid_time_length()
    {
        $startTime = Carbon::tomorrow()->setHour(8)->setMinute(00);
        $endTime = Carbon::tomorrow()->setHour(8)->setMinute(30);
        $result = $this->workflow->verifyDuration($startTime, $endTime);

        $this->assertFalse($result);
    }
}
