<?php

namespace App\Modules\Resevations\Commands;

use App\Models\Reservation;
use Carbon\Carbon;

class CreateReservationCommand
{

    public function execute(int $providerId, int $clientId, Carbon $startTime, Carbon $endTime): Reservation
    {
        $reservation = new Reservation();
        $reservation->provider_id = $providerId;
        $reservation->client_id = $clientId;
        $reservation->start_time = $startTime;
        $reservation->end_time = $endTime;
        $reservation->save();

        return $reservation;
    }
}
