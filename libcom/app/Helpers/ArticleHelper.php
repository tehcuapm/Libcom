<?php

namespace App\Helpers;

use App\Models\Article;

class ArticleHelper
{
    const DEFAULT_PATH = "storage/assets/default_article.png";

    public static function handleImage(Article $article)
    {
        $image = $article->images->first();
        return $image != null ? $image->path_file : ArticleHelper::DEFAULT_PATH;
    }


}
