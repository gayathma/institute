<?php

Route::group(['middleware' => 'web', 'prefix' => 'classes', 'namespace' => 'Modules\Classes\Http\Controllers'], function()
{
    Route::get('/', 'ClassesController@index');
    Route::get('/new', 'ClassesController@create');
    Route::post('/new', 'ClassesController@store');
    Route::get('/edit', 'ClassesController@edit');
    Route::post('/edit', 'ClassesController@update');
    Route::get('/delete', 'ClassesController@destroy');
});
