<?php

namespace Tests\Feature\Reservations;

use App\Models\Client;
use App\Models\Provider;
use App\Models\Reservation;
use App\Modules\Resevations\Commands\ConfirmReservationCommand;
use Carbon\Carbon;
use Tests\TestCase;

class ConfirmReservationCommandTest extends TestCase
{
    public ConfirmReservationCommand $command;
    public function setUp(): void
    {
        parent::setUp();
        $this->command = new confirmReservationCommand();
    }

    public function test_it_confirms_reservation()
    {
        $provider = Provider::factory()->create();
        $client = Client::factory()->create();
        $reservation = Reservation::factory()->create([
            'provider_id' => $provider->id,
            'client_id' => $client->id,
            'start_time' => Carbon::tomorrow()->setHour(8)->setMinute(0),
            'end_time' => Carbon::tomorrow()->setHour(8)->setMinute(15),
        ]);

        // Verify Confirmation is not yet verify
        $this->assertDatabaseHas('reservations', [
            'provider_id' => $provider->id,
            'client_id' => $client->id,
            'is_confirmed' => false,
        ]);

        $result = $this->command->execute($reservation);
        $this->assertTrue($result->is_confirmed);
    }
}
