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
//Common
Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::get('/language/{lang}', [
    'uses' => 'HomeController@changeLocale',
    'as' => 'locale'
]);


//users and auth
Route::get('users/one', [
    'uses' => 'UserController@getOne',
    'as' => 'oneUser'
]);

Route::get('/auth/register', [
    'uses' => 'Auth\RegisterController@showRegistrationForm',
    'as' => 'getRegister',

]);

Route::post('/auth/register', [
    'uses' => 'Auth\RegisterController@register',
    'as' => 'postRegister',
]);

Route::get('/auth/confirm/{confirmation_code}', [
    'uses' => 'Auth\RegisterController@confirmRegister'
]);

Auth::routes();


//articles
Route::get('/articles/all', [
    'uses'       => 'BlogController@allPosts',
    'as'         => 'allArticles',
]);

Route::get('/article/{id}', [
    'uses' => 'BlogController@onePost',
    'as' => 'getOne'
]);

Route::get('/articles/{category}', [
   'uses' => 'BlogController@postsByCategory',
    'as' => 'getByCategories'
]);


    /*_______ADMINZONE_______*/
Route::get('adminzone/dashboard', [
    'uses' => 'Admin\BlogController@dashboard',
    'as' => 'dashboard'
]);

Route::get('adminzone/dashboard/newposts', [
	'uses' => 'Admin\BlogController@newPosts',
	'as' => 'newPosts'
]);


//categories
Route::get('adminzone/categories', [
    'uses' => 'Admin\CategoryController@allCategories',
    'as' => 'adminCategories'
]);

Route::post('adminzone/categories/create', [
   'uses' => 'Admin\CategoryController@createCategory',
    'as' => 'categoryCreate'
]);

Route::get('adminzone/categories/create', [
   'uses' => 'Admin\CategoryController@createCategoryView',
    'as' => 'categoryCreateView'
]);

Route::get('adminzone/categories/update/{id}', [
    'uses' => 'Admin\CategoryController@updateCategoryView',
    'as' => 'categoryUpdateView'
]);

Route::post('adminzone/categories/update', [
    'uses' => 'Admin\CategoryController@updateCategory',
    'as' => 'categoryUpdate'
]);

Route::post('adminzone/categories/delete', [
    'uses' => 'Admin\CategoryController@deleteCategory',
    'as' => 'categoryDelete'
]);

Route::get('adminzone/categories/seentoogle', [
	'uses' => 'Admin\CategoryController@toogleCategorySeen',
	'as' => 'toogleCategorySeen'
]);

Route::get('adminzone/categories/activetoogle', [
	'uses' => 'Admin\CategoryController@toogleCategoryActive',
	'as' => 'toogleCategoryActive'
]);


//posts
Route::get('adminzone/posts/all', [
   'uses' => 'Admin\BlogController@allPosts',
    'as' => 'adminPostsView'
]);

Route::get('adminzone/posts/create', [
    'uses' => 'Admin\BlogController@createPostView',
    'as' => 'createPostView'
]);

Route::post('adminzone/posts/create', [
    'uses' => 'Admin\BlogController@createPost',
    'as' => 'createPost'
]);

Route::post('adminzone/posts/delete', [
    'uses' => 'Admin\BlogController@deletePost', 
    'as' => 'deletePost'
]);

Route::get('adminzone/posts/update/{id}', [
    'uses' => 'Admin\BlogController@updatePostView',
    'as' => 'updatePostView'
]);

Route::post('adminzone/posts/update', [
    'uses' => 'Admin\BlogController@updatePost',
    'as' => 'updatePost'
]);

Route::get('/adminzone/posts/seentoogle', [
    'uses' => 'Admin\BlogController@tooglePostSeen',
    'as' => 'tooglePostSeen'
]);

Route::get('/adminzone/posts/activetoogle', [
    'uses' => 'Admin\BlogController@tooglePostActive',
    'as' => 'tooglePostActive'
]);


//users
Route::get('adminzone/users/all', [
   'uses' => 'Admin\UserController@allUsers',
    'as' => 'allUsers'
]);

Route::get('/adminzone/users/create', [
    'uses' => 'Admin\UserController@getCreateView',
    'as' => 'createUserView'
]);

Route::post('adminzone/users/create', [
    'uses' => 'Admin\UserController@create',
    'as' => 'createUser'
]);

Route::get('adminzone/users/toogleban', [
   'uses' => 'Admin\UserController@toogleBan',
    'as' => 'toogleUserBan'
]);

Route::post('adminzone/users/delete', [
	'uses' => 'Admin\UserController@deleteUser',
	'as' => 'deleteUser'
]);

Route::get('adminzone/users/toogleseen', [
	'uses' => 'Admin\UserController@toogleUserSeen',
	'as' => 'toogleUserSeen'
]);

