<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterAndLoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_it_work()
    {
        $this->withoutExceptionHandling();

        $this->assertNotAuthenticated();
        $this->assertModelIsEmpty(User::class);

        $this->post(route('web.register'), [
            'username' => 'hichxm',
            'email' => 'hicham.slimani.fr@gmail.com',
            'password' => 'Hichxm123456',
            'password_confirmation' => 'Hichxm123456',
        ])
            ->assertRedirect(route('web.welcome'));

        $this->assertAuthenticated();
        $this->assertModelCount(1, User::class);

        $this->post(route('web.logout'))
            ->assertRedirect(route('web.welcome'));

        $this->assertNotAuthenticated();

        $this->post(route('web.login'), [
            'login' => 'hichxm',
            'password' => 'Hichxm123456',
        ])
            ->assertRedirect(route('web.welcome'));

        $this->assertAuthenticated();
    }

}
