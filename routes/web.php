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
Route::get('get-animals', [AppFarmController::class, 'getAnimals'])->name('get.animals');

Route::group(['prefix' => 'app-farm'], function() {
    Route::get('home', [AppFarmController::class, 'home'])->name('app_farm.home');

    Route::get('login', [AppFarmController::class, 'login'])->name('app_farm.login');
    Route::post('login', [AppFarmController::class, 'postLogin'])->name('app_farm.post.login');

    Route::get('register', [AppFarmController::class, 'register'])->name('app_farm.register');
    Route::post('register', [AppFarmController::class, 'postRegister'])->name('app_farm.post.register');

    Route::get('otp', [AppFarmController::class, 'otp'])->name('app_farm.otp');
    Route::get('resend_otp', [AppFarmController::class, 'resendOtp'])->name('app_farm.resend.otp');
    Route::post('otp', [AppFarmController::class, 'postOtp'])->name('app_farm.post.otp');

    Route::get('create-appointment', [AppFarmController::class, 'createAppointment'])->name('app_farm.create_appointment');
    Route::post('create-appointment', [AppFarmController::class, 'postCreateAppointment'])->name('app_farm.post.create_appointment');
    Route::get('list-appointment', [AppFarmController::class, 'listAppointment'])->name('app_farm.list_appointment');
    Route::get('show-appointment/{id}', [AppFarmController::class, 'showAppointment'])->name('app_farm.show_appointment');
});

Route::group(['prefix' => 'app-sale'], function() {
    Route::get('login', [AppSaleController::class, 'login'])->name('app_sale.login');
    Route::post('login', [AppSaleController::class, 'postLogin'])->name('app_sale.post.login');
});