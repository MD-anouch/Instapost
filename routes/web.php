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

// use Symfony\Component\Routing\Route;

// use Illuminate\Routing\Route;

use App\Mail\WelcomeMail;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function(){
    return new WelcomeMail();
});

Auth::routes();

Route::resource('/profile','ProfileController');

Route::resource('/p','PostController');

Route::resource('/comment','CommentController');

// Route::resource('/follow', 'FollowsController');
Route::post('followers/{user}', 'FollowsController@store');
// Route::post('/search','ProfileController@search')->name('search.store');
Route::get('/search','ProfileController@search')->name('search.store');
Route::post('like', 'PostController@likePost')->name('like');


// Route::get('/profile/{user}', 'ProfileController@show')->name('profile.show');
// Route::get('/p/create','PostController@create')->name('post.create');
// Route::get('/p/{post}','PostController@show')->name('post.show');
// Route::post('/p','PostController@store')->name('post.store');
// Route::get('profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
// Route::patch('profile/{user}', 'ProfileController@update')->name('profile.update');
// Route::post('followers/{user}', function () {
//     return ['success'];
// });
