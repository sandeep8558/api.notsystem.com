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
        'appliance_type',
        'appliance_logo',
        'serial_no',
        'port',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function machine(){
        return $this->belongsTo(Machine::class);
    }

    public function timers(){
        return $this->hasMany(Timer::class);
    }

    public function share_appliances(){
        return $this->hasMany(ShareAppliance::class);
    }
}
