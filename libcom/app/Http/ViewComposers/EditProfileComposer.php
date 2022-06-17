<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * permet d'envoyer des elements à une vue sans pour autant créer de controlleurs
 * ici on a besoin d'acceder à toute les categories
 */
class EditProfileComposer
{


    public function compose(View $view)
    {
        $user = Auth::user();
        $avatars = $user->avatars()->get();
        $view->with('avatars', $avatars);
    }
}
