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

Route::get('/', function () {
    return view('home', ['message' => 'aaaaaaa']);
});

Route::post('register','UserController@register');

Route::get('user',function () {
    return view('user',['name' => 'taro', 'age' => '23']);
  });

Route::get('show', 'UserController@show');
