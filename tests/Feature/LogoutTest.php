<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_user_as_logout()
    {
        $this->withoutExceptionHandling();

        $user = $this->createUser();
        auth()->loginUsingId($user->id);

        $this->assertAuthenticated();

        $this->post(route('web.logout'))
            ->assertRedirect();

        $this->assertNotAuthenticated();
    }

    public function check_if_user_as_cant_logout_witheout_login()
    {
        $this->assertNotAuthenticated();

        $this->post(route('web.logout'))
            ->assertUnauthorized();
    }

}
