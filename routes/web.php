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

Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('post.index');

Route::post('/posts', 'App\Http\Controllers\PostController@store')->name('post.store');

Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('post.create');

Route::get('/posts/update', 'App\Http\Controllers\PostController@update');

Route::get('/posts/delete', 'App\Http\Controllers\PostController@delete');

Route::get('/posts/restore', 'App\Http\Controllers\PostController@restore');

Route::get('/posts/first_or_create', 'App\Http\Controllers\PostController@firstOrCreate');

Route::get('/posts/update_or_create', 'App\Http\Controllers\PostController@updateOrCreate');

Route::get('/posts/{post}', 'App\Http\Controllers\PostController@show')->name('post.show');

Route::get('/posts/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('post.edit');

Route::patch('/posts/{post}', 'App\Http\Controllers\PostController@update')->name('post.update');

Route::delete('/posts/{post}', 'App\Http\Controllers\PostController@destroy')->name('post.delete');

// views
Route::get('/about', 'App\Http\Controllers\AboutController@index')->name('about.index');

Route::get('/contacts', 'App\Http\Controllers\ContactsController@index')->name('contact.index');

Route::get('/main', 'App\Http\Controllers\MainController@index')->name('main.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
