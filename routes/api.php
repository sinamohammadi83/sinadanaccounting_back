<?php

use App\Http\Controllers\Branch\FactorController;
use App\Http\Controllers\Branch\PersonController;
use App\Http\Controllers\Branch\ProductController;
use App\Http\Controllers\Branch\RoleController;
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

Route::get("/test",function (){
    return strlen("ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f");
});

Route::post('/login',[LoginController::class,'store']);
Route::delete('/logout',[LoginController::class,'destroy'])->middleware("auth:sanctum");
Route::get('/login-check',[LoginController::class,'check'])->middleware("auth:sanctum");


Route::prefix('/branch')->middleware(['auth:sanctum'])->group(function (){
    Route::resource("persons",PersonController::class);
    Route::get('/products/search',[ProductController::class,'findProduct']);
    Route::resource("products", ProductController::class);
    Route::resource('factors',FactorController::class);
    Route::resource('roles',RoleController::class);
    Route::get('/permissions',[RoleController::class,'get_permissions']);
    Route::get("/storages",[ProductController::class,'getStorages']);
    Route::get("/categories",[ProductController::class,'getCategories']);
    Route::get("/provinces",[CityProvinceController::class,"index"]);
    Route::get("/province/{province}",[CityProvinceController::class,"find_cities"]);
});
