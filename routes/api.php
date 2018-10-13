<?php

use Illuminate\Http\Request;
use App\Inshu;
use App\Http\Resources\InshuResource;
use App\Http\Resources\InshuCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:api')->get('/inshu/index', 'InshuController@index');
Route::middleware('auth:api')->get('/drink/index', 'DrinkController@index');
Route::middleware('auth:api')->get('/inshu/post', 'InshuController@post');
Route::middleware('auth:api')->get('/apiTest', 'InshuController@apiTest');
