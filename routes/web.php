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
Route::get('categories', 'HomeController@test')->name('test');

Auth::routes();

//subscribe route here
Route::POST('Subscriber', 'Frontend\SubscriberController@store')->name('subscribe.store');
Route::group(['middleware' => ['auth']], function (){
    Route::post('favorite/{post}/add', 'Frontend\FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}/store', 'CommentController@store')->name('comment.store');
});

//post details routes here
Route::get('post/details/{id}/{slug}', 'HomeController@details')->name('post.details');
//All posts route here
Route::get('all/posts', 'HomeController@allPost')->name('all.posts');

//post show by category
Route::get('category/{category}/{id}/posts', 'HomeController@categoryPosts')->name('category.post');

//post show by tag
Route::get('tag/{tag}/{id}/posts', 'HomeController@tagPosts')->name('tag.post');

//search post show
Route::get('search', 'HomeController@search')->name('search');

//author profile route here
Route::get('author/profile/{slug}/{id}', 'HomeController@authorPosts')->name('author.profile');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' =>['auth', 'admin']], function () {

    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
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
    Route::get('edit', 'AdminController@edit')->name('admin.edit');
    Route::PUT('admin/update/{user}', 'AdminController@update')->name('admin.update');

    //comments backend comment route
    Route::get('comment/all', 'ExtraController@commentIndex')->name('comment.index');
    Route::DELETE('comment/{comment}/destroy', 'ExtraController@commentDestroy')->name('comment.destroy');

    //author route
    Route::get('author/index', 'ExtraController@AuthorIndex')->name('author.index');
    Route::DELETE('author/{author}/destroy', 'ExtraController@AuthorDestroy')->name('author.destroy');

});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' =>['auth', 'author']], function () {
    Route::get('dashboard', 'AuthorController@dashboard')->name('dashboard');
    Route::resource('posts', 'PostController');

    //favorite post all route here
    Route::get('favorite/posts', 'ExtraController@index')->name('favorites.index');
    Route::get('favorite/post/{post}/show', 'ExtraController@show')->name('favorite.show');
    Route::put('favorite/post/{post}/destroy', 'ExtraController@destroy')->name('favorite.destroy');

    // author controller here
    Route::get('edit', 'AuthorController@edit')->name('author.edit');
    Route::PUT('author/update/{user}', 'AuthorController@update')->name('author.update');

    //comments backend comment route
    Route::get('comment/all', 'ExtraController@commentIndex')->name('comment.index');
    Route::DELETE('comment/{comment}/destroy', 'ExtraController@commentDestroy')->name('comment.destroy');
});

View::composer('frontend/element/footer', function ($view){
    $categories = App\Model\Category::all();
    $view->with('categories', $categories);
});

View::composer('frontend/element/header', function ($view){
    $categories = App\Model\Category::all();
    $view->with('categories', $categories);
});
