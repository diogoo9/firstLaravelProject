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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('users','UsersController');

Route::group(['prefix'=>'/users'],function(){
    Route::get('/','UsersController@index');
    Route::get('/{id}','UsersController@show');
    Route::post('/','UsersController@store');
    Route::put('/{id}','UsersController@update');

});

Route::group(['prefix'=>'/skills'],function(){
    Route::get('/','SkillsController@index');

});

Route::group(['prefix'=>'/login'],function(){
    Route::post('/','AdminsController@login');
});



