<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfPublicProfileIsAccessible
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::find($request->id);
        if ($user->public_profile || (Auth::check() && $user->id == Auth::user()->id) || (Auth::user()->hasRole("admin"))) {

            return $next($request);
        }
        return redirect("/");
    }
}
