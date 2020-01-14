<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'LocationController@index')->name('home');
    Route::resource('location', 'LocationController');

});