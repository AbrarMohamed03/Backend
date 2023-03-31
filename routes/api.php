<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Activitie_photoController;
use App\Http\Controllers\Admin\ActivitieController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\Order_statusController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProController;
use App\Http\Controllers\Admin\Rental_photoController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TouristController;
use App\Http\Controllers\Admin\Type_activitieController;
use App\Http\Controllers\Admin\Type_rentalController;


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

// Route::middleware(['auth:sanctum', '\App\Http\Middleware\AdminMiddleware'])->group(function () {
//     Route::post('/adminLogout', [AdminController::class, 'logout']);

// });

//========================== Pro Routers ==========================
//---Auth---
Route::post('/proRegister', [ProController::class, 'register']);
Route::post('/proLogin', [ProController::class, 'login']);
Route::post('/updatepro/{id}', [ProController::class, 'update']); //not working yet

// Route::middleware(['auth:sanctum', '\App\Http\Middleware\ProMiddleware'])->group(function () {
//     Route::post('/proLogout', [ProController::class, 'logout']);

// });

//========================== Tourist Routers ==========================
//---Auth---
Route::post('/touristRegister', [TouristController::class, 'register']);
Route::post('/touristLogin', [TouristController::class, 'login']);
Route::post('/updatetourist/{id}', [TouristController::class, 'update']); //not working yet

// Route::middleware(['auth:sanctum', '\App\Http\Middleware\TouristMiddleware'])->group(function () {
//     Route::post('/touristLogout', [TouristController::class, 'logout']);

// });

Route::get('/activitie_photo', [Activitie_photoController::class, 'index']);
Route::post('/activitie_photo', [Activitie_photoController::class, 'store']);
Route::get('/activitie_photo/{id}', [Activitie_photoController::class, 'show']);
Route::post('/updateactivitie_photo/{id}', [Activitie_photoController::class, 'update']);
Route::delete('/activitie_photo/{id}', [Activitie_photoController::class, 'destroy']);
// Route::get('/Dactivitie_photo', [Activitie_photoController::class, 'deleteUnusedPhotos']);

Route::get('/activitie', [ActivitieController::class, 'index']);
Route::post('/activitie', [ActivitieController::class, 'store']);
Route::get('/activitie/{id}', [ActivitieController::class, 'show']);
Route::post('/activitie/{id}', [ActivitieController::class, 'update']);
Route::delete('/activitie/{id}', [ActivitieController::class, 'destroy']);

Route::get('/City', [CityController::class, 'index']);
Route::post('/City', [CityController::class, 'store']);
Route::get('/City/{id}', [CityController::class, 'show']);
Route::post('/City/{id}', [CityController::class, 'update']);
Route::delete('/City/{id}', [CityController::class, 'destroy']);

Route::get('/Order_status', [Order_statusController::class, 'index']);
Route::post('/Order_status', [Order_statusController::class, 'store']);
Route::get('/Order_status/{id}', [Order_statusController::class, 'show']);
Route::post('/Order_status/{id}', [Order_statusController::class, 'update']);
Route::delete('/Order_status/{id}', [Order_statusController::class, 'destroy']);

Route::get('/order', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::post('/order/{id}', [OrderController::class, 'update']);
Route::delete('/order/{id}', [OrderController::class, 'destroy']);

Route::get('/pro', [ProController::class, 'index']);
Route::post('/pro', [ProController::class, 'store']);
Route::get('/pro/{id}', [ProController::class, 'show']);
Route::post('/pro/{id}', [ProController::class, 'update']);
Route::delete('/pro/{id}', [ProController::class, 'destroy']);

Route::get('/rental_photo', [Rental_photoController::class, 'index']);
Route::post('/rental_photo', [Rental_photoController::class, 'store']);
Route::get('/rental_photo/{id}', [Rental_photoController::class, 'show']);
Route::post('/updaterental_photo/{id}', [Rental_photoController::class, 'update']);
Route::delete('/rental_photo/{id}', [Rental_photoController::class, 'destroy']);
// Route::get('/Drental_photo', [Activitie_photoController::class, 'deleteUnusedPhotos']);

Route::get('/rental', [RentalController::class, 'index']);
Route::post('/rental', [RentalController::class, 'store']);
Route::get('/rental/{id}', [RentalController::class, 'show']);
Route::post('/rental/{id}', [RentalController::class, 'update']);
Route::delete('/rental/{id}', [RentalController::class, 'destroy']);

Route::get('/review', [ReviewController::class, 'index']);
Route::post('/review', [ReviewController::class, 'store']);
Route::get('/review/{id}', [ReviewController::class, 'show']);
Route::post('/review/{id}', [ReviewController::class, 'update']);
Route::delete('/review/{id}', [ReviewController::class, 'destroy']);

Route::get('/tourist', [TouristController::class, 'index']);
Route::post('/tourist', [TouristController::class, 'store']);
Route::get('/tourist/{id}', [TouristController::class, 'show']);
Route::post('/tourist/{id}', [TouristController::class, 'update']);
Route::delete('/tourist/{id}', [TouristController::class, 'destroy']);

Route::get('/type_rental', [Type_rentalController::class, 'index']);
Route::post('/type_rental', [Type_rentalController::class, 'store']);
Route::get('/type_rental/{id}', [Type_rentalController::class, 'show']);
Route::post('/type_rental/{id}', [Type_rentalController::class, 'update']);
Route::delete('/type_rental/{id}', [Type_rentalController::class, 'destroy']);

Route::get('/type_activitie', [Type_activitieController::class, 'index']);
Route::post('/type_activitie', [Type_activitieController::class, 'store']);
Route::get('/type_activitie/{id}', [Type_activitieController::class, 'show']);
Route::post('/type_activitie/{id}', [Type_activitieController::class, 'update']);
Route::delete('/type_activitie/{id}', [Type_activitieController::class, 'destroy']);