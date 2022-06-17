<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //        View::composer('layouts.base', 'App\Http\ViewComposers\HeaderComposer');
        View::composer('catalog.product-form', 'App\Http\ViewComposers\ArticleFormComposer');
        View::composer('profile.edit-profile', 'App\Http\ViewComposers\EditProfileComposer');
        View::composer('profile.edit-address', 'App\Http\ViewComposers\EditAddressComposer');
        //
    }
}
