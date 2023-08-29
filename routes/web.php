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
    Route::get('/{index}', 'BlogController@blog')->name('blog');
    Route::post('/upload', 'BlogController@upload')->name('upload');
    Route::get('/delete/{image}', 'BlogController@delete')->name('delete');
});
