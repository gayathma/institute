<?php

Route::group(['middleware' => 'web', 'prefix' => 'students', 'namespace' => 'Modules\Students\Http\Controllers'], function()
{
    Route::get('/', 'StudentsController@index');
});
