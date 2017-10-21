<?php

Route::group(['middleware' => 'web', 'prefix' => 'classes', 'namespace' => 'Modules\Classes\Http\Controllers'], function()
{
    Route::get('/', 'ClassesController@index');
});
