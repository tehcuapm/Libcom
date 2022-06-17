<?php

namespace App\Http\Middleware;

use App\Models\PasswordReset;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckResetToken
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
        $email = $request->route("email");
        $token = $request->route("token");
        $result = PasswordReset::query()
            ->where("email", "=", $email)
            ->first();

        if ($result != null && Hash::check($token, $result->token))
            return $next($request);
        return redirect()->back();
    }
}
