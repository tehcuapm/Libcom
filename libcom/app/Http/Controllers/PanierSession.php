<?php

namespace App\Http\Controllers;

use App\Helpers\ArticleHelper;
use App\Http\Interfaces\PanierInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * on crée une classe pour chaque methode de persistance du panier(ex: ici on stocke dans la session
 * mais on aurait put le stocker dans la db
 * il faudra juste changer ce que laravel envoie par injection de dependances
 */
class PanierSession implements PanierInterface
{


    public function mapToArticle()
    {
        //permet de transformer la session en objets article avec sa quantité(plus facile dans la vue pour l'acces avec les
        //relations
        return array_map(function (array $item) {
            $article = Article::query()->where('id', $item["id"])->first();
            $path = ArticleHelper::handleImage($article);
            $article_arr = $article->toArray();
            $article_arr["path_file"] = $path;
            unset($article_arr["images"]);
            return array_merge(["quantity" => $item["quantity"]], $article_arr);

        }, $this->getAll());
    }

    public function getAll()
    {
        if (Auth::check()) {

            $id = Auth::user()->id;
            $paniers = $this->getPaniers();
            //on recupere le panier du user connecté
            $panier = array_key_exists($id, $paniers) ? $paniers[$id] : [];
        } else {
            $panier = [];
        }
        return $panier;
    }

    public function getPaniers()
    {

        return Session::get("paniers") != null ? Session::get("paniers") : [];
    }

    public function getTotalPrice()
    {
        $total = 0;

        foreach ($this->getAll() as $key => $item) {
            $article = Article::find($item["id"]);
            $total += $article->price * $item["quantity"];
        }

        return $total;

    }

    public function getTotalQuantity()
    {
        $total = 0;

        foreach ($this->getAll() as $key => $item) {
            $total += $item["quantity"];
        }

        return $total;

    }

    public function add(Article $article, $q)
    {
        $panier = $this->getAll();
        if (array_key_exists($article->id, $panier)) {
            $panier[$article->id]["quantity"] += $q;
        } else {
            $article_details = ["quantity" => $q, "id" => $article->id];
//            $article_details = $article->toArray();
//            $path = $article->images()->first();
//            $article_details = array_merge(["image_path" => $path->path_file], $article_details);
//            $article_details['quantity'] = $q;
            $panier[$article->id] = $article_details;
        }
        $this->updatePaniers($panier);

    }

    public function updatePaniers(array $userPanier)
    {
        $id = Auth::user()->id;
        $paniers = $this->getPaniers();
        $paniers[$id] = $userPanier;
        Session::put("paniers", $paniers);
        Session::save();
    }

    public function update(Article $article, $q)
    {
        $panier = $this->getAll();

        $panier[$article->id]["quantity"] = $q;

        $this->updatePaniers($panier);
    }

    public function remove(int $id)
    {
        $panier = $this->getAll();
        unset($panier[$id]);
        $this->updatePaniers($panier);
    }

    public function clearUser()
    {
        $this->updatePaniers([]);

    }

    public function clearAll()
    {
        Session::forget("paniers");
        Session::pull("paniers");
        Session::flush();
        Session::save();
    }

    public function getQuantity(Article $article)
    {
        $panier = $this->getAll();
        return $panier[$article->id]["quantity"];
    }
}
