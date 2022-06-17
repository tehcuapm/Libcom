<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return view("auth.verify");
    }

    public function send()
    {
        //on envoie un mail au user
        Auth::user()->sendEmailVerificationNotification();
        return back()->with('success', 'link sent');
    }

    public function verify(EmailVerificationRequest $request)
    {
        //on met à jour le statut de verification
        $request->fulfill();
        return redirect()->to(route("article.index"));
    }
}
