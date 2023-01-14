<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';

    protected $guarded = [];

    protected $casts = [
        'last_update' => 'datetime',
    ];

    public $timestamps = false;

    public function scopeOfDate(Builder $query, $date): Builder
    {
        return $query->where('date', $date);
    }
}
