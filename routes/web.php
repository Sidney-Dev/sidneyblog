<?php
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('homepage');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
Route::get('/home', 'HomeController@index')->name('home');

/************************************************************
							API'S
************************************************************/
Route::get('/api/homeposts', 'HomePostsController@posts')->name('homeposts');
Route::resource('/api/users', 'AdminUsersController');
Route::resource('/api/posts', 'AdminPostsController');
Route::resource('/api/categories', 'AdminCategories');
Route::get('/api/loggedUser', 'AdminUsersController@loggUser')->name('singleUser');
Route::put('/api/updatedUser/{id}', 'AdminUsersController@updateUser')->name('singleUserUpdate');

Route::resource('/api/subscriber', 'SubscriberController');
/*Route::get('/admin/users{vue_capture?}', function () {
    return view('admin');
})->where('vue_capture','[\/\w\.-]*');*/

/************************************************************
		  				ADMIN ROUTES
************************************************************/
Route::group(['middleware'=>'admin'], function(){
	Route::get('/admin/users', 'AdminUsersController@users')->name('allusers');
	Route::resource('/admin/posts', 'AdminPostsController');
});

/************************************************************
					SUBSCRIBER ROUTE
************************************************************/
Route::group(['middleware'=>'subscriber'], function(){
	Route::get('/subscriber/{vue_capture?}', function () {
	    return view('homepage');
	})->where('vue_capture','[\/\w\.-]*');
});

/**********************************************************/

Route::get('/single/post/{slug}', 'AdminPostsController@single');
