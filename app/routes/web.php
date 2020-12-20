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
Route::get('/app/login', [loginController::class,'index']);
Route::post('/app/login', [loginController::class,'verify']);
Route::get('/app/logout', [logoutController::class,'index']);
Route::group(['middleware'=>['sess']], function(){

	Route::get('/app/home', [AppController::class,'index'])->middleware('sess')->name('home.home');
	//Route::get('/app/userlist', 'AppController@userlist');
    Route::get('/app/userlist',[AppController::class,'userlist'])->name('home.userlist');
    Route::get('/app/create', [AppController::class,'create'])->name('home.create');
	Route::post('/app/create', [AppController::class,'store']);
	Route::get('/app/users', [AppController::class,'index2']);
	Route::get('/app/search',[AppController::class,'search'])->name('search');
	Route::get('/app/user/edit/{id}', [AppController::class,'edit'])->name('home.edit');
	Route::post('/app/user/edit/{id}', [AppController::class,'update']);
	Route::get('/app/delete/{id}', [AppController::class,'delete']);
	Route::post('/app/delete/{id}', [AppController::class,'destroy']);
});
Route::resource('/app',AppController::class);
