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

Route::get('/itemCRUD/{id}','ItemCRUDController@show')->name('show.comment');
Route::resource('itemCRUD','ItemCRUDController');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/comment/{id}','CommentController@postcomment')->name('comment.post');

