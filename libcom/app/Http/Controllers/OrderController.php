<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\PanierInterface;
use App\Models\Article;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Countries\Package\Countries;

class OrderController extends Controller
{
    /**
     * @var PanierInterface
     */
    private $panier;

    public function __construct(PanierInterface $panier)
    {
        $this->panier = $panier;
        $this->middleware('order')->only(["create", "store"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view("order.order", ["panier" => $this->panier->getAll()])->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "address_id" => "numeric|required",
            "order_date" => "required|after:today"
        ]);

        $validated["user_id"] = Auth::user()->id;
        //on recupere le panier de la session sous forme de models articles
        $panier_article = $this->panier->mapToArticle();
        //on crée une nouvelle commnande
        $order = Order::query()->create($validated);
        //on filtre les articles avec aucun stock
        $panier_article = array_filter($panier_article,function ($article){
            return $article["stock"]>0;
        });
        //puis on lui attache les articles correspondant
        foreach ($panier_article as $article) {
            $obj = Article::find($article["id"]);
            $curr_stock = $article["stock"];
            //en faisant attention de mettre le stock à jour
            $obj->update(["stock" => $curr_stock - $article["quantity"]]);
            //et d'utiliser la relation many to many du model
            $order->articles()->attach(
                $article["id"],
                ["quantity" => $article["quantity"]]
            );
        }
        //et on clear le panier du user
        $this->panier->clearUser();
        return redirect(route("article.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        return view("order.articles", ["order" => $order, "articles" => $order->articles()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
