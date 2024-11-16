<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonMacController;
use App\Http\Controllers\Api\SpecialProductController;
use Illuminate\Support\Facades\DB;
Route::get('/', function () {
    return view('/pages/LandingPage');
});
Route::get('/HomePage', function () {
    return view('/pages/HomePage');
})->name('HomePage');

Route::get('/DonMacPage' , function () {
    $products = DB::table('don_mac')->get();
    return view('/components/DonMacPage', compact('products'));
})->name('DonMacPage');

Route::get('/SpecialProductPage' , function () {
    $products = DB::table('special_product')->get();
    return view('/components/SpecialProductPage', compact('products'));
})->name('SpecialProductPage');

Route::get('/DonMacAllProducts', function (){
    $products = DB::table('don_mac')->get();
    return view('/atoms/DonMacAllProducts', compact('products'));
})->name('DonMacAllProducts');

Route::get('/AllSpecialProducts', function () {
    $products = DB::table('special_product')->get();
    return view('/atoms/SpecialAllProducts', compact('products'));  
})->name('AllSpecialProducts');



Route::get('/updateSpecialProduct/{id}', function ($id) {
    $product = DB::table('special_product')->where('id', $id)->first();
    return view('/atoms/SpecialAllProducts', compact('product'));
})->name('updateSpecialProduct');

Route::get('/updateDonMacProduct/{id}', function ($id) {
    $product = DB::table('don_mac')->where('id', $id)->first();
    return view('/atoms/DonMacAllProducts', compact('product'));
})->name('updateDonMacProduct');

// Route::put('/updateSpecialProduct/{id}', [YourController::class, 'update'])->name('updateSpecialProduct');

/** This function is storing Data*/
Route::post('/addDonMacProducts', [DonMacController::class, 'addDonMacProducts']);
Route::post('/addspecialproducts', [SpecialProductController::class, 'addSpecialProducts']);


/** This function is updating Data*/
Route::put('/updateSpecialProduct/{id}', [SpecialProductController::class, 'updateSpecialProduct'])->name('updateSpecialProduct'); 


//This function is Deleting Data
Route::delete('/deleteEachSpecialProduct/{id}', [SpecialProductController::class, 'deleteEachProduct'])->name('deleteEachSpecialProduct');
Route::delete('/deleteEachDonmacchiatosProduct/{id}', [DonMacController::class, 'deleteEachProduct'])->name('deleteEachDonmacchiatosProduct');

