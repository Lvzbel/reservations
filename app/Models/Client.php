<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $visible = ['id', 'name', 'email'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
