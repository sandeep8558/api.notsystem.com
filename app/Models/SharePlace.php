<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharePlace extends Model
{
    protected $fillable = [
        'user_id',
        'place_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }
}
