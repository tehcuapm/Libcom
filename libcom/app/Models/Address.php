<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ["id", "order_address", "country", "user_id", "created_at", "updated_at"];

    public function getAlreadyOrderCount()
    {
        return Order::query()->where("address_id", "=", $this->id)->get()->count();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "address_id");
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
