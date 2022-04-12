<?php

use App\Http\Controllers\Api\Admin\PlansController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('plans')->name('plans.')->group(function () {
        Route::get('/{id}', [PlansController::class, 'show'])->name('show');

        Route::post('/store', [PlansController::class, 'store'])->name('store');

        Route::delete('/{id}', [PlansController::class, 'store'])->name('destroy');
    });
});
