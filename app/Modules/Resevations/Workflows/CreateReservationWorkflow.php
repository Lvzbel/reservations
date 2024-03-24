<?php

namespace App\Modules\Resevations\Workflows;

use App\Models\Client;
use App\Models\Provider;
use App\Models\Reservation;
use App\Modules\Resevations\Commands\CreateReservationCommand;
use Carbon\Carbon;

class CreateReservationWorkflow
{
    public function execute(int $providerId, int $clientId, Carbon $startTime, Carbon $endTime): Reservation|null
    {
        // Provider exist?
        if (!Provider::find($providerId)) {
            return null;
        }
        // Client exist?
        if (!Client::find($clientId)) {
            return null;
        }
        // Verify duration is 15min
        if (!$this->verifyDuration($startTime, $endTime)) {
            return null;
        }
        // Is time slot available?

        $query = new CreateReservationCommand();

        return $query->execute($providerId, $clientId, $startTime, $endTime);
    }

    public function verifyDuration(Carbon $startTime, Carbon $endTime): bool
    {
        $allowedReservationMinutes = 15;
        $diffInMinutes = $startTime->diffInMinutes($endTime);

        if ($diffInMinutes != $allowedReservationMinutes) {
            return false;
        }
        return true;
    }
}
