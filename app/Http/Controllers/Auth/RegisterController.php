<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\User;

class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->toArray());

        auth()->login($user);
    }

}
