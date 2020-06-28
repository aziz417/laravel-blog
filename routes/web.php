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
    return view('frontend.welcome');
})->name('home');

Auth::routes();


Route::group(['as' => 'backend.admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' =>['auth', 'admin']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
});

Route::group(['as' => 'backend.author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' =>['auth', 'author']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});