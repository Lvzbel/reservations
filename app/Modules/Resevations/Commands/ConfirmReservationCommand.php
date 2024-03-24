<?php

namespace App\Modules\Resevations\Commands;

use App\Models\Reservation;

class ConfirmReservationCommand
{
    public function execute(Reservation $reservation)
    {
        $reservation->is_confirmed = true;
        $reservation->save();

        return $reservation;
    }
}
