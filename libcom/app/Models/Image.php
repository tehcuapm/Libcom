<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ["name", "updated_at", "created_at", "path_file"];


    public function articles()
    {
        return $this->belongsToMany(Article::class, "images_articles");
    }

}
