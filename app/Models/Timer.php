<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $fillable = [
        'appliance_id',
        'timer_type',
        'days',
        'from_date',
        'to_date',
        'from_time',
        'to_time',
        'is_timer_off',
    ];
}
