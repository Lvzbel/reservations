<?php

namespace Tests\Feature\AvailableTimes;

use App\Models\Provider;
use App\Modules\AvailableTimes\Command\CreateAvailableTimeCommand;
use Carbon\Carbon;
use Tests\TestCase;

class CreateAvailableTimesCommandTest extends TestCase
{
    public CreateAvailableTimeCommand $availableTimeCommand;
    public function setUp(): void
    {
        parent::setUp();
        $this->availableTimeCommand = new CreateAvailableTimeCommand();
    }

    public function test_it_should_return_an_entry()
    {
        $provider = Provider::factory()->create();
        $startDate = Carbon::tomorrow()->setHour(8);
        $endDate = Carbon::tomorrow()->setHour(17);

        $result = $this->availableTimeCommand->execute($provider->id, $startDate, $endDate);

        $this->assertDatabaseHas('available_times', [
            'id' => $result->id,
            'provider_id' => $provider->id,
            'start_time' => $startDate,
            'end_time' => $endDate,
        ]);
    }
}
