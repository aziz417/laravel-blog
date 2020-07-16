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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

//subscribe route here
Route::POST('Subscriber', 'Frontend\SubscriberController@store')->name('subscribe.store');
Route::group(['middleware' => ['auth']], function (){
    Route::post('favorite/{post}/add', 'Frontend\FavoriteController@add')->name('post.favorite');
});

//post details routes here
Route::get('post/details/{id}/{slug}', 'HomeController@details')->name('post.details');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' =>['auth', 'admin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tags', 'TagController');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');

    Route::put('/post/{id}/approve', 'PostController@approve')->name('post.approve');
    Route::get('pending/post', 'PostController@pending')->name('post.pending');

    //favorite post all route here
    Route::get('favorite/posts', 'ExtraController@index')->name('favorites.index');
    Route::get('favorite/post/{post}/show', 'ExtraController@show')->name('favorite.show');
    Route::put('favorite/post/{post}/destroy', 'ExtraController@destroy')->name('favorite.destroy');

    //subscribe index route here
    Route::get('subscriber/index', 'SubscriberController@index')->name('subscriber.index');
    Route::DELETE('subscriber/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    // admin controller here


});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' =>['auth', 'author']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('posts', 'PostController');

    //favorite post all route here
    Route::get('favorite/posts', 'ExtraController@index')->name('favorites.index');
    Route::get('favorite/post/{post}/show', 'ExtraController@show')->name('favorite.show');
    Route::put('favorite/post/{post}/destroy', 'ExtraController@destroy')->name('favorite.destroy');


});
