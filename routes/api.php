<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
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



Route::post('/adminRegister',[AdminController::class, 'register']);
Route::post('/adminLogin',[AdminController::class, 'login']);
Route::post('/updateadmin/{id}',[AdminController::class, 'update']);//not working yet
Route::middleware(['auth:sanctum', '\App\Http\Middleware\AdminMiddleware'])->group(function () {
    Route::post('/adminLogout',[AdminController::class, 'logout']);
});

Route::post('/proRegister',[ProController::class, 'register']);
Route::post('/proLogin',[ProController::class, 'login']);
Route::post('/updatepro/{id}',[ProController::class, 'update']);//not working yet
Route::middleware(['auth:sanctum', '\App\Http\Middleware\ProMiddleware'])->group(function () {
    Route::post('/proLogout',[ProController::class, 'logout']);
});

Route::post('/touristRegister',[TouristController::class, 'register']);
Route::post('/touristLogin',[TouristController::class, 'login']);
Route::post('/updatetourist/{id}',[TouristController::class, 'update']);//not working yet
Route::middleware(['auth:sanctum', '\App\Http\Middleware\TouristMiddleware'])->group(function () {
    Route::post('/touristLogout',[TouristController::class, 'logout']);
});





Route::apiResource('service',ServiceController::class);

Route::apiResource('rental',RentalController::class);

Route::apiResource('rental_photo',Rental_photoController::class);
Route::post('/updateRental_photo/{id}', [Rental_photoController::class, 'update']);

Route::apiResource('activitie',ActivitieController::class);

Route::apiResource('activitie_photo',Activitie_photoController::class);
Route::post('/updateactivitie_photo/{id}', [Activitie_photoController::class, 'update']);

Route::apiResource('order',OrderController::class);

Route::apiResource('review',ReviewController::class);
