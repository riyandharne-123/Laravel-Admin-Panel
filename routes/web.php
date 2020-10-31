<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


//basic route
Route::get('/', function () {
    return view('welcome');
});

//auth routes
Auth::routes();

//profile route
Route::get('/home', 'HomeController@index')->name('home');
//uploading profile picture
Route::post('/uploadImg','UserController@upload');

//todos start here
Route::get('/todos', 'TodoController@index');

Route::post('/todos/create', 'TodoController@store');

Route::post('/todos/delete', 'TodoController@destroy');

Route::post('/todos/edit', 'TodoController@edit');

//Admin Routes
Route::get('/admin', 'AdminController@index');

Route::post('/users/create', 'AdminController@store');

Route::post('/users/delete', 'AdminController@destroy');

Route::post('/users/update', 'AdminController@update');