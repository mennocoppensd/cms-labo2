<?php

use Illuminate\Support\Facades\Route;
use Woutermenno\Rating\Http\Controllers\RatingSettingsController;

// get all ratings
Route::get('/rating', [RatingSettingsController::class, 'index']
)->name('rating.index');


// make a post
Route::post('/rating', [RatingSettingsController::class, 'store'])->name('rating-addon.store');


// Delete a rating route
Route::delete('/delete-rating', [RatingSettingsController::class, 'delete'])->name('delete.rating');

// Get average rating route
// Edit a rating route
Route::get('/edit-rating', [RatingSettingsController::class, 'edit'])->name('edit.rating');


// add blueprint to collection
Route::post('/rating/addBlueprint', [RatingSettingsController::class, 'addBlueprint'])->name('rating.addBlueprint');