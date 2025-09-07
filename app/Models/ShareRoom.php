<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareRoom extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
    ];
}
