<?php

use App\Http\Controllers\Admin\PlansController;
use Illuminate\Support\Facades\Route;

Route::get('admin/plans', [PlansController::class, 'index'])->name('plans.index');
Route::get('admin/plans/create', [PlansController::class, 'create'])->name('plans.create');
Route::post('admin/plans', [PlansController::class, 'store'])->name('plans.store');

Route::get('/', function () {
    return view('welcome');
});
