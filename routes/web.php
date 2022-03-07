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
Route::group(['prefix' => 'app-farm'], function() {
    Route::get('login', [AppFarmController::class, 'login'])->name('app_farm.login');
    Route::post('login', [AppFarmController::class, 'postLogin'])->name('app_farm.post.login');
});

Route::group(['prefix' => 'app-sale'], function() {
    Route::get('login', [AppSaleController::class, 'login'])->name('app_sale.login');
    Route::post('login', [AppSaleController::class, 'postLogin'])->name('app_sale.post.login');
});