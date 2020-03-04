<?php

namespace Tests;

use App\User;
use Illuminate\Database\Eloquent\Model;
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
     * Assert that the model count
     *
     * @param int $count
     * @param Model $model
     * @return $this
     */
    public function assertModelCount(int $count, $model)
    {
        /** @var Model $instanciedModel */
        $instanciedModel = app($model);

        $this->assertCount($count, $instanciedModel->all(), "The model count {$instanciedModel->count()} != {$count}");

        return $this;
    }

    /**
     * Assert that the model is empty
     *
     * @param Model $model
     * @return $this
     */
    public function assertModelIsEmpty($model)
    {
        /** @var Model $instanciedModel */
        $instanciedModel = app($model);

        $this->assertEmpty($instanciedModel->all(), "The model {$instanciedModel->getTable()} is not empty ");

        return $this;
    }

    /**
     * Assert that the model is not empty
     *
     * @param Model $model
     * @return $this
     */
    public function assertModelIsNotEmpty($model)
    {
        /** @var Model $instanciedModel */
        $instanciedModel = app($model);

        $this->assertNotEmpty($instanciedModel->all(), "The model {$instanciedModel->getTable()} is empty ");

        return $this;
    }

    /**
     * Generate new user(s)
     *
     * @param array $data
     * @param integer $count
     * @return User[]|User
     */
    protected function createUser($data = [], $count = null)
    {
        if (!empty($data['password']))
            $data['password'] = bcrypt($data['password']);

        return factory(User::class, $count)->create($data);
    }

    /**
     * Connect user
     *
     * @param $user
     * @return void
     */
    protected function connectUser($user)
    {
        auth()->loginUsingId($user->id);
    }
}
