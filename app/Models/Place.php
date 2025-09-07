<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'user_id',
        'place_name',
        'ssid',
        'pswd',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

    public function machines(){
        return $this->hasMany(Machine::class);
    }

    public function appliances(){
        return $this->hasMany(Appliance::class);
    }

    public function share_places(){
        return $this->hasMany(SharePlace::class);
    }
}
