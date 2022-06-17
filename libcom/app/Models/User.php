<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory;
    use HasRoles;
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'last_connection', 'created_at', 'updated_at', 'current_avatar', 'public_profile'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    function avatars()
    {
        return $this->belongsToMany(Avatar::class, "avatars_users");
    }

    function avatar()
    {
        return $this->belongsTo(Avatar::class, "current_avatar");
    }
}
