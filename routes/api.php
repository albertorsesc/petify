<?php

Route::namespace('Api')->group(function () {
    
    Route::get('user-types', 'UserTypeController')->name('user-types.index');
    Route::apiResource('users', 'UserController');
    
    Route::apiResource('species', 'SpecieController');
    Route::apiResource('breeds', 'BreedController');

});
