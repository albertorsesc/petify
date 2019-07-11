<?php

Route::namespace('Api')->group(function () {
    Route::get('user-types', 'UserTypeController')->name('user-types.index');
    Route::put('users/{user}/toggle-status', 'UserController@toggleStatus')->name('users.toggle-status');
    Route::apiResource('users', 'UserController');

    Route::apiResource('species', 'SpecieController');
    Route::put('breeds/{breed}/toggle-status', 'BreedController@toggleStatus')->name('breeds.toggle-status');
    Route::apiResource('breeds', 'BreedController');
});
