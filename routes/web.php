<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/pages/LandingPage');
})->name('LandingPage');

Route::get('/ForgotpassPage', function () {
    return view('/pages/ForgotPassPage');
})->name('ForgotpassPage');

Route::get('/DonMacPage', function () {
    $products = DB::table('don_mac')->get();

    return view('/components/DonMacPage', compact('products'));
})->name('DonMacPage');

Route::get('/SpecialProductPage', function () {
    $products = DB::table('special_product')->get();

    return view('/components/SpecialProductPage', compact('products'));
})->name('SpecialProductPage');

Route::get('/DonMacAllProducts', function () {
    $products = DB::table('don_mac')->get();

    return view('/atoms/DonMacAllProducts', compact('products'));
})->name('DonMacAllProducts');

Route::get('/AllSpecialProducts', function () {
    $products = DB::table('special_product')->get();

    return view('/atoms/SpecialAllProducts', compact('products'));
})->name('AllSpecialProducts');

Route::get('/updateSpecialProduct/{id}', function () {
    $products = DB::table('special_product')->get();

    return view('/atoms/SpecialAllProducts', compact('products'));
})->name('updateSpecialProduct');

Route::get('/updateDonMacProduct/{id}', function ($id) {
    $product = DB::table('don_mac')->get();

    return view('/atoms/DonMacAllProducts', compact('product'));
})->name('updateDonMacProduct');

Route::get('/DeletedDonMacProducts', function () {
    $products = DB::table('deleted_donmac')->get();

    return view('/atoms/DeletedPage/DeletedDonMacProducts', compact('products'));
})->name('DeletedDonMacProducts');

Route::get('/DeletedSpecialProducts', function () {
    $products = DB::table('deleted_special')->get();

    return view('/atoms/DeletedPage/DeletedSpecialProducts', compact('products'));
})->name('DeletedSpecialProducts');

Route::get('/new-password/{branchname}/{firstname}/{lastname}', [AdminController::class, 'showNewPasswordForm'])->name('new.password.form');

//This function is Admin Login Route
// ... existing routes ...
Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// This function is storing Data
Route::post('/addDonMacProducts', [DonMacController::class, 'addDonMacProducts']);
Route::post('/addspecialproducts', [SpecialProductController::class, 'addSpecialProducts']);

//This function is updating Data
Route::put('/updateSpecialProduct/{id}', [SpecialProductController::class, 'updateSpecialProduct'])->name('updateSpecialProduct');
Route::put('/updateDonMacchiatosProduct/{id}', [DonMacController::class, 'updateDonMacchiatosProduct'])->name('updateDonMacchiatosProduct');

//This function is Deleting Data
Route::delete('/deleteEachSpecialProduct/{id}', [SpecialProductController::class, 'deleteEachSpecialProduct'])->name('deleteEachSpecialProduct');
Route::delete('/deleteEachDonmacchiatosProduct/{id}', [DonMacController::class, 'deleteEachDonmacProduct'])->name('deleteEachDonmacchiatosProduct');

// This funciton is Restoring Data
Route::post('/restoringSpecialData{id}', [SpecialProductController::class, 'RestoringSpecialProduct']);
Route::post('/restoringDonmacData{id}', [DonMacController::class, 'restoringDonmacData']);

//This function is for Forgot password
Route::post('/confirmation', [AdminController::class, 'forgotPassword'])->name('confirmation');

//This function is for Reset Password
Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('reset.password');
