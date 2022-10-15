<?php
/*
 * Created by Constantine M. Lapkin
 *
 * 15.10.2022
 */

use Illuminate\Support\Facades\Route;
use Constlapkin\Reviews\Http\Controllers\Api\ReviewController;

Route::get('', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::post('', [ReviewController::class, 'store'])->name('reviews.store');
Route::put('{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
