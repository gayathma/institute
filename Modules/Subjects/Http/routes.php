<?php

Route::group(['middleware' => 'web', 'prefix' => 'subjects', 'namespace' => 'Modules\Subjects\Http\Controllers'], function()
{
    Route::get('/', 'SubjectsController@index');
	Route::get('/new', 'SubjectsController@create');
	Route::post('/new', 'SubjectsController@store');
	Route::get('/edit', 'SubjectsController@edit');
	Route::post('/edit', 'SubjectsController@update');
	Route::get('/delete', 'SubjectsController@destroy');
	Route::get('/instructors', 'SubjectsController@getInstructors');
});
