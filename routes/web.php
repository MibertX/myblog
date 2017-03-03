<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::get('/test', function() {
    return view('test');
});

Route::get('/publish', [
    'uses' => 'ArticleController@getAdd'
]);

Route::post('publish', [
   'uses' => 'NewsController@postAdd'
]);

Route::get('/main', [
    'uses' => 'NewsController@getAll'
]);

