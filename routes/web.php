<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalog', 'App\Http\Controllers\CatalogController@index')->name('catalog.index');
Route::get('/catalog/api', 'App\Http\Controllers\CatalogController@apiIndex')->name('catalog.apiIndex');
