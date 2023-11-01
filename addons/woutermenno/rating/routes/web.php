<?php

use Illuminate\Support\Facades\Route;
use Woutermenno\Rating\Http\Controllers\RatingSettingsController;
use Woutermenno\Rating\Http\Controllers\WebRatingController;

// get all ratings
Route::get('/', [WebRatingController::class, 'index']
)->name('rating-stars');

//make a post
Route::post('/store', [WebRatingController::class, 'store'])->name('rating.store');


// // make a post
// Route::post('/rating', [WebRatingController::class, 'store'])->name('web-addon.store');

