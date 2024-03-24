<?php

namespace App\Modules\Resevations\Workflows;

use App\Models\Reservation;
use App\Modules\Resevations\Commands\ConfirmReservationCommand;
use Carbon\Carbon;

class ConfirmReservationWorkflow
{
    public function execute(int $reservationId): Reservation|null
    {

        $reservation = Reservation::find($reservationId);
        if(!$reservation) {
            return null;
        }
        if(!$this->isItOlderThan30Min($reservation->created_at)) {
            return null;
        }
        $command = new ConfirmReservationCommand();

        return $command->execute($reservation);
    }

    public function isItOlderThan30Min(Carbon $createdAt)
    {
        $now = Carbon::now();
        return $createdAt->greaterThanOrEqualTo($now->subMinutes(30));
    }
}
