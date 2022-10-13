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
//CRUD Cus
Route::get('/user/customer', [\App\Http\Controllers\UserController::class,'getListCustomer']);
Route::get('/user/customer/{id}',[\App\Http\Controllers\UserController::class,'getOneCustomer']);
Route::post('/user/customer',[\App\Http\Controllers\UserController::class, 'createCustomer']);
Route::put('/user/customer/{id}',[\App\Http\Controllers\UserController::class, 'updateCustomer']);
Route::delete('/user/customer/{id}',[\App\Http\Controllers\UserController::class, 'deleteCustomer']);
//CRUD Staff
Route::get('/user/staff', [\App\Http\Controllers\UserController::class,'getListStaff']);
Route::get('/user/staff/{id}',[\App\Http\Controllers\UserController::class,'getOneStaff']);
Route::post('/user/staff',[\App\Http\Controllers\UserController::class, 'createStaff']);
Route::put('/user/staff/{id}',[\App\Http\Controllers\UserController::class, 'updateStaff']);
Route::delete('/user/staff/{id}',[\App\Http\Controllers\UserController::class, 'deleteStaff']);
//Auth
Route::post('/user/login',[\App\Http\Controllers\UserController::class,'login']);
//CRUD Seaport
Route::get('/seaport',[\App\Http\Controllers\SeaportController::class,'getListSeaport']);
Route::post('/seaport',[\App\Http\Controllers\SeaportController::class,'createSeaport']);
Route::put('/seaport/{id}',[\App\Http\Controllers\SeaportController::class,'updateSeaport']);
Route::delete('/seaport/{id}',[\App\Http\Controllers\SeaportController::class,'deleteSeaport']);

//CRUD Company
Route::get('/company',[\App\Http\Controllers\CompanyController::class,'getListCompany']);
Route::post('/company',[\App\Http\Controllers\CompanyController::class,'createCompany']);
Route::put('/company/{id}',[\App\Http\Controllers\CompanyController::class,'updateCompany']);
Route::delete('/company/{id}',[\App\Http\Controllers\CompanyController::class,'deleteCompany']);

//CRUD Category
Route::get('/category',[\App\Http\Controllers\CategoryController::class,'getListCategory']);
Route::post('/category',[\App\Http\Controllers\CategoryController::class,'createCategory']);
Route::put('/category/{id}',[\App\Http\Controllers\CategoryController::class,'updateCategory']);
Route::delete('/category/{id}',[\App\Http\Controllers\CategoryController::class,'deleteCategory']);

