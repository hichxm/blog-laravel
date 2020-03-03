<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_if_is_registred()
    {
        $this->assertModelIsEmpty(User::class);

        $this->post(route('web.register'), [
            'username' => 'hichxm',
            'email' => 'hicham.slimani.fr@gmail.com',
            'password' => 'Hichxm123456',
            'password_confirmation' => 'Hichxm123456',
        ]);

        $this->assertModelIsNotEmpty(User::class);
    }

    /** @test */
    public function check_if_user_is_not_registred_with_bad_email_and_password()
    {
        $this->assertModelIsEmpty(User::class);

        $this->post(route('web.register'), [
            'username' => 'hichxm',
            'email' => 'hicham.slimani.fr@',
            'password' => 'Hichxm123456',
            'password_confirmation' => 'Hichx23456',
        ])
            ->assertSessionHasErrors([
                'email', 'password'
            ]);

        $this->assertModelIsEmpty(User::class);
    }

    /** @test */
    public function check_if_user_is_not_registred_with_double_email()
    {
        $this->createUser([
            'email' => 'hicham.slimani.fr@gmail.com'
        ]);

        $this->assertModelCount(1, User::class);

        $this->post(route('web.register'), [
            'username' => 'hichxm',
            'email' => 'hicham.slimani.fr@gmail.com',
            'password' => 'Hichxm123456',
            'password_confirmation' => 'Hichxm123456',
        ])
            ->assertSessionHasErrors([
                'email'
            ]);

        $this->assertModelCount(1, User::class);
    }

}
