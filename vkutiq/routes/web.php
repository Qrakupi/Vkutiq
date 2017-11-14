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

Route::get('/','VideosController@showHome')->name('home');
Route::get('/test',function(){return view('test');});


Route::get('/search','VideosController@search');

Route::get('/login','SessionsController@show');
Route::post('/login','SessionsController@create');
Route::get('/logout','SessionsController@destroy');

Route::get('/register','RegistrationController@show');
Route::post('/register','RegistrationController@create');


Route::get('/profile/{page}','UserController@show');
Route::post('/profile/changeAvatar','UserController@changeAvatar');

Route::post('/profile/storeVideo','VideosController@store');
Route::get('/{video}','VideosController@show');
Route::post('/ratePost','VideosController@ratePost');

Route::post('/submitComment','CommentController@store');






