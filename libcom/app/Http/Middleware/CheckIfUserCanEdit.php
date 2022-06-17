<?php

namespace App\Http\Middleware;

use App\Helpers\UserHelper;
use Closure;
use Illuminate\Http\Request;

class CheckIfUserCanEdit
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
        if (UserHelper::checkProfile($request->user)) {
            return $next($request);
        }
        return redirect()->back();
    }


}
