<?php

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

Auth::routes();

// Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');
// Route::get('/p/create','PostController@create')->name('post.create');
// Route::get('/p/{post}','PostController@show')->name('post.show');
// Route::post('/p','PostController@store')->name('post.store');
// Route::get('profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
// Route::patch('profile/{user}', 'ProfileController@update')->name('profile.update');

Route::resource('/profile','ProfileController');

Route::resource('/p','PostController');

