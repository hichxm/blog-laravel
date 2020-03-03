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
            'username' => 'hichxm',
            'password' => 'Hichxm123456'
        ]);

        $this->assertAuthenticated();
    }

}
