<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareAppliance extends Model
{
    protected $fillable = [
        'user_id',
        'appliance_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function appliance(){
        return $this->belongsTo(Appliance::class);
    }

}
