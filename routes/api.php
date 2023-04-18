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


use App\Http\Controllers\Pro\Auth\ProAuthController;
use App\Http\Controllers\Pro\ProActivitie_photoController;
use App\Http\Controllers\Pro\ProActivitieController;
use App\Http\Controllers\Pro\ProRental_photoController;
use App\Http\Controllers\Pro\ProRentalController;
use App\Http\Controllers\Pro\ProOrderController;

use App\Http\Controllers\Tourist\Auth\TouristAuthController;
use App\Http\Controllers\Tourist\TouristOrderController;
use App\Http\Controllers\Tourist\TouristReviewController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['auth:sanctum']], function () {
// });


//---Auth admin---
Route::post('/admin/register', [AdminAuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/passReset', [AdminAuthController::class, 'resetPassword']);
Route::post('/mailtest', [AdminAuthController::class, 'resetPassword']);

//---Auth Pro---
Route::post('/pro/register', [ProAuthController::class, 'register']);
Route::post('/pro/login', [ProAuthController::class, 'login']);
Route::post('/pro/passReset', [ProAuthController::class, 'resetPassword']);
Route::post('/mailtest', [ProAuthController::class, 'resetPassword']);

//---Auth Pro---
Route::post('/tourist/register', [TouristAuthController::class, 'register']);
Route::post('/tourist/login', [TouristAuthController::class, 'login']);
Route::post('/tourist/passReset', [TouristAuthController::class, 'resetPassword']);
Route::post('/mailtest', [TouristAuthController::class, 'resetPassword']);

//========================== Public Routers ==========================

Route::get('/activitie_photo', [Activitie_photoController::class, 'index']);
Route::get('/activitie_photo/{id}', [Activitie_photoController::class, 'show']);

Route::get('/rental_photo', [Rental_photoController::class, 'index']);
Route::get('/rental_photo/{id}', [Rental_photoController::class, 'show']);

Route::get('/activitie', [ActivitieController::class, 'index']);
Route::get('/activitie/{id}', [ActivitieController::class, 'show']);

Route::get('/rental', [RentalController::class, 'index']);
Route::get('/rental/{id}', [RentalController::class, 'show']);

Route::get('/review', [ReviewController::class, 'index']);
Route::get('/review/{id}', [ReviewController::class, 'show']);


//========================== Admin Routers ==========================

Route::middleware(['auth:sanctum', '\App\Http\Middleware\AdminMiddleware'])->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout']);
    Route::post('/admin/updateInfo/{id}', [AdminAuthController::class, 'updateProfile']);
    Route::post('/admin/updatePassword/{id}', [AdminAuthController::class, 'updatePassword']);

    Route::post('/admin/activitie_photo/add', [Activitie_photoController::class, 'store']);
    Route::post('/admin/activitie_photo/update/{id}', [Activitie_photoController::class, 'update']);
    Route::delete('/admin/activitie_photo/{id}', [Activitie_photoController::class, 'destroy']);
    // Route::get('/Dactivitie_photo', [Activitie_photoController::class, 'deleteUnusedPhotos']);

    Route::post('/admin/activitie/add', [ActivitieController::class, 'store']);
    Route::post('/admin/activitie/update/{id}', [ActivitieController::class, 'update']);
    Route::delete('/admin/activitie/{id}', [ActivitieController::class, 'destroy']);

    Route::post('/admin/city/add', [CityController::class, 'store']);
    Route::post('/admin/city/update/{id}', [CityController::class, 'update']);
    Route::delete('/admin/city/{id}', [CityController::class, 'destroy']);
    Route::get('/admin/city', [CityController::class, 'index']);
    Route::get('/admin/city/{id}', [CityController::class, 'show']);

    Route::get('/admin/order_status', [Order_statusController::class, 'index']);
    Route::post('/admin/order_status/add', [Order_statusController::class, 'store']);
    Route::get('/admin/order_status/{id}', [Order_statusController::class, 'show']);
    Route::post('/admin/order_status/update/{id}', [Order_statusController::class, 'update']);
    Route::delete('/admin/order_status/delete/{id}', [Order_statusController::class, 'destroy']);

    Route::get('/admin/order', [OrderController::class, 'index']);
    Route::post('/admin/order/add', [OrderController::class, 'store']);
    Route::get('/admin/order/{id}', [OrderController::class, 'show']);
    Route::post('/admin/order/update/{id}', [OrderController::class, 'update']);
    Route::delete('/admin/order/delete/{id}', [OrderController::class, 'destroy']);

    Route::get('/admin/pro', [ProController::class, 'index']);
    Route::post('/admin/pro/add', [ProController::class, 'store']);
    Route::get('/admin/pro/{id}', [ProController::class, 'show']);
    Route::post('/admin/pro/update/{id}', [ProController::class, 'update']);
    Route::delete('/admin/pro/delete/{id}', [ProController::class, 'destroy']);

    Route::post('/admin/rental_photo/add', [Rental_photoController::class, 'store']);
    Route::post('/admin/rental_photo/update/{id}', [Rental_photoController::class, 'update']);
    Route::delete('/admin/rental_photo/delete/{id}', [Rental_photoController::class, 'destroy']);
    // Route::get('/Drental_photo', [Activitie_photoController::class, 'deleteUnusedPhotos']);

    Route::post('/admin/rental/add', [RentalController::class, 'store']);
    Route::post('/admin/rental/update/{id}', [RentalController::class, 'update']);
    Route::delete('/admin/rental/delete/{id}', [RentalController::class, 'destroy']);

    Route::post('/admin/review/add', [ReviewController::class, 'store']);
    Route::post('/admin/review/update/{id}', [ReviewController::class, 'update']);
    Route::delete('/admin/review/delete/{id}', [ReviewController::class, 'destroy']);

    Route::get('/admin/tourist', [TouristController::class, 'index']);
    Route::post('/admin/tourist/add', [TouristController::class, 'store']);
    Route::get('/admin/tourist/{id}', [TouristController::class, 'show']);
    Route::post('/admin/tourist/update/{id}', [TouristController::class, 'update']);
    Route::delete('/admin/tourist/delete/{id}', [TouristController::class, 'destroy']);

    Route::get('/admin/type_rental', [Type_rentalController::class, 'index']);
    Route::post('/admin/type_rental/add', [Type_rentalController::class, 'store']);
    Route::post('/admin/type_rental/update/{id}', [Type_rentalController::class, 'update']);
    Route::get('/admin/type_rental/{id}', [Type_rentalController::class, 'show']);
    Route::delete('/admin/type_rental/delete/{id}', [Type_rentalController::class, 'destroy']);

    Route::get('/admin/type_activitie', [Type_activitieController::class, 'index']);
    Route::post('/admin/type_activitie/add', [Type_activitieController::class, 'store']);
    Route::post('/admin/type_activitie/update/{id}', [Type_activitieController::class, 'update']);
    Route::get('/admin/type_activitie/{id}', [Type_activitieController::class, 'show']);
    Route::delete('/admin/type_activitie/delete/{id}', [Type_activitieController::class, 'destroy']);
});

//========================== Pro Routers ==========================

Route::middleware(['auth:sanctum', '\App\Http\Middleware\ProMiddleware'])->group(function () {

    Route::post('/pro/logout', [ProAuthController::class, 'logout']);
    Route::post('/pro/updateInfo/{id}', [ProAuthController::class, 'updateProfile']);
    Route::post('/pro/updatePassword/{id}', [ProAuthController::class, 'updatePassword']);

    Route::get('/pro/activitie/pro_id={id}', [ProActivitieController::class, 'index']);
    Route::get('/pro/activitie/{id}', [ProActivitieController::class, 'show']);
    Route::post('/pro/activitie/add', [ProActivitieController::class, 'store']);
    Route::post('/pro/activitie/update/{id}', [ProActivitieController::class, 'update']);
    Route::delete('/pro/activitie/delete/{id}', [ProActivitieController::class, 'destroy']);

    Route::post('/pro/activitie_photo/add', [ProActivitie_photoController::class, 'store']);
    Route::post('/pro/activitie_photo/update/{id}', [ProActivitie_photoController::class, 'update']);
    Route::delete('/pro/activitie_photo/{id}', [ProActivitie_photoController::class, 'destroy']);
    // Route::get('/Dactivitie_photo', [ProActivitie_photoController::class, 'deleteUnusedPhotos']);

    Route::get('/pro/order/pro_id={id}', [ProOrderController::class, 'index']);
    Route::get('/pro/order/{id}', [ProOrderController::class, 'show']);

    Route::get('/pro/rental/pro_id={id}', [ProRentalController::class, 'index']);
    Route::post('/pro/rental/add', [ProRentalController::class, 'store']);
    Route::post('/pro/rental/update/{id}', [ProRentalController::class, 'update']);
    Route::delete('/pro/rental/delete/{id}', [ProRentalController::class, 'destroy']);

    Route::post('/pro/rental_photo/add', [ProRental_photoController::class, 'store']);
    Route::post('/pro/rental_photo/update/{id}', [ProRental_photoController::class, 'update']);
    Route::delete('/pro/rental_photo/delete/{id}', [ProRental_photoController::class, 'destroy']);
    // Route::get('/Drental_photo', [ProActivitie_photoController::class, 'deleteUnusedPhotos']);
});

//========================== Tourist Routers ==========================

Route::middleware(['auth:sanctum', '\App\Http\Middleware\TouristMiddleware'])->group(function () {
    Route::post('/tourist/logout', [TouristAuthController::class, 'logout']);
    Route::post('/tourist/updateInfo/{id}', [TouristAuthController::class, 'updateProfile']);
    Route::post('/tourist/updatePassword/{id}', [TouristAuthController::class, 'updatePassword']);

    Route::get('/tourist/order/tourist_id={id}', [TouristOrderController::class, 'index']);
    Route::post('/tourist/order/add', [TouristOrderController::class, 'store']);
    Route::get('/tourist/order/{id}', [TouristOrderController::class, 'show']);
    Route::post('/tourist/order/update/{id}', [TouristOrderController::class, 'update']);
    Route::delete('/tourist/order/delete/{id}', [TouristOrderController::class, 'destroy']);

    Route::get('/tourist/review/tourist_id={id}', [TouristReviewController::class, 'index']);
    Route::post('/tourist/review/add', [TouristReviewController::class, 'store']);
    Route::post('/tourist/review/update/{id}', [TouristReviewController::class, 'update']);
    Route::delete('/tourist/review/delete/{id}', [TouristReviewController::class, 'destroy']);

});