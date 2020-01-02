<?php

use Illuminate\Http\Request;

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

Route::post('/create_user', 'UserController@store');
Route::post('/recover_password', 'UserController@recover_password');
Route::post('/user_login', 'UserController@user_login');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/get_user_data', 'UserController@get_user_data');

});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
//});
