<?php

namespace Tests\Unit\Reservations;

use App\Modules\Resevations\Workflows\ConfirmReservationWorkflow;
use Carbon\Carbon;
use Tests\TestCase;

class ConfirmReservationWorkflowTest extends TestCase
{
    public ConfirmReservationWorkflow $workflow;

    public function setUp(): void
    {
        parent::setUp();
        $this->workflow = new ConfirmReservationWorkflow();
    }

    public function test_if_reservation_is_not_older_than_30_min()
    {
        $createdAt = Carbon::now()->subMinutes(15);
        $result = $this->workflow->isItOlderThan30Min($createdAt);

        $this->assertTrue($result);
    }

    public function test_if_reservation_is_older_than_30_min()
    {
        $createdAt = Carbon::now()->subMinutes(35);
        $result = $this->workflow->isItOlderThan30Min($createdAt);

        $this->assertFalse($result);
    }
}
