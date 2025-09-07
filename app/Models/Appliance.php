<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    protected $fillable = [
        'user_id',
        'place_id',
        'room_id',
        'machine_id',
        'appliance_name',
        'appliance_logo',
        'serial_no',
        'port',
    ];
}
