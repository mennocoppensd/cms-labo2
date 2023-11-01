<?php

use Illuminate\Support\Facades\Route;
use Woutermenno\Rating\Http\Controllers\RatingSettingsController;

// get all ratings
Route::get('/rating', [RatingSettingsController::class, 'index']
)->name('rating.index');

// Route::get('rating/add/{collection}', [RatingSettingsController::class, 'add']
// )->name('rating.add');

// make a post
Route::post('/rating', [RatingSettingsController::class, 'store'])->name('rating-addon.store');

// delete a rating  route
Route::delete('/delete-rating/{rating}', [RatingSettingsController::class, 'delete'])->name('delete.rating');

// get average rating route
// edit a rating route
Route::get('/edit-rating/{rating}', [RatingSettingsController::class, 'edit'])->name('edit.rating');

Route::put('/update-rating/{rating}', [RatingSettingsController::class, 'update'])->name('update.rating');


// add blueprint to collection
Route::post('/rating/addBlueprint', [RatingSettingsController::class, 'addBlueprint'])->name('rating.addBlueprint');