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



Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/server','AjaxController@inboxAjax');

Route::post('/send','SendMailControler@sendMail');

Route::get('/profile','ProfileController@getProfile');

Route::post('/profile','ProfileController@changeProfile');

Route::get('/users','UserController@getUsers');

Route::get('/add','UserController@addUser');

Route::get('/block','UserController@blockUser');