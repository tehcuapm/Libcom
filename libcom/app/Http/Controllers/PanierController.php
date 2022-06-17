<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\PanierInterface;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PanierController extends Controller
{
    protected $panier;

    public function __construct(PanierInterface $panier)
    {
        $this->panier = $panier;
    }

    public function getPanierView()
    {
        return view("panier.panier");
    }

    public function getPanierData()
    {
        $panier = $this->panier->mapToArticle();
        //on envoie bien les reponses en json pour
        //faciliter la lecture en js
        return response()->json(["panier" => $panier]);
    }

    public function getPanierQuantity()
    {
        $quantity = $this->panier->getTotalQuantity();

        return response()->json(["quantity" => $quantity]);
    }

    public function getPanierPrice()
    {
        return response()->json(["price" => $this->panier->getTotalPrice()]);
    }

    public function addArticle(Request $request)
    {
        $request->validate([
            "id" => "numeric|min:1",
            "quantity" => "numeric|integer|min:1"
        ]);
        $article = Article::find($request["id"]);
        if($article->stock>0){
            $this->panier->add($article, $request["quantity"]);
            return response()->json(["message" => "Product ${request["id"]} adding with class"]);
        }else{
            return response()->json(["message"=>"No stock"]);
        }

    }


    public function updateArticle(int $id, Request $request)
    {
        $article = Article::find($id);
        $validator = Validator::make($request->all(), [
            "quantity" => "numeric|integer|min:1"
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => "la quantité n'est pas valide"]);
        }
        $this->panier->update($article, $request["quantity"]);
        return response()->json(["message" => "article ${id} est maitenant à ${request["quantity"]}"]);
    }

    public function removeArticle(int $id, Request $request)
    {
        $article = Article::find($id);
        $quantity = $this->panier->getQuantity($article);
        $this->panier->remove($article->id);
        return response()->json(["data" => "product $article->id has been successfully removed"]);

    }

    public function clearPanier()
    {
        $this->panier->clearUser();
        return response()->json(["data" => "panier successfully clear"]);
    }

}
