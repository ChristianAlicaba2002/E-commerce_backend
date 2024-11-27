<?php

use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;
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
