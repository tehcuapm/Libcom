<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;
use Illuminate\Http\Request;

class HandleProductAdding
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $quantity = $request->quantity;
        $id = $request->id;
        $article = Article::find($id);
        if ($quantity == null) {

            $quantity = 1;
        }
        if ($article->stock - $quantity < 0) {
            $quantity = $article->stock;
        }
        if ($article->stock == 0) {
            return back()->with(["message" => "plus aucun article en stock"]);
        }
        $request["quantity"] = $quantity;
        return $next($request);
    }
}
