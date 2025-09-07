<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharePlace extends Model
{
    protected $fillable = [
        'user_id',
        'place_id',
    ];
}
