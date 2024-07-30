<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
});

Route::prefix('reviews')->group(function () {
    Route::post('/', [ReviewController::class, 'store'])->name('products.store');
    Route::put('/{review}', [ReviewController::class, 'update'])->name('products.update');
    Route::delete('/{review}', [ReviewController::class, 'destroy'])->name('products.destroy');
});
