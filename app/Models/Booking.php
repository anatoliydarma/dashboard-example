<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $guarded = [];

    protected $casts = [
        'tour_date' => 'date',
    ];

    public function scopeOfDate(Builder $query, string $date): Builder
    {
        return $query->whereDate('tour_date', $date);
    }
}
