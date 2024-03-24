<?php

namespace Tests\Feature\Reservations;

use App\Models\Client;
use App\Models\Provider;
use App\Modules\Resevations\Commands\CreateReservationCommand;
use Carbon\Carbon;
use Tests\TestCase;

class CreateReservationCommandTest extends TestCase
{
    public CreateReservationCommand $command;
    public function setUp(): void
    {
        parent::setUp();
        $this->command = new CreateReservationCommand();
    }

    public function test_it_creates_reservation()
    {
        $provider = Provider::factory()->create();
        $client = Client::factory()->create();
        $startTime = Carbon::tomorrow()->setHour(8)->setMinute(00);
        $endTime = Carbon::tomorrow()->setHour(8)->setMinute(15);
        $result = $this->command->execute($provider->id, $client->id, $startTime, $endTime);

        $this->assertDatabaseHas('reservations', [
            'id' => $result->id,
            'provider_id' => $provider->id,
            'client_id' => $client->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }
}
