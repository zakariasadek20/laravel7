<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/','HomeController@home')->name('home');
Route::get('/about','HomeController@about')->name('about');
Route::resource('/posts','PostController');
// Route::resource('/posts','PostController')->middleware('auth');
Route::resource('/clients','ClientController')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','HomeController@dashboard')->name('dashboard');