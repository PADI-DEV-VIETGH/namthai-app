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
    Route::get('home', [AppSaleController::class, 'home'])->name('app_sale.home');
    Route::get('check_in', [AppSaleController::class, 'checkIn'])->name('app_sale.check_in');
    Route::get('list_working_plan', [AppSaleController::class, 'listWorkingPlan'])->name('app_sale.list_working_plan');
    Route::get('product_inventory', [AppSaleController::class, 'productInventory'])->name('app_sale.product_inventory');
    Route::get('order', [AppSaleController::class, 'order'])->name('app_sale.order');
    Route::get('prescription', [AppSaleController::class, 'prescription'])->name('app_sale.prescription');
    Route::get('appointment', [AppSaleController::class, 'appointment'])->name('app_sale.appointment');
    Route::post('store_appointment', [AppSaleController::class, 'storeAppointment'])->name('app_sale.store_appointment');
    Route::post('upload_file', [AppSaleController::class, 'uploadFile'])->name('app_sale.upload_file');
    Route::get('create_prescription', [AppSaleController::class, 'createPrescription'])->name('app_sale.create_prescription');
});