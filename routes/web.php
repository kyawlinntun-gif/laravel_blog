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

Route::get('/', 'Article\ArticleController@index');
Route::get('/articles', 'Article\ArticleController@index');
Route::get('/articles/detail/{id}', 'Article\ArticleController@detail');
Route::get('/articles/add', 'Article\ArticleController@add');
Route::post('/articles/add', 'Article\ArticleController@create');
Route::get('/articles/delete/{article}', 'Article\ArticleController@destroy');
Route::get('/comments/delete/{comment}', 'CommentController@destroy');
Route::post('/comments/add', 'CommentController@create');

// Route::get('articles/more', function(){
// 	return redirect()->route('articles.detail', 1);
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
