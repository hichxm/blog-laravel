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


Route::post('logout', 'Auth\LogoutController')->name('logout');

Route::group([
    'where' => [
        'slug' => '[a-zA-Z0-9\-]+',
        'post' => '[0-9]+',
    ]
], function () {
    Route::get('post/{slug}-{post}')->name('post.show');
    Route::delete('post/{slug}-{post}', 'PostController@destroy')->name('post.destroy');
    Route::patch('post/{slug}-{post}')->name('post.update');
    Route::get('post/{slug}-{post}/edit')->name('post.edit');
    Route::resource('post', 'PostController')->except([
        'show', 'edit', 'update', 'destroy'
    ]);
});


Route::group([
    'middleware' => [
        RedirectIfAuthenticated::class
    ]
], function () {
    Route::view('/register', 'register')->name('register');
    Route::post('/register', 'Auth\RegisterController')->name('register');

    Route::view('/login', 'login')->name('login');
    Route::post('/login', 'Auth\LoginController')->name('login');
});
