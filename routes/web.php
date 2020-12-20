<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/app/login', 'loginController@index');
Route::post('/app/login', 'loginController@verify');
Route::get('/app/logout', 'logoutController@index');
Route::group(['middleware'=>['sess']], function(){

	Route::get('/app/home', 'AppController@index')->middleware('sess')->name('home.home');
	//Route::get('/app/userlist', 'AppController@userlist');
    Route::get('/app/userlist','AppController@userlist')->name('home.userlist');
    Route::get('/app/create', 'AppController@create')->name('home.create');
	Route::post('/app/create', 'AppController@store');
	Route::get('/app/users', 'AppController@index2');
	Route::get('/app/search','AppController@search')->name('search');
	Route::get('/app/user/edit/{id}', 'AppController@edit')->name('home.edit');
	Route::post('/app/user/edit/{id}', 'AppController@update');
	Route::get('/app/delete/{id}', 'AppController@delete');
	Route::post('/app/delete/{id}', 'AppController@destroy');
});
Route::resource('/app','AppController');
