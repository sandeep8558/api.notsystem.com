<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'user_id',
        'place_id',
        'room_id',
        'serial_no',
        'ip_address',
        'ports',
        'state',
        'ts',
    ];
}
