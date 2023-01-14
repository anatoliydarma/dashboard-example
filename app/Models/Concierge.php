<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concierge extends Model
{
    public $timestamps = false;
    protected $table = 'concierges';
    protected $guarded = [];
}
