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

Route::get('/', function(){
    return view('home');
  });
/*
Route::get('register', function(){
    return view('register');
  });
Route::post('register','UserController@register');
*/
Route::post('post', 'InshuController@post');

Route::get('auth/twitter', 'Auth\LoginController@redirectToProvider');
Route::get('auth/twitter/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('logout', 'Auth\LoginController@logout' );

//Auth::routes();
