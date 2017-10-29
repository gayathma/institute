<?php

Route::group(['middleware' => 'web', 'prefix' => 'students', 'namespace' => 'Modules\students\Http\Controllers'], function()
{
    Route::get('/', 'StudentsController@index');
    Route::get('/new', 'StudentsController@create');
    Route::post('/new', 'StudentsController@store');
    Route::get('/edit', 'StudentsController@edit');
    Route::post('/edit', 'StudentsController@update');
});
