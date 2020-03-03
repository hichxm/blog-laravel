<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::group([
    'middleware' => [
        RedirectIfAuthenticated::class
        ]
    ], function () {
        Route::view('/register', 'register')->name('register');
        Route::post('/register', 'Auth\RegisterController')->name('register');

        Route::view('/login', 'login');
        Route::post('/login', 'Auth\LoginController')->name('login');
});
