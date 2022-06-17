<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CheckVerify
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $redirectToRoute
     * @return Response|RedirectResponse|null
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && ($request->user()->hasVerifiedEmail() || !Config::get("constants.options.verify"))) {
            return $next($request);

        }
        return redirect()->route("verification.send");

    }
}
