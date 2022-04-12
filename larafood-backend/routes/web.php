<?php

use App\Http\Controllers\Admin\PlansController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('plans')->name('plans.')->group(function() {
        Route::get('/', [PlansController::class, 'index'])->name('index');
        Route::get('/{plan}', [PlansController::class, 'show'])->name('show');
        Route::get('/create', [PlansController::class, 'create'])->name('create');

        Route::post('plans', [PlansController::class, 'store'])->name('store');
    });
});


Route::get('/', function () {
    return view('welcome');
});
