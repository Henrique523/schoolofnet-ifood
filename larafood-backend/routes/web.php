<?php

use App\Http\Controllers\Admin\PlansController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [PlansController::class, 'index'])->name('index');

    Route::prefix('plans')->name('plans.')->group(function() {
        Route::any('/search', [PlansController::class, 'search'])->name('search');

        Route::get('/', [PlansController::class, 'index'])->name('index');
        Route::get('/create', [PlansController::class, 'create'])->name('create');
        Route::get('/{id}', [PlansController::class, 'show'])->name('show');

        Route::post('plans', [PlansController::class, 'store'])->name('store');

        Route::delete('/{id}', [PlansController::class, 'destroy'])->name('destroy');
    });
});


Route::get('/', function () {
    return view('welcome');
});
