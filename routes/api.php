<?php

use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\UserOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/storage/{imageName}', function ($imageName) {
    return response()->file(public_path('images/'.$imageName));
});

/**This function is for API Don Macchiatos */
Route::get('allDonMacProduct', [DonMacController::class, 'getAllDonMacProduct']);

/**This function is for API Special Product */
Route::get('AllSpecialProduct', [SpecialProductController::class, 'getAllSpecialProduct']);

/**This function is for API User */
Route::get('ApiUser', [UserApiController::class, 'displayUser']);

// User Order API endpoint
Route::get('userOrder', [UserOrderController::class, 'store'])->name('api.user-order.store');

// Admin Register API endpoint
Route::get('UserRegister', [UserApiController::class, 'apiRegister'])->name('api.register');
// Admin Login API endpoint
Route::get('login', [UserApiController::class, 'apiLogin'])->name('api.login');

// User Order API endpoint
Route::post('userOrder', [UserOrderController::class, 'store'])->name('api.user-order.store');

// Admin Register API endpoint
Route::post('UserRegister', [UserApiController::class, 'apiRegister'])->name('api.register');
// Admin Login API endpoint
Route::post('login', [UserApiController::class, 'apiLogin'])->name('api.login');
