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

//blog routes
Route::prefix("/blog")->group(function () {
    Route::get('/', 'BlogController@index')->name('index');
    Route::get('/about', 'BlogController@about')->name('about');
    Route::post('/post', 'BlogController@post')->name('post');
    Route::delete('/delete', 'BlogController@deleteBlog')->name('deleteBlog');
    Route::get('/read/{id}', 'BlogController@read')->name('read');
    Route::post('/comment', 'BlogController@comment')->name('comment');
    Route::delete('/deleteComment', 'BlogController@deleteComment')->name('deleteComment');
});
