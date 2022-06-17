<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ArticleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('catalog.catalog', ["products" => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        //
        $article = Article::find($id);
        return view('catalog.product', ["article" => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
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
        $validated = $request->validate([
            "title" => 'required|min:3|max:50',
            "speech" => 'required',
            "stock" => 'required',
            "price" => 'required',
            "category_id" => 'required',
            "image_id" => 'required'
        ]);


        // $updateTime = Carbon::now('Europe/Paris');

        //on recupere l'image et l'article avec l'id
        $image = Image::query()->where("id", "=", $validated['image_id'])->get();
        $article = Article::query()->where("id", "=", $id)->first();

        unset($validated["image_id"]);
        //on met à jour les infos de l'article
        $article->update($validated);
        //et son image(possibilité dans le futur d'avoir plusieurs images par exemple pour les faire
        // defiler(pas implementé)
        $article->images()->sync($image);

        return Redirect::to("article/$id");
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
