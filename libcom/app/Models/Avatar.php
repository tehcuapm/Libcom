<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = ["name", "updated_at", "created_at", "path_file"];


    public function users()
    {
        return $this->belongsToMany(User::class, "images_users");
    }

    public function users_current()
    {
        return $this->hasMany(User::class);
    }
}
