<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareRoom extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
