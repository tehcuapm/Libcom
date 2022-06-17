<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["id", "order_date", "address_id", "user_id", "created_at", "updated_at"];

    public function getArticleQuantity(Article $article)
    {
        return DB::table("orders_articles")
            ->where("order_id", "=", $this->id)
            ->where("article_id", "=", $article->id)
            ->first("quantity")
            ->quantity;
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'orders_articles');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function getPrice(Article $article)
    {
        $price = DB::table('orders')->where("orders.id", "=", 3)
            ->join('orders_articles', 'orders.id', '=', 'orders_articles.order_id')
            ->join('articles', 'orders_articles.article_id', '=', 'articles.id')
            ->select('orders_articles.quantity', 'articles.price')->get();

        $price = $this->articles()->price;
        $quantity = $this->getArticleQuantity($article);
        return $price * $quantity;
    }

    public function getTotalPrice()
    {
        $articles = $this->articles()->get();
        $total = 0;

        $articles->each(function (Article $article) use (&$total) {
            $total += $article->price * $this->getArticleQuantity($article);
        });
        return $total;

    }
}
