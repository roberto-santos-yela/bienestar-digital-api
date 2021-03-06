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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
//});

Route::post('/create_user', 'UserController@store');
Route::post('/recover_password', 'UserController@recover_password');
Route::post('/user_login', 'UserController@user_login');

Route::get('/generate_password', 'UserController@generate_password');

Route::group(['middleware' => ['auth']], function () {

    Route::post('/store_app_data/{id}', 'UserController@store_app_data');
    Route::get('/get_user_data', 'UserController@get_user_data');
    Route::post('/create_restriction/{id}', 'UserController@create_restriction');
    Route::post('/change_user_password', 'UserController@change_user_password');
    Route::get('/get_time_diff/{id}', 'UserController@get_time_diff');
    
    Route::apiResource('/app', 'AppController');     
    Route::get('/get_app_details', 'AppController@get_app_details');
    Route::get('/get_app_statistics', 'AppController@get_app_statistics');
    Route::get('/get_app_coordinates/{app_name}/{app_date}', 'AppController@get_app_coordinates');

});


