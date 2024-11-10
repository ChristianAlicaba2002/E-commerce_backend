<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;

Route::get('/', function () {
    return view('/pages/LandingPage');
});
Route::get('/HomePage', function () {
    return view('/pages/HomePage');
})->name('HomePage');

Route::get('/DonMacPage' , function() {
    return view('/components/DonMacPage');
})->name('DonMacPage');

Route::get('/SpecialProductPage' , function() {
    return view('/components/SpecialProductPage');
})->name('SpecialProductPage');




/** This function is storing Data*/
Route::post('/addDonMacProducts', [DonMacController::class, 'addDonMacProducts']);
Route::post('/addspecialproducts', [SpecialProductController::class, 'addSpecialProducts']);

