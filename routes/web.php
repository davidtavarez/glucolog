<?php

Route::group(['middleware' => ['auth']], function () {
    Route::resource('weights', 'WeightController');
    Route::resource('records', 'RecordController');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
});

Auth::routes(['verify' => true]);
