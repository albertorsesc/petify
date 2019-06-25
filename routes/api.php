<?php

Route::namespace('Api')->group(function () {
    
    Route::get('user-types', 'UserTypeController')->name('user-types.index');
    Route::apiResource('species', 'SpecieController');

});
