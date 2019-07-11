<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::namespace('Web')->group(function () {
        Route::get('species', 'SpeciesController')->name('web.species.index');
        Route::get('breeds', 'BreedController')->name('web.breeds.index');
        Route::get('users', 'UserController@index')->name('web.users.index');

        /* My Routes */
        Route::prefix('me')->group(function () {
            Route::get('{user}', 'UserController@show')->name('web.users.show');
        });
    });
});
