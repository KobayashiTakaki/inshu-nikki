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
    //Auth::loginUsingId(1);
    //Auth::user()->update(['api_token' => str_random(60)]);
    return view('home');
  });
/*
Route::get('register', function(){
    return view('register');
  });
Route::post('register','UserController@register');
*/
Route::post('post', 'InshuController@post');

Route::get('user',function () {
    return view('user',['name' => 'taro', 'age' => '23']);
  });

Route::get('auth/twitter', 'Auth\LoginController@redirectToProvider');
Route::get('auth/twitter/callback', 'Auth\LoginController@handleProviderCallback');
//Route::get("auth/twitter/logout","Auth\LoginController@getLogout");

//Route::post('login', 'UserController@login');

//Route::get('logout', 'UserController@logout');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
