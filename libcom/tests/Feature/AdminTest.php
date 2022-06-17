<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AdminTest extends TestCase
{

    public function test_if_guest_cant_access_to_admin()
    {
        $resp = $this->get(route("admin"));
        $resp->assertForbidden();
    }

    public function test_if_normal_user_cant_access_to_admin()
    {
        $user = User::factory()->make();
        $resp = $this->actingAs($user)->get(route("admin"));
        $resp->assertForbidden();
    }

    public function test_if_admin_user_can_access_to_admin()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        Auth::login($user);
        $resp = $this->get(route("admin"));
        $resp->assertSuccessful();
        $this->assertTrue($user->hasRole("admin"));

    }

    public function test_if_admin_can_access_create_form()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        Auth::login($user);
        $resp = $this->get(route("admin.createArticle"));
        $resp->assertSuccessful();
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan("migrate:fresh");
        $this->artisan("world:init");
        $this->artisan("db:seed");

    }

}
