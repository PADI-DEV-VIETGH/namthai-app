<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppFarmController;
use App\Http\Controllers\AppSaleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('get-provinces', [AppFarmController::class, 'getProvince'])->name('get.provinces');
Route::get('get-districts', [AppFarmController::class, 'getDistrict'])->name('get.districts');
Route::get('get-wards', [AppFarmController::class, 'getWard'])->name('get.wards');

Route::group(['prefix' => 'app-farm'], function() {
    Route::get('login', [AppFarmController::class, 'login'])->name('app_farm.login');
    Route::post('login', [AppFarmController::class, 'postLogin'])->name('app_farm.post.login');

    Route::get('register', [AppFarmController::class, 'register'])->name('app_farm.register');
    Route::post('register', [AppFarmController::class, 'postRegister'])->name('app_farm.post.register');
});

Route::group(['prefix' => 'app-sale'], function() {
    Route::get('login', [AppSaleController::class, 'login'])->name('app_sale.login');
    Route::post('login', [AppSaleController::class, 'postLogin'])->name('app_sale.post.login');
});