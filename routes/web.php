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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/homeposts', 'HomePostsController@posts')->name('homeposts');

Route::resource('/api/users', 'AdminUsersController');
Route::resource('/api/posts', 'AdminPostsController');
Route::resource('/api/categories', 'AdminCategories');


Route::group(['middleware'=>'admin'], function(){

	Route::get('/admin/{vue_capture?}', function () {
	    return view('admin');
	})->where('vue_capture','[\/\w\.-]*');

});