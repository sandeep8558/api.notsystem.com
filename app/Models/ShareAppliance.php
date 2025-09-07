<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareAppliance extends Model
{
    protected $fillable = [
        'user_id',
        'appliance_id',
    ];
}
