<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $visible = ['id', 'name', 'email'];

    public function availableTimes(): HasMany
    {
        return $this->hasMany(AvailableTime::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
