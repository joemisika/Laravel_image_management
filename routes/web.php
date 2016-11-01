<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

//Declare a new route rule for confirm deletion whilst using the resource routes for doing everything else - create, store, edit, update and delete except showing the item
Route::get('galleries/{galleries}/confirm', ['as'=>'galleries.confirm', 'uses'=>'GalleriesController@confirm']);
Route::resource('galleries', 'GalleriesController', ['except'=>['show']]);


Route::get('images/{images}/confirm', ['as'=>'images.confirm', 'uses'=>'ImagesController@confirm']);
Route::resource('images', 'ImagesController', ['except'=>['show']]);
