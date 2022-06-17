<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Http\Interfaces\PanierInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{
    protected $panier;

    /*
     * on inject la dependance panier qui sera detectée par laravel
     * et prendra la bonne instance en fonction de ce qu'on à specifier à l'avance
     * ->principe solid
     */
    public function __construct(PanierInterface $panier)
    {
        $this->panier = $panier;
    }

    public function getRegisterForm()
    {
        return view('auth.register');
    }

    public function getLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required|min:3|max:50',
            "email" => 'required|unique:users,email',
            "password" => 'required|confirmed|min:6',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $loginDate = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
        $user = User::query()->create($validated);
        //on assigne de base le role non admin au user
        $user->assignRole('non-admin');
        //puis on lui assigne quelques avatars qui pourra changer
        UserHelper::initUserAvatars($user);
        Auth::login($user);
        //evenement declenché pour que le verify le prenne en compte
        //dans son listener(verification de compte par l'email)
        event(new Registered($user));
        //ajout d'une date de connection pour l'utilisateur
        User::query()->where("email", "=", $validated['email'])->update(['last_connection' => $loginDate]);
        return Redirect::to(route("verification.notice"));
    }

    public function login(Request $request)
    {
        $remember = (bool)$request->input('remember');
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $loginDate = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');


        if (Auth::attempt($user, $remember)) {
            User::query()->where("email", "=", $user['email'])->update(['last_connection' => $loginDate]);
            $request->session()->regenerate();
            return redirect()->intended(route("article.index"));
        }
        return back()->withErrors([
            'login-failed' => 'login failed'
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
