<?php

use App\Http\Controllers\Admin\PlansController;
use Illuminate\Support\Facades\Route;

Route::get('admin/plans', [PlansController::class, 'index'])->name('plans.index');

Route::get('/', function () {
    return view('welcome');
});
