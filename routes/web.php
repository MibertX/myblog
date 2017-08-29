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
Route::group(['namespace' => 'Admin', 'middleware' => ['admin_access', 'admin_active']], function () {
	Route::get('adminzone/dashboard', [
		'uses' => 'BlogController@dashboard',
		'as' => 'dashboard'
	]);

	Route::get('adminzone/dashboard/newposts', [
		'uses' => 'BlogController@newPosts',
		'as' => 'newPosts'
	]);


//categories
	Route::get('adminzone/categories', [
		'uses' => 'CategoryController@allCategories',
		'as' => 'adminCategories'
	]);

	Route::post('adminzone/categories/create', [
		'uses' => 'CategoryController@createCategory',
		'as' => 'categoryCreate'
	]);

	Route::get('adminzone/categories/create', [
		'uses' => 'CategoryController@createCategoryView',
		'as' => 'categoryCreateView'
	]);

	Route::get('adminzone/categories/update/{id}', [
		'uses' => 'CategoryController@updateCategoryView',
		'as' => 'categoryUpdateView'
	]);

	Route::post('adminzone/categories/update', [
		'uses' => 'CategoryController@updateCategory',
		'as' => 'categoryUpdate'
	]);

	Route::post('adminzone/categories/delete', [
		'uses' => 'CategoryController@deleteCategory',
		'as' => 'categoryDelete'
	]);

	Route::get('adminzone/categories/seentoogle', [
		'uses' => 'CategoryController@toogleCategorySeen',
		'as' => 'toogleCategorySeen'
	]);

	Route::get('adminzone/categories/activetoogle', [
		'uses' => 'CategoryController@toogleCategoryActive',
		'as' => 'toogleCategoryActive'
	]);


//posts
	Route::get('adminzone/posts/all', [
		'uses' => 'BlogController@allPosts',
		'as' => 'adminPostsView'
	]);

	Route::get('adminzone/posts/create', [
		'uses' => 'BlogController@createPostView',
		'as' => 'createPostView'
	]);

	Route::post('adminzone/posts/create', [
		'uses' => 'BlogController@createPost',
		'as' => 'createPost'
	]);

	Route::post('adminzone/posts/delete', [
		'uses' => 'BlogController@deletePost',
		'as' => 'deletePost'
	]);

	Route::get('adminzone/posts/update/{id}', [
		'uses' => 'BlogController@updatePostView',
		'as' => 'updatePostView'
	]);

	Route::post('adminzone/posts/update', [
		'uses' => 'BlogController@updatePost',
		'as' => 'updatePost'
	]);

	Route::get('/adminzone/posts/seentoogle', [
		'uses' => 'BlogController@tooglePostSeen',
		'as' => 'tooglePostSeen'
	]);

	Route::get('/adminzone/posts/activetoogle', [
		'uses' => 'BlogController@tooglePostActive',
		'as' => 'tooglePostActive'
	]);


//users
	Route::get('adminzone/users/all', [
		'uses' => 'UserController@allUsers',
		'as' => 'allUsers'
	]);

	Route::get('/adminzone/users/create', [
		'uses' => 'UserController@createUserView',
		'as' => 'createUserView'
	]);

	Route::post('adminzone/users/createUser', [
		'uses' => 'UserController@createUser',
		'as' => 'createUser'
	]);

	Route::get('adminzone/users/toogleban', [
		'uses' => 'UserController@toogleUserBan',
		'as' => 'toogleUserBan'
	]);

	Route::post('adminzone/users/delete', [
		'uses' => 'UserController@deleteUser',
		'as' => 'deleteUser'
	]);

	Route::get('adminzone/users/toogleseen', [
		'uses' => 'UserController@toogleUserSeen',
		'as' => 'toogleUserSeen'
	]);


//comments
	Route::get('adminzone/comments/all', [
		'uses' => 'CommentController@commentsForAdmin',
		'as' => 'adminComments'
	]);

	Route::get('adminzone/comments/seentoogle', [
		'uses' => 'CommentController@toogleCommentSeen',
		'as' => 'toogleCommentSeen'
	]);

	Route::get('adminzone/comments/validtoogle', [
		'uses' => 'CommentController@toogleCommentValid',
		'as' => 'toogleCommentValid'
	]);

	Route::post('adminzone/comments/delete', [
		'uses' => 'CommentController@deleteComment',
		'as' => 'deleteComment'
	]);
});



