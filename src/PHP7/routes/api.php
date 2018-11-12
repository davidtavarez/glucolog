<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::post('register', 'AuthController@register')->name('auth.register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
    });
});

Route::group(['middleware' => ['auth:api', 'record']], function () {
    Route::prefix('records')->group(function () {
        Route::get('list', 'RecordController@list')->name('records.list');
        Route::get('/', 'RecordController@index')->name('records.index');
        Route::get('create', 'RecordController@create');
        Route::post('/', 'RecordController@store')->name('records.store');
        Route::get('/{record}', 'RecordController@show')->name('records.show');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', 'UserController@profile')->name('profile.show');
        Route::post('/', 'UserController@edit_profile')->name('profile.store');
    });

    Route::resource('users', 'UserController')->middleware('user');
    Route::resource('roles', 'RoleController')->middleware('role');
    Route::resource('weights', 'WeightController')->middleware('weight');

    //Get permissions
    Route::get('/permissions', 'RoleController@getPermissions');
});
