<?php

use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\RegisteredUserApiController;
use App\Http\Controllers\Api\SpecialProductController;
use App\Http\Controllers\Api\UserOrderController;
use App\Http\Controllers\SuperAdmin\BranchingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/storage/{imageName}', function ($imageName) {
    return response()->file(public_path('images/' . $imageName));
});

/**This function is for API Special Product */
Route::get('AllSpecialProduct', [SpecialProductController::class, 'getAllSpecialProduct']);

//User API
Route::post('/auth/Register', [RegisteredUserApiController::class, 'apiRegister']);
Route::post('/auth/Login', [RegisteredUserApiController::class, 'apiLogin']);
Route::get('ApiAllUserRegister', [RegisteredUserApiController::class, 'displayUser']);

// User Order API
Route::post('userOrder', [UserOrderController::class, 'store'])->name('api.user-order.store');
Route::get('TrackingNumber', [UserOrderController::class, 'GetUserOrder']);
Route::get('AllUserOrderApi', [UserOrderController::class, 'GetUserOrderApi']);
Route::post('/updateOrderStatus', [UserOrderController::class, 'updateStatus']);


Route::get('AllBranch', [BranchingController::class, 'getAllBranch']);
