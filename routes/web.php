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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::any('/', 'HomeController@index')->name('home');

Route::any('/home','HomeController@index');

Route::any('/launch','HomeController@launch');

Route::any('/comment/{id}','HomeController@comment');

Route::any('/reply/{id}','HomeController@reply');

Route::any('/delect/{id}','HomeController@delect');

Route::any('/delete_yanlun/{id}','HomeController@delete_yanlun');
