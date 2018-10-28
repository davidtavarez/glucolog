<?php

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('records')->group(function () {
        Route::get('list', 'RecordController@list');
        Route::get('/', 'RecordController@index');
        Route::get('create', 'RecordController@create');
        Route::post('/', 'RecordController@store');
        Route::get('/{record}', 'RecordController@show');
    });

    Route::resource('weights', 'WeightController');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index');


    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

});

Auth::routes(['verify' => true]);
