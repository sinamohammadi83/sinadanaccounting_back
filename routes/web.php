<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
Route::get('/login', function ()
{
    return view("login");
})->name('login.page');
Route::post('admin-auth', [\App\Http\Controllers\Admin\AdminAuthenticationController::class, 'login'])->name('AdminAuth.con');
Route::get('/test', [\App\Http\Controllers\Admin\AdminAuthenticationController::class, 'test']);
Route::prefix('/admin/')->middleware('auth')->group(function ()
{
    Route::get('panel', function ()
    {
        return view("admin-panel");
    });
});
