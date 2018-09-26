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

Route::get('/', 'HomeController@index');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/admin', 'UserController@adminIndex')->name('admin.index');

Route::get('/topic/category/{category}', 'TopicController@showByCategory')
    ->name('showByCat.Topic');

Route::resource('/topic', 'TopicController');
Route::resource('/profile', 'UserController');

route::resource('comment','CommentController',['only'=>['update','destroy']]);
Route::post('comment/create/{topic}','CommentController@addComment')->name('topicComment.store');
Route::post('reply/create/{comment}','CommentController@replyComment')->name('commentReply.store');