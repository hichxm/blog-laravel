<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request)
    {
        $login = $request->input('login');
        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credential[$loginType] = $login;
        $credential['password'] = $request->input('password');

        $auth = auth()->attempt($credential);

        if ($auth) {
            return redirect(route('web.welcome'));
        }

        return back()->withErrors([
            'credential' => 'CREDENTIAL: ERROR'
        ])->withInput();
    }

}
