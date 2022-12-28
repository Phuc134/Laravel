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
Route::prefix('/user/customer')->group(function (){
    Route::get('', [\App\Http\Controllers\UserController::class,'getListCustomer']);
    Route::get('{id}',[\App\Http\Controllers\UserController::class,'getOneCustomer']);
    Route::post('',[\App\Http\Controllers\UserController::class, 'createCustomer']);
    Route::put('{id}',[\App\Http\Controllers\UserController::class, 'updateCustomer']);
    Route::delete('{id}',[\App\Http\Controllers\UserController::class, 'deleteCustomer']);});

//CRUD Staff
Route::prefix('/user/staff')->group(function () {
    Route::get('', [\App\Http\Controllers\UserController::class,'getListStaff']);
    Route::get('{id}',[\App\Http\Controllers\UserController::class,'getOneStaff']);
    Route::post('',[\App\Http\Controllers\UserController::class, 'createStaff']);
    Route::put('{id}',[\App\Http\Controllers\UserController::class, 'updateStaff']);
    Route::delete('{id}',[\App\Http\Controllers\UserController::class, 'deleteStaff']);
});

//Auth

//CRUD Seaport
Route::prefix('/seaport')->group(function () {
    Route::get('',[\App\Http\Controllers\SeaportController::class,'getListSeaport']);
    Route::post('',[\App\Http\Controllers\SeaportController::class,'createSeaport']);
    Route::put('{id}',[\App\Http\Controllers\SeaportController::class,'updateSeaport']);
    Route::delete('{id}',[\App\Http\Controllers\SeaportController::class,'deleteSeaport']);
});

//CRUD Company
Route::prefix('/company')->group(function () {
    Route::get('',[\App\Http\Controllers\CompanyController::class,'getListCompany']);
    Route::post('',[\App\Http\Controllers\CompanyController::class,'createCompany']);
    Route::put('{id}',[\App\Http\Controllers\CompanyController::class,'updateCompany']);
    Route::delete('{id}',[\App\Http\Controllers\CompanyController::class,'deleteCompany']);
});

//CRUD Category
Route::prefix('/category')->group(function () {
    Route::get('',[\App\Http\Controllers\CategoryController::class,'getListCategory']);
    Route::post('',[\App\Http\Controllers\CategoryController::class,'createCategory']);
    Route::put('{id}',[\App\Http\Controllers\CategoryController::class,'updateCategory']);
    Route::delete('{id}',[\App\Http\Controllers\CategoryController::class,'deleteCategory']);
});

//CRUD VESSEL
Route::prefix('/vessel')->group(function () {
    Route::post('',[\App\Http\Controllers\VesselController::class,'createVessel']);
    Route::get('',[\App\Http\Controllers\VesselController::class,'getListVessel']);
    Route::put('{id}',[\App\Http\Controllers\VesselController::class,'updateVessel']);
    Route::delete('{id}',[\App\Http\Controllers\VesselController::class,'deleteVessel']);
});


//CRUD SCHEDULE
Route::prefix('/schedule')->group(function () {
    Route::post('',[\App\Http\Controllers\ScheduleController::class,'createSchedule']);
    Route::get('{idVessel}',[\App\Http\Controllers\ScheduleController::class,'getScheduleByVessel']);
    Route::put('{id}',[\App\Http\Controllers\ScheduleController::class,'updateSchedule']);
    Route::delete('{id}',[\App\Http\Controllers\ScheduleController::class,'deleteSchedule']);
});

//AUTH
Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
});
