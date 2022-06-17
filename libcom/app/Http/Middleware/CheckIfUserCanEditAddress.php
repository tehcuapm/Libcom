<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfUserCanEditAddress
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

        $address = $request->address;
        $user = $request->user;
        $curr_user = Auth::user();
        if ($user != null && $user->id == $curr_user->id)
            return $next($request);

        if ($address != null && $address->user_id == $curr_user->id)
            return $next($request);
        return redirect()->back();
    }
}
