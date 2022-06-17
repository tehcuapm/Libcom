<?php

namespace App\Models;

use App\Helpers\ArticleHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'stock', 'price', 'speech', 'category_id'];

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function images()
    {
        return $this->belongsToMany(Image::class, "images_articles");
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_articles');
    }

    public static function likeArticles($pattern)
    {
        $pattern = addslashes($pattern);
        $result = Article::query()->whereRaw('LOWER(`title`) LIKE ? ', [trim(strtolower($pattern)) . '%'])->get()->toArray();
        return array_map(function ($item) {
            return array_merge($item, ["path_file" => ArticleHelper::handleImage(Article::find($item["id"]))]);
        }, $result);


    }


}
