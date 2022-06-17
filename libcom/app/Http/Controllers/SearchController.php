<?php

namespace App\Http\Controllers;

use App\Helpers\ArticleHelper;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function searchArticle(Request $request)
    {

        $value = $request->value;
        $titleDB = Article::select('title')->get();


        $result = Article::likeArticles($value);

        return response()->json(["data" => $result]);
    }

    public function searchImage(Request $request)
    {
    }
}
