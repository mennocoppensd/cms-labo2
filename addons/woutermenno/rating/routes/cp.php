<?php

use Illuminate\Support\Facades\Route;
use Woutermenno\Rating\Http\Controllers\RatingSettingsController;

// get all ratings
Route::get('/rating', [RatingSettingsController::class, 'index']
)->name('rating.index');


// make a post
Route::post('/rating', [RatingSettingsController::class, 'store'])->name('rating-addon.store');


// Delete a rating route
Route::delete('/rating', [RatingSettingsController::class, 'delete'])->name('delete.rating');

// Get average rating route
// Edit a rating route
Route::get('/edit-rating', [RatingSettingsController::class, 'edit'])->name('edit.rating');

// Update a rating route
Route::put('/rating/{rating}', [RatingSettingsController::class, 'update'])->name('update.rating');



// add blueprint to collection
Route::post('/add-blueprint', [RatingSettingsController::class, 'addBlueprint'])->name('rating.add-blueprint');