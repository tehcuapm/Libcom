<?php

namespace App\Providers;

use App\Http\Controllers\PanierSession;
use App\Http\Interfaces\PanierInterface;
use Illuminate\Support\ServiceProvider;

class PanierServiceProvider extends ServiceProvider
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
        //on peut changer ici la methode de persistence du panier, à la volée
        $this->app->bind(PanierInterface::class, PanierSession::class);
    }
}
