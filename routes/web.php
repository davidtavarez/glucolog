<?php

Route::resource('weights', 'WeightController');
Route::resource('records', 'RecordController');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');