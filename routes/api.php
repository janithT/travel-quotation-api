<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\QuotationController;

Route::get('/up', function (Request $request) {
    return 'healthy';
});

// jwt auth i have setup in app.php / middleware
// guest routes
Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');


    // Authenticated routes
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

        // quotation routes
        Route::apiResource('quotation', QuotationController::class);

    });
});

