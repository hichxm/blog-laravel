<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as TestsTestCase;

class CustomAssertingTest extends TestsTestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_if_model_assertions_works()
    {
        $this->assertModelIsEmpty(User::class);

        $this->createUser([], 10);

        $this->assertModelIsNotEmpty(User::class);
    }

    /** @test */
    public function check_if_authenticated_assertions_work()
    {
        $this->assertNotAuthenticated();

        /* create and connect user */
        $user = $this->createUser();
        auth()->loginUsingId($user->id);

        $this->assertAuthenticated();
    }

}
