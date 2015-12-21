<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('sign-up', ['as' => 'auth.sign_up', 'uses' => 'AuthenticationController@getSignUp']);
    Route::post('sign-up', ['as' => 'auth.sign_up.post', 'uses' => 'AuthenticationController@postRegister']);
});

