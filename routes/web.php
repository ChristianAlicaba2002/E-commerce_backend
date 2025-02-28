<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\UserExportController;
use App\Http\Controllers\Api\SpecialProductController;
use App\Http\Controllers\SuperAdmin\BranchExportController;
use App\Http\Controllers\SuperAdmin\BranchingController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Models\Exports\BranchExport;

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

// //All Don Mac Products
// Route::get('/DonMacAllProducts', function () {
//     $products = DB::table('don_mac')->where('branch_id', Auth::guard('branches')->user()->branch_id)->get();
//     $bestSeller = DB::table('user_order')->get();
//     $customers = DB::table('user_order')->get();
//     $quantity = DB::table('user_order')->sum('quantity');

//     return view('components/branchAdmin/atoms/DonMacAllProducts', compact('products', 'bestSeller', 'customers', 'quantity'));
// })->name('DonMacAllProducts');

//All Special Products
Route::get('/AllSpecialProducts', function () {
    $products = DB::table('products')->where('branch_id', Auth::guard('branches')->user()->branch_id)->get();
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
    $products = DB::table('products')->get();

    return view('components/branchAdmin/atoms/SpecialAllProducts', compact('products'));
})->name('updateSpecialProduct');

//Deleted Special Products
Route::get('/DeletedSpecialProducts', function () {
    $products = DB::table('deleted_products')->get();

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

// This function is storing Data
Route::post('/addspecialproducts', [SpecialProductController::class, 'addSpecialProducts'])->name('addProducts');

//This function is updating Data
Route::put('/updateSpecialProduct/{id}', [SpecialProductController::class, 'updateSpecialProduct'])->name('updateSpecialProduct');

//This function is Deleting Data
Route::delete('/archiveEachProduct/{id}', [SpecialProductController::class, 'archiveEachProduct'])->name('archiveEachProduct');

Route::delete('/deletedEachProduct/{id}', [SpecialProductController::class, 'deletedEachProduct'])->name('deletedEachProduct');


// This funciton is Restoring Data
Route::post('/restoringSpecialData{id}', [SpecialProductController::class, 'RestoringSpecialProduct']);

//This function is for Forgot password
Route::post('/confirmation', [AdminController::class, 'forgotPassword'])->name('confirmation');

//This function is for Reset Password
Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('reset.password');

//This function is for Displaying Branch Dashboard
Route::get('/DisplayBranchDashboard{id}', [AdminController::class, 'DisplayBranchDashboard'])->name('DisplayBranchDashboard');

//This function is for Displaying More Branch Information
Route::get('/moreBranchInformation/{id}/{branch_name}/{first_name}/{last_name}/{address}/{phone_number}/{email}/{status}', [BranchingController::class, 'moreBranchInformation'])->name('moreBranchInformation');

//This function Adding Branches
Route::post('/branches', [BranchingController::class, 'AddBranch'])->name('Add.Branches');

//This function is for Updating Branch Information
Route::post('/updateBranchInformation/{id}', [AdminController::class, 'updateBranchInformation'])->name('updateBranchInformation');


Route::get('/UserManagement', function () {
    $users = DB::table('user_register')->get();
    return view('components/superAdmin/pages/UserManagement', compact('users'));
})->name('UserManagement');



// Export to EXCEL
Route::get('/export-users-excel', [UserExportController::class, 'UserexportToExcel'])->name('export.users.excel');
Route::get('/export-branch-excel', [BranchExportController::class, 'BranchexportToExcel'])->name('export.branch.excel');


//Download to PDF
Route::get('/export-users-pdf', [UserExportController::class, 'exportPDF'])->name('export.users.pdf');
Route::get('/export-branch-pdf', [BranchExportController::class, 'exportBranchPDF'])->name('export.branch.pdf');
