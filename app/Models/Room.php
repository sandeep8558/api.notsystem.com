<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'user_id',
        'place_id',
        'room_name',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function appliances(){
        return $this->hasMany(Appliance::class);
    }

    public function machines(){
        return $this->hasMany(Machine::class);
    }

    public function share_rooms(){
        return $this->hasMany(ShareRoom::class);
    }
}
