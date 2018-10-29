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
    Route::get('/', 'RecordController@index');


    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

    Route::prefix('profile')->group(function () {
        Route::get('/', 'UserController@profile')->name('profile.show');
        Route::post('/', 'UserController@edit_profile')->name('profile.store');
    });
});

Auth::routes(['verify' => true]);
