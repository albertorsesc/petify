<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    
    Route::namespace('Web')->group(function () {
        
        Route::get('species', 'SpeciesController')->name('web.species.index');
        
        Route::get('users', 'UserController@index')->name('web.users.index');
        Route::get('users/{user}', 'UserController@show')->name('web.users.show');
        
    });
    
});