<?php

Route::group(['middleware' => ['auth']], function () {
    Route::resource('weights', 'WeightController');
    Route::resource('records', 'RecordController');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

});

Auth::routes(['verify' => true]);
