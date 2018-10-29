<?php

Route::group(['middleware' => ['auth']], function () {
    Route::resource('weights', 'WeightController')->middleware('weight');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'RecordController@index');

    Route::resource('users', 'UserController')->middleware('user');
    Route::resource('roles', 'RoleController')->middleware('role');

    Route::prefix('profile')->group(function () {
        Route::get('/', 'UserController@profile')->name('profile.show');
        Route::post('/', 'UserController@edit_profile')->name('profile.store');
    });
});

Route::group(['middleware' => ['auth', 'record']], function () {
    Route::prefix('records')->group(function () {
        Route::get('list', 'RecordController@list');
        Route::get('/', 'RecordController@index');
        Route::get('create', 'RecordController@create');
        Route::post('/', 'RecordController@store');
        Route::get('/{record}', 'RecordController@show');
    });
});

Auth::routes(['verify' => true]);
