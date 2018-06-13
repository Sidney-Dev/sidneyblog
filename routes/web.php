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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/example', function(){
	return view('welcome');
});

Route::resource('/api/users', 'AdminUsersController');
Route::resource('/api/posts', 'AdminPostsController');
Route::resource('/api/categories', 'AdminCategories');


