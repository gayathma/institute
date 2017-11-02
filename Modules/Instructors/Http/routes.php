<?php

Route::group(['middleware' => 'web', 'prefix' => 'instructors', 'namespace' => 'Modules\Instructors\Http\Controllers'], function()
{
    Route::get('/', 'InstructorsController@index');
    Route::get('/new', 'InstructorsController@create');
    Route::post('/new', 'InstructorsController@store');
    Route::get('/edit', 'InstructorsController@edit');
    Route::post('/edit', 'InstructorsController@update');
    Route::get('/delete', 'InstructorsController@destroy');
});
