<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::prefix('{product}')->group(function () {
        Route::get('/', [ProductController::class, 'show'])->name('products.show');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('products.reviews.index');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');
        Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('products.reviews.update');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('products.reviews.destroy');
    });
});