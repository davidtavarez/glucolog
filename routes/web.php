<?php


Route::group(['middleware' => ['User']], function () {
    Route::get('/pesos/create', 'PesoController@create');
    Route::post('/pesos', 'PesoController@store');

    Route::get('/records/create', 'RecordController@create');
    Route::post('/records', 'RecordController@store');
});

Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/records', 'RecordController@index');
Route::get('/pesos', 'PesoController@index');

Route::get('/records/{record}', 'RecordController@show');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/create', 'AdminController@create');
Route::post('/admin', 'AdminController@store');
Route::get('/admin/{user}/edit', 'AdminController@edit');
Route::put('/admin/{user}', 'AdminController@update');
Route::delete('/admin/{user}', 'AdminController@destroy');