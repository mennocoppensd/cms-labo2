<?php

use Illuminate\Support\Facades\Route;
use Woutermenno\Rating\Http\Controllers\RatingSettingsController;

Route::get('/rating', [RatingSettingsController::class, 'index']
)->name('rating.index');

Route::get('rating/add/{collection}', [RatingSettingsController::class, 'add']
)->name('rating.add');

// Route::name('rating.')->group(function () {
//     Route::get('rating', 'RatingController@index')->name('index');
//     Route::get('rating/{id}', 'RatingController@show')->name('show');
//     Route::post('rating', 'RatingController@store')->name('store');
//     Route::put('rating/{id}', 'RatingController@update')->name('update');
//     Route::delete('rating/{id}', 'RatingController@destroy')->name('destroy');
// });