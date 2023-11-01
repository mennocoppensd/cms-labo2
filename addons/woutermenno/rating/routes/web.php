<?php

use Illuminate\Support\Facades\Route;
use Woutermenno\Rating\Http\Controllers\RatingSettingsController;
use Woutermenno\Rating\Http\Controllers\WebRatingController;

// get all ratings
Route::get('/rating', [WebRatingController::class, 'index']
)->name('rating-stars');

//make a post
Route::post('/rating/store', [WebRatingController::class, 'store'])->name('rating.store');


// // make a post
// Route::post('/rating', [WebRatingController::class, 'store'])->name('web-addon.store');

