<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    
    Route::namespace('Web')->group(function () {
        
        Route::get('species', 'SpeciesController')->name('web.species.index');
        
    });
    
});