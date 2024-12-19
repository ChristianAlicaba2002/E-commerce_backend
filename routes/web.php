<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components/superAdmin/AdminAuth/LoginSuperAdmin');
})->name('LoginSuperAdmin');

Route::get('/Dashboard', function () {
    return view('components/superAdmin/pages/dashboard');
})->name('LoginSuperAdmin');

Route::get('/BranchAdminLoginPage', function () {
    return view('components/branchAdmin/AuthPage/LoginPage');
})->name('BranchAdminLoginPage');

Route::get('/BranchAdminRegisterPage', function () {
    return view('components/branchAdmin/AuthPage/RegisterPage');
})->name('BranchAdminRegisterPage');

Route::get('/DonMacPage', function () {
    // $products = DB::table('don_mac')->get();

    $products = DB::table('special_product')->get();
    $bestSeller = DB::table('user_order')->get();
    $customers = DB::table('user_order')->get();
    $quantity = DB::table('user_order')->sum('quantity');

    return view('components/branchAdmin/DonMacPage', compact('products', 'bestSeller', 'customers', 'quantity'));
})->name('DonMacPage');

Route::get('/SpecialProductPage', function () {
    $products = DB::table('special_product')->get();
    $bestSeller = DB::table('user_order')->get();
    $customers = DB::table('user_order')->get();
    $quantity = DB::table('user_order')->sum('quantity');

    return view('components/branchAdmin/SpecialProductPage', compact('products', 'bestSeller', 'customers', 'quantity'));
})->name('SpecialProductPage');

Route::get('/DonMacAllProducts', function () {
    $products = DB::table('don_mac')->get();

    return view('components/branchAdmin/DonMacAllProducts', compact('products'));
})->name('DonMacAllProducts');

Route::get('/AllSpecialProducts', function () {
    $products = DB::table('special_product')->get();

    return view('components/branchAdmin/SpecialAllProducts', compact('products'));
})->name('AllSpecialProducts');

Route::get('/OrdersPage', function () {
    $orders = DB::table('user_order')->get();

    return view('components/branchAdmin/OrdersPage', compact('orders'));
})->name('OrdersPage');

Route::get('/updateSpecialProduct/{id}', function () {
    $products = DB::table('special_product')->get();

    return view('components/branchAdmin/SpecialAllProducts', compact('products'));
})->name('updateSpecialProduct');

Route::get('/updateDonMacProduct/{id}', function ($id) {
    $product = DB::table('don_mac')->get();

    return view('components/branchAdmin/DonMacAllProducts', compact('product'));
})->name('updateDonMacProduct');

Route::get('/DeletedDonMacProducts', function () {
    $products = DB::table('deleted_donmac')->get();

    return view('components/branchAdmin/DeletedPage/DeletedDonMacProducts', compact('products'));
})->name('DeletedDonMacProducts');

Route::get('/DeletedSpecialProducts', function () {
    $products = DB::table('deleted_special')->get();

    return view('components/branchAdmin/DeletedPage/DeletedSpecialProducts', compact('products'));
})->name('DeletedSpecialProducts');

Route::get('/ForgotpassPage', function () {
    return view('components/branchAdmin/AuthPage/ForgotPassPage');
})->name('ForgotpassPage');

Route::get('/new-password/{branchname}/{firstname}/{lastname}', [AdminController::class, 'showNewPasswordForm'])->name('new.password.form');

//This function is Admin Login Route
// ... existing routes ...
Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//This function for SuperAdmin
Route::post('/superadmin/AdminAuth/login', [SuperAdminController::class, 'loginSuperAdmin'])->name('superadmin.login');
Route::post('/superadmin/logout', [SuperAdminController::class , 'logoutSuperAdmin'])->name('SuperAdmin.logout');











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
