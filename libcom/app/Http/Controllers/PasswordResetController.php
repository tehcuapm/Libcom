<?php

namespace App\Http\Controllers;


use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function forgotForm()
    {
        return view('auth.forgot');
    }

    public function resetForm($token, $email)
    {
        return view('auth.reset', ["token" => $token, "email" => $email]);
    }

    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            "email" => 'required|email|exists:users'
        ]);
        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? back()->with(['status' => "email sucessfully sent"])
            : back()->withErrors(["status" => "error when sent"]);

    }


    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ]);
            $user->save();

            event(new PasswordReset($user));
        });
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
