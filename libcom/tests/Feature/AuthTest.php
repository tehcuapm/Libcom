<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_user_can_view_login_form()
    {
        $resp = $this->get(route("login.form"));
        $resp->assertSuccessful();
        $resp->assertViewIs('auth.login');
    }


    public function test_layout_has_login_when_not_auth()
    {
        $layout = $this->view("layouts.base");
        $layout->assertSee('Login');
    }


    public function test_layout_has_profile_and_logout_when_auth()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $layout = $this->view("layouts.base");
        $layout->assertSee("Logout");
        $layout->assertSee($user->name);
    }

    public function test_user_cant_view_login_form_when_auth()
    {
        $user = User::factory()->make();
        $resp = $this->actingAs($user)->get(route('login.form'));
        $resp->assertRedirect(route('home'));
    }

    public function test_user_is_login_with_correct_credentials()
    {
        $password = 'passwordtest';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);
        Auth::login($user);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_is_not_login_with_incorrect_password()
    {
        $password = 'passwordtest';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);
        $resp = $this->from(route('login.form'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'lol',
        ]);
        $resp->assertRedirect(route('login.form'));
        $resp->assertSessionHasErrors('password');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_cant_access_to_catalog_when_not_verified()
    {
        $password = 'passwordtest';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);
        Auth::login($user);
        $resp = $this->actingAs($user)->get(route('article.index'));
        $resp->assertRedirect(route('verification.notice'));

    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan("migrate:fresh");

        $this->artisan("world:init");
        $this->artisan("db:seed");


    }

}
