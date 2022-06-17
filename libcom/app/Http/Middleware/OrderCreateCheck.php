<?php

namespace App\Http\Middleware;

use App\Http\Interfaces\PanierInterface;
use Closure;
use Illuminate\Http\Request;

class OrderCreateCheck
{

    /**
     * @var PanierInterface
     */
    private $panier;

    public function __construct(PanierInterface $panier)
    {
        $this->panier = $panier;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->panier->getTotalQuantity() == 0) {
            return redirect("/");
        }
        return $next($request);
    }
}
