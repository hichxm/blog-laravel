<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * Assert that the user is not authenticated.
     *
     * @param  string|null  $guard
     * @return $this
     */
    public function assertNotAuthenticated($guard = null)
    {
        $this->assertFalse($this->isAuthenticated($guard), 'The user is authenticated');

        return $this;
    }

    /**
     * Generate new user(s)
     *
     * @param array $data
     * @param integer $count
     * @return User[]|User
     */
    protected function createUser($data = [], $count = 1)
    {
        if (!is_null($data['password']))
            $data['password'] = bcrypt($data['password']);

        return factory(User::class, $count)->create($data);
    }
}
