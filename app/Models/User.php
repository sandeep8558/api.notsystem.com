<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function places(){
        return $this->hasMany(Place::class);
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

    public function share_rooms(){
        return $this->hasMany(ShareRoom::class);
    }

    public function share_appliances(){
        return $this->hasMany(ShareAppliance::class);
    }
}
