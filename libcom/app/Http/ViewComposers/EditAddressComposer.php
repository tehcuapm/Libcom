<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Khsing\World\Models\Continent;

/**
 * permet d'envoyer des elements à une vue sans pour autant créer de controlleurs
 * ici on a besoin d'acceder à toute les categories
 */
class EditAddressComposer
{


    public function compose(View $view)
    {
        $europe = Continent::getByName("Europe");
        $countries = $europe->children();
        return $view->with(["countries" => $countries]);
    }
}
