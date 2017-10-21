<?php

Route::group(['middleware' => 'web', 'prefix' => 'instructors', 'namespace' => 'Modules\Instructors\Http\Controllers'], function()
{
    Route::get('/', 'InstructorsController@index');
});
