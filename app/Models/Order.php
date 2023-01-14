<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'option',
        'note',
        'date',
        'time',
        'adult',
        'child',
        'cost',
    ];

    public function scopeOfDate(Builder $query, string $date): Builder
    {
        return $query->where('date', $date);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('order')
        ->logAll()
        ->logOnlyDirty();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Anonymous',
        ]);
    }
}
