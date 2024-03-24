<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailableTime extends Model
{
    use HasFactory;

    protected $table = 'available_times';

    protected $fillable = [
      'provider_id',
      'start_time',
      'end_time',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
