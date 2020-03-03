<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __invoke(Request $request)
    {
        $login = $request->input('login');
        $loginType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credential[$loginType] = $login;
        $credential['password'] = $request->input('password');

        $auth = auth()->attempt($credential);

        if ($auth) {
            redirect(route('welcome'));
        }

        return back()->withErrors([
            'credential' => 'CREDENTIAL: ERROR'
        ]);
    }

}
