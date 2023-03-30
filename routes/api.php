<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\ProController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\Rental_photoController;
use App\Http\Controllers\ActivitieController;
use App\Http\Controllers\Activitie_photoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TouristController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
});


//========================== Admin Routers ==========================
//---Auth---
Route::post('/adminRegister', [AdminController::class, 'register']);
Route::post('/adminLogin', [AdminController::class, 'login']);
Route::post('/updateadmin/{id}', [AdminController::class, 'update']); //not working yet

Route::middleware(['auth:sanctum', '\App\Http\Middleware\AdminMiddleware'])->group(function () {
    Route::post('/adminLogout', [AdminController::class, 'logout']);

    Route::get('/service', [ServiceController::class, 'index']);
    Route::post('/service', [ServiceController::class, 'store']);
    Route::get('/service/{id}', [ServiceController::class, 'show']);
    Route::put('/service/{id}', [ServiceController::class, 'update']);
    Route::delete('/service/{id}', [ServiceController::class, 'destroy']);

    Route::get('/rental', [RentalController::class, 'index']);
    Route::post('/rental', [RentalController::class, 'store']);
    Route::get('/rental/{id}', [RentalController::class, 'show']);
    Route::put('/rental/{id}', [RentalController::class, 'update']);
    Route::delete('/rental/{id}', [RentalController::class, 'destroy']);

    Route::get('/rental_photo', [Rental_photoController::class, 'index']);
    Route::post('/rental_photo', [Rental_photoController::class, 'store']);
    Route::delete('/rental_photo/{id}', [Rental_photoController::class, 'destroy']);
    Route::post('/updateRental_photo/{id}', [Rental_photoController::class, 'update']);

    Route::get('/activitie', [ActivitieController::class, 'index']);
    Route::post('/activitie', [ActivitieController::class, 'store']);
    Route::get('/activitie/{id}', [ActivitieController::class, 'show']);
    Route::put('/activitie/{id}', [ActivitieController::class, 'update']);
    Route::delete('/activitie/{id}', [ActivitieController::class, 'destroy']);

    Route::get('/activitie_photo', [Activitie_photoController::class, 'index']);
    Route::post('/activitie_photo', [Activitie_photoController::class, 'store']);
    Route::delete('/activitie_photo/{id}', [Activitie_photoController::class, 'destroy']);
    Route::post('/updateactivitie_photo/{id}', [Activitie_photoController::class, 'update']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/order/{id}', [OrderController::class, 'show']);
    Route::put('/order/{id}', [OrderController::class, 'update']);
    Route::delete('/order/{id}', [OrderController::class, 'destroy']);

    Route::get('/review', [ReviewController::class, 'index']);
    Route::post('/review', [ReviewController::class, 'store']);
    Route::get('/review/{id}', [ReviewController::class, 'show']);
    Route::put('/review/{id}', [ReviewController::class, 'update']);
    Route::delete('/review/{id}', [ReviewController::class, 'destroy']);
});

//========================== Pro Routers ==========================
//---Auth---
Route::post('/proRegister', [ProController::class, 'register']);
Route::post('/proLogin', [ProController::class, 'login']);
Route::post('/updatepro/{id}', [ProController::class, 'update']); //not working yet

Route::middleware(['auth:sanctum', '\App\Http\Middleware\ProMiddleware'])->group(function () {
    Route::post('/proLogout', [ProController::class, 'logout']);

    Route::get('/service', [ServiceController::class, 'index']);
    Route::post('/service', [ServiceController::class, 'store']);
    Route::get('/service/{id}', [ServiceController::class, 'show']);
    Route::put('/service/{id}', [ServiceController::class, 'update']);
    Route::delete('/service/{id}', [ServiceController::class, 'destroy']);

    Route::get('/rental', [RentalController::class, 'index']);
    Route::post('/rental', [RentalController::class, 'store']);
    Route::get('/rental/{id}', [RentalController::class, 'show']);
    Route::put('/rental/{id}', [RentalController::class, 'update']);
    Route::delete('/rental/{id}', [RentalController::class, 'destroy']);

    Route::get('/rental_photo', [Rental_photoController::class, 'index']);
    Route::post('/rental_photo', [Rental_photoController::class, 'store']);
    Route::delete('/rental_photo/{id}', [Rental_photoController::class, 'destroy']);
    Route::post('/updateRental_photo/{id}', [Rental_photoController::class, 'update']);

    Route::get('/activitie', [ActivitieController::class, 'index']);
    Route::post('/activitie', [ActivitieController::class, 'store']);
    Route::get('/activitie/{id}', [ActivitieController::class, 'show']);
    Route::put('/activitie/{id}', [ActivitieController::class, 'update']);
    Route::delete('/activitie/{id}', [ActivitieController::class, 'destroy']);

    Route::get('/activitie_photo', [Activitie_photoController::class, 'index']);
    Route::post('/activitie_photo', [Activitie_photoController::class, 'store']);
    Route::delete('/activitie_photo/{id}', [Activitie_photoController::class, 'destroy']);
    Route::post('/updateactivitie_photo/{id}', [Activitie_photoController::class, 'update']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::get('/order/{id}', [OrderController::class, 'show']);

    Route::get('/review', [ReviewController::class, 'index']);
    Route::get('/review/{id}', [ReviewController::class, 'show']);
});

//========================== Tourist Routers ==========================
//---Auth---
Route::post('/touristRegister', [TouristController::class, 'register']);
Route::post('/touristLogin', [TouristController::class, 'login']);
Route::post('/updatetourist/{id}', [TouristController::class, 'update']); //not working yet

Route::middleware(['auth:sanctum', '\App\Http\Middleware\TouristMiddleware'])->group(function () {
    Route::post('/touristLogout', [TouristController::class, 'logout']);

    Route::get('/service', [ServiceController::class, 'index']);
    Route::get('/service/{id}', [ServiceController::class, 'show']);

    Route::get('/rental', [RentalController::class, 'index']);
    Route::get('/rental/{id}', [RentalController::class, 'show']);

    Route::get('/rental_photo', [Rental_photoController::class, 'index']);

    Route::get('/activitie', [ActivitieController::class, 'index']);
    Route::get('/activitie/{id}', [ActivitieController::class, 'show']);

    Route::get('/activitie_photo', [Activitie_photoController::class, 'index']);

    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::get('/order/{id}', [OrderController::class, 'show']);
    Route::put('/order/{id}', [OrderController::class, 'update']);
    Route::delete('/order/{id}', [OrderController::class, 'destroy']);

    Route::get('/review', [ReviewController::class, 'index']);
    Route::post('/review', [ReviewController::class, 'store']);
    Route::get('/review/{id}', [ReviewController::class, 'show']);
    Route::put('/review/{id}', [ReviewController::class, 'update']);
    Route::delete('/review/{id}', [ReviewController::class, 'destroy']);
});

Route::get('/service', [ServiceController::class, 'index']);
Route::get('/service/{id}', [ServiceController::class, 'show']);

Route::get('/rental', [RentalController::class, 'index']);
Route::get('/rental/{id}', [RentalController::class, 'show']);

Route::get('/activitie', [ActivitieController::class, 'index']);
Route::get('/activitie/{id}', [ActivitieController::class, 'show']);