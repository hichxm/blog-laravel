<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_if_user_is_authentified()
    {
        $this->createUser([
            'username' => 'hichxm',
            'password' => 'Hichxm123456'
        ]);

        $this->assertNotAuthenticated();

        $this->post(route('web.login'), [
            'login' => 'hichxm',
            'password' => 'Hichxm123456'
        ]);

        $this->assertAuthenticated();
    }

    /** @test */
    public function check_if_user_is_authentified_with_email_adresse()
    {
        $this->createUser([
            'email' => 'hicham.slimani.fr@gmail.com',
            'password' => 'Hichxm123456'
        ]);

        $this->assertNotAuthenticated();

        $this->post(route('web.login'), [
            'login' => 'hicham.slimani.fr@gmail.com',
            'password' => 'Hichxm123456'
        ]);

        $this->assertAuthenticated();
    }

    /** @test */
    public function check_if_user_is_not_authentified_with_bad_inputs()
    {
        $this->assertNotAuthenticated();

        $this->post(route('web.login'))
            ->assertSessionHasErrors([
                'login', 'password'
            ]);

        $this->assertNotAuthenticated();
    }

    /** @test */
    public function check_if_user_is_not_authentified_with_bad_credential()
    {
        $this->assertNotAuthenticated();

        $this->post(route('web.login'), [
            'login' => 'bad_username',
            'password' => 'bad_password'
        ])
            ->assertSessionHasErrors([
                'credential'
            ]);

        $this->assertNotAuthenticated();
    }

    /** @test */
    public function check_if_user_is_redirected()
    {
        $this->createUser([
            'username' => 'hichxm',
            'password' => 'Hichxm123456'
        ]);

        $this->post(route('web.login'), [
            'login' => 'hichxm',
            'password' => 'Hichxm123456'
        ])
            ->assertRedirect(route('web.welcome'));
    }

    /** @test */
    public function check_if_connected_user_as_redirect_in_logins_route()
    {
        $this->createUser([
            'username' => 'hichxm',
            'password' => 'Hichxm123456'
        ]);

        $this->post(route('web.login'), [
            'login' => 'hichxm',
            'password' => 'Hichxm123456'
        ]);

        $this->assertAuthenticated();

        $this->get(route('web.login'))
            ->assertRedirect(route('web.welcome'));
    }

}
