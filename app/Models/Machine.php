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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function appliances(){
        return $this->hasMany(Appliance::class);
    }

}
