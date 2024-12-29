<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;
use App\Http\Controllers\SuperAdmin\BranchingController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Branch Admin Login Page
Route::get('/', function () {
    $branches = DB::table('branches')->get();
    $totalRevenue = DB::table('user_order')->sum(DB::raw('quantity'));
    $totalCustomers = DB::table('user_order')->distinct('phoneNumber')->count();
    $totalOrders = DB::table('user_order')->count();

    return view('components/branchAdmin/AuthPage/LoginPage', compact('branches', 'totalRevenue', 'totalCustomers', 'totalOrders'));
})->name('LoginSuperAdmin');

//Super Admin Login Page
Route::get('/LoginSuperAdmin', function () {
    $branches = DB::table('branches')->get();
    $totalRevenue = DB::table('user_order')->sum(DB::raw('quantity'));
    $totalCustomers = DB::table('user_order')->distinct('phoneNumber')->count();
    $totalOrders = DB::table('user_order')->count();

    return view('components/superAdmin/AdminAuth/LoginSuperAdmin', compact('branches', 'totalRevenue', 'totalCustomers', 'totalOrders'));
})->name('LoginSuperAdmin');

Route::get('/BranchAdminLoginPage', function () {
    return view('components/branchAdmin/AuthPage/LoginPage');
})->name('BranchAdminLoginPage');

//All Don Mac Products
Route::get('/DonMacAllProducts', function () {
    $products = DB::table('don_mac')->where('branch_id', Auth::guard('branches')->user()->branch_id)->get();
    $bestSeller = DB::table('user_order')->get();
    $customers = DB::table('user_order')->get();
    $quantity = DB::table('user_order')->sum('quantity');

    return view('components/branchAdmin/atoms/DonMacAllProducts', compact('products', 'bestSeller', 'customers', 'quantity'));
})->name('DonMacAllProducts');

//All Special Products
Route::get('/AllSpecialProducts', function () {
    $products = DB::table('special_product')->where('branch_id', Auth::guard('branches')->user()->branch_id)->get();
    $bestSeller = DB::table('user_order')->get();
    $customers = DB::table('user_order')->get();
    $quantity = DB::table('user_order')->sum('quantity');

    return view('components/branchAdmin/atoms/SpecialAllProducts', compact('products', 'bestSeller', 'customers', 'quantity'));
})->name('AllSpecialProducts');

//Orders Page
Route::get('/OrdersPage', function () {
    $orders = DB::table('user_order')->get();

    return view('components/branchAdmin/OrdersPage', compact('orders'));
})->name('OrdersPage');

//Update Special Product
Route::get('/updateSpecialProduct/{id}', function () {
    $products = DB::table('special_product')->get();

    return view('components/branchAdmin/atoms/SpecialAllProducts', compact('products'));
})->name('updateSpecialProduct');

//Update Don Mac Product
Route::get('/updateDonMacProduct/{id}', function ($id) {
    $product = DB::table('don_mac')->get();

    return view('components/branchAdmin/DonMacAllProducts', compact('product'));
})->name('updateDonMacProduct');

//Deleted Don Mac Products
Route::get('/DeletedDonMacProducts', function () {
    $products = DB::table('deleted_donmac')->get();

    return view('components/branchAdmin/DeletedPage/DeletedDonMacProducts', compact('products'));
})->name('DeletedDonMacProducts');

//Deleted Special Products
Route::get('/DeletedSpecialProducts', function () {
    $products = DB::table('deleted_special')->get();

    return view('components/branchAdmin/DeletedPage/DeletedSpecialProducts', compact('products'));
})->name('DeletedSpecialProducts');

//Forgot Password
Route::get('/ForgotpassPage', function () {
    return view('components/branchAdmin/pages/ForgotPassPage');
})->name('ForgotpassPage');

Route::get('/new-password/{branch_name}/{first_name}/{last_name}/{address}/{email}', [AdminController::class, 'showNewPasswordForm'])->name('new.password.form');

Route::get('/DisplayBranchDashboard', function () {
    $branches = DB::table('branches')->where('branch_id', Auth::guard('branches')->user()->branch_id)->first();

    return view('components/branchAdmin/atoms/DisplayBranchesDashboard', compact('branches'));
})->name('DisplayBranchDashboard');

//This function is Admin Login Route
// ... existing routes ...
Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//This function for SuperAdmin
Route::post('/superadmin/AdminAuth/login', [SuperAdminController::class, 'loginSuperAdmin'])->name('superadmin.login');
Route::post('/superadmin/logout', [SuperAdminController::class, 'logoutSuperAdmin'])->name('SuperAdmin.logout');
//This function Adding Branches
Route::post('/branches', [BranchingController::class, 'AddBranch'])->name('Add.Branches');

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

Route::get('/DisplayBranchDashboard{id}', [AdminController::class, 'DisplayBranchDashboard'])->name('DisplayBranchDashboard');
Route::get('/moreBranchInformation/{id}/{branch_name}/{first_name}/{last_name}/{address}/{phone_number}/{email}/{status}', [BranchingController::class, 'moreBranchInformation'])->name('moreBranchInformation');
Route::post('/updateBranchInformation/{branch_id}', [AdminController::class, 'updateBranchInformation'])->name('updateBranchInformation');
