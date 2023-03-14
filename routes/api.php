<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\Rental_photoController;

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

Route::apiResource('admin',AdminController::class);
Route::apiResource('pro',ProController::class);
Route::apiResource('service',ServiceController::class);
Route::apiResource('rental',RentalController::class);
Route::apiResource('Rental_photo',Rental_photoController::class);

Route::post('/updatephoto/{id}', [Rental_photoController::class, 'update']);

