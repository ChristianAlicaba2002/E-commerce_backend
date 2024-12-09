<?php

use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\RegisteredUserApiController;
use App\Http\Controllers\Api\SpecialProductController;
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

// Registered User API
Route::post('Register', [RegisteredUserApiController::class, 'apiRegister'])->name('api.register');

// Login User API
Route::post('Login', [RegisteredUserApiController::class, 'apiLogin'])->name('api.login');

/**This function is for API User */
Route::get('ApiUser', [RegisteredUserApiController::class, 'displayUser']);

// User Order API
Route::post('userOrder', [UserOrderController::class, 'store'])->name('api.user-order.store');

Route::get('TrackingNumber', [UserOrderController::class, 'GetUserOrder']);

Route::get('AllUserOrderApi', [UserOrderController::class, 'GetUserOrderApi']);

// Update Order Status API
Route::post('/updateOrderStatus', [UserOrderController::class, 'updateStatus']);
