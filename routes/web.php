<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/user/customer', [\App\Http\Controllers\UserController::class,'getListCustomer']);
Route::get('/user/customer/{id}',[\App\Http\Controllers\UserController::class,'getOneCustomer']);
Route::post('/user/customer',[\App\Http\Controllers\UserController::class, 'createCustomer']);
Route::put('/user/customer/{id}',[\App\Http\Controllers\UserController::class, 'updateCustomer']);
Route::delete('/user/customer/{id}',[\App\Http\Controllers\UserController::class, 'deleteCustomer']);

Route::get('/user/staff', [\App\Http\Controllers\UserController::class,'getListStaff']);
Route::get('/user/staff/{id}',[\App\Http\Controllers\UserController::class,'getOneStaff']);
Route::post('/user/staff',[\App\Http\Controllers\UserController::class, 'createStaff']);
Route::put('/user/staff/{id}',[\App\Http\Controllers\UserController::class, 'updateStaff']);
Route::delete('/user/staff/{id}',[\App\Http\Controllers\UserController::class, 'deleteStaff']);

Route::post('/user/login',[\App\Http\Controllers\UserController::class,'login']);
