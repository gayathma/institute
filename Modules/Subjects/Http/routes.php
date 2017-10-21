<?php

Route::group(['middleware' => 'web', 'prefix' => 'subjects', 'namespace' => 'Modules\Subjects\Http\Controllers'], function()
{
    Route::get('/', 'SubjectsController@index');
});
