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

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::get('/language/{lang}', [
    'uses' => 'HomeController@changeLocale',
    'as' => 'locale'
]);

//Route::get('/language/{lang}', function($lang) {
//   \App::setLocale($lang);
//    return redirect()->back();
//});

Route::get('/test', [
        'uses' => 'ArticlesController@test'
    ]
//    return view('test');

);


Route::get('/mytest', [
    'uses' => 'TestController@index'
]);



Route::get('/article/publish', [
    'uses'       => 'BlogController@getPublish',
    'as'         => 'publishView',
]);

Route::post('/article/publish', [
   'uses' => 'BlogController@postPublish',
    'as'  => 'publish'
]);

Route::get('/articles/all', [
    'uses'       => 'BlogController@getAll',
    'as'         => 'allArticles',
//    'middleware' => 'existView'
]);

Route::get('/auth/register', [
    'uses' => 'Auth\RegisterController@showRegistrationForm',
    'as' => 'getRegister',
    
]);

Route::post('/auth/register', [
    'uses' => 'Auth\RegisterController@register',
    'as' => 'postRegister',
]);

Route::get('/article/{id}', [
    'uses' => 'BlogController@getOne',
    'as' => 'getOne'
]);

Route::get('/articles/{category}', [
   'uses' => 'BlogController@getByCategories',
    'as' => 'getByCategories'
]);

Route::get('/auth/confirm/{confirmation_code}', [
    'uses' => 'Auth\RegisterController@confirmRegister'
]);

//Route::get('/user/registration', [
//    'uses' => 'UserController@getRegistration',
//    'as'   => 'userReg',
//]);









Route::get('adminzone', [
    'uses' => 'Admin\HomeController@dashboard',
    'as' => 'dashboard'
]);

Route::get('adminzone/categories', [
    'uses' => 'Admin\CategoryController@getAll',
    'as' => 'adminCategories'
]);

Route::post('adminzone/categories/create', [
   'uses' => 'Admin\CategoryController@postCreate',
    'as' => 'categoryCreate'
]);
Route::get('adminzone/categories/create', [
   'uses' => 'Admin\CategoryController@getCreateView',
    'as' => 'categoryCreateView'
]);

Route::get('adminzone/categories/update/{id}', [
    'uses' => 'Admin\CategoryController@getUpdateView',
    'as' => 'categoryUpdateView'
]);

Route::post('adminzone/categories/update', [
    'uses' => 'Admin\CategoryController@postUpdate',
    'as' => 'categoryUpdate'
]);

Route::post('adminzone/categories/delete/', [
    'uses' => 'Admin\CategoryController@postDelete',
    'as' => 'categoryDelete'
]);

Route::get('adminzone/posts/all', [
   'uses' => 'Admin\BlogController@getAll',
    'as' => 'adminPostsView'
]);

Route::get('adminzone/posts/create', [
    'uses' => 'Admin\BlogController@getCreateView',
    'as' => 'createPostView'
]);

Route::post('adminzone/posts/create', [
    'uses' => 'Admin\BlogController@postCreate',
    'as' => 'createPost'
]);

Route::post('adminzone/posts/delete', [
    'uses' => 'Admin\BlogController@postDelete', 
    'as' => 'deletePost'
]);

Route::get('adminzone/posts/update/{id}', [
    'uses' => 'Admin\BlogController@getUpdateView',
    'as' => 'updatePostView'
]);

Route::post('adminzone/posts/update', [
    'uses' => 'Admin\BlogController@postUpdate',
    'as' => 'updatePost'
]);


Route::get('adminzone/users/all', [
   'uses' => 'Admin\UserController@getAll',
    'as' => 'allUsers'
]);

Route::get('/adminzone/posts/seentoogle', [
   'uses' => 'Admin\BlogController@tooglePostSeen',
    'as' => 'tooglePostSeen'
]);

Route::get('/adminzone/posts/activetoogle', [
    'uses' => 'Admin\BlogController@tooglePostActive',
    'as' => 'tooglePostActive'
]);






Route::post('adminzone/posts/order', [
    'uses' => 'Admin\BlogController@getAll',
    'as' => 'allPostsOrdered'
]);


Route::post('adminzone/article', [
    'uses' => 'Admin\BlogController@getOneAjax',
    'as' => 'getOneAdmin'
]);



//Route::get('laravel-ajax-pagination',array('as'=>'ajax-pagination','uses'=>'FileController@productList'));
Route::get('laravel-ajax-pagination',array('as'=>'ajax-pagination','uses'=>'FileController@productList'));

Auth::routes();

