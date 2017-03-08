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


Route::get('/mytest', [
    'uses' => 'TestController@index'
]);



Route::get('/article/publish', [
    'uses'       => 'ArticlesController@getPublish',
    'as'         => 'publishView',
    'middleware' => 'existView'
]);

Route::post('/article/publish', [
   'uses' => 'ArticlesController@postPublish',
    'as'  => 'publish',
]);

Route::get('/article/all', [
    'uses'       => 'ArticlesController@getAll',
    'as'         => 'allArticles',
//    'middleware' => 'existView'
]);

