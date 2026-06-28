<?php

use App\Http\Controllers\Branch\AccountController;
use App\Http\Controllers\Branch\DocumentController;
use App\Http\Controllers\Branch\FactorController;
use App\Http\Controllers\Branch\LedgerController;
use App\Http\Controllers\Branch\PersonController;
use App\Http\Controllers\Branch\ProductController;
use App\Http\Controllers\Branch\ProfileController;
use App\Http\Controllers\Branch\RoleController;
use App\Http\Controllers\Branch\StaffController;
use App\Http\Controllers\CityProvinceController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get("/test",function (){
//    return \Illuminate\Support\Facades\Hash::make(12345678);
//});

Route::post('/login',[LoginController::class,'store']);
Route::delete('/logout',[LoginController::class,'destroy'])->middleware("auth:sanctum");
Route::get('/login-check',[LoginController::class,'check'])->middleware("auth:sanctum");

Route::post('/backup/admin',[\App\Http\Controllers\Branch\BackupController::class,'store']);
Route::post('/restore/admin',[\App\Http\Controllers\Branch\BackupController::class,'restore']);

Route::prefix('/branch')->middleware(['auth:sanctum'])->group(function (){
    Route::resource("persons",PersonController::class);
    Route::get('/products/search',[ProductController::class,'findProduct']);
    Route::resource("products", ProductController::class);
    Route::resource('factors',FactorController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('ledgers',LedgerController::class);
    Route::resource('staffs',StaffController::class);
    Route::resource('accounts',AccountController::class);
    Route::resource('documents',DocumentController::class);
    Route::get('/permissions',[RoleController::class,'get_permissions']);
    Route::get("/storages",[FactorController::class,'getStorages']);
    Route::get("/categories",[ProductController::class,'getCategories']);
    Route::get("/provinces",[CityProvinceController::class,"index"]);
    Route::get("/province/{province}",[CityProvinceController::class,"find_cities"]);
    Route::get('/profile',[ProfileController::class,'show']);
    Route::get('/get-permissions',[ProfileController::class,'getPermissions']);
    Route::get('/reports',[\App\Http\Controllers\Branch\ReportController::class,'index']);
    Route::get('/individual-account-activity/{person}',[\App\Http\Controllers\Branch\IndividualAccountActivityController::class,'show']);


});
