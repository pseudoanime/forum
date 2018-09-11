<?php

use App\Http\Controllers\ThreadController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/profiles/{user}", 'ProfilesController@show')->name('profiles');

Route::get('/threads/{channel}/{thread}', 'ThreadController@show');

Route::resource('threads', 'ThreadController', ['except' => 'show']);

Route::get('threads/{channel}', 'ThreadController@index');

Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store');

Route::post('replies/{reply}/favorites', 'FavoritesController@store');

Route::delete('replies/{reply}', 'ReplyController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
