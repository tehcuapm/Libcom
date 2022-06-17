<?php

namespace App\Http\ViewComposers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\View\View;

/**
 * permet d'envoyer des elements à une vue sans pour autant créer de controlleurs
 * ici on a besoin d'acceder à toute les categories
 */
class ArticleFormComposer
{


    public function compose(View $view)
    {
        $view->with('categories', Category::all());
        $view->with('images', Image::all());
    }
}
