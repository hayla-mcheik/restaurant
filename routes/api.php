<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('subscribe',[ApiController::class,'subscribe']);

Route::get('/home',[ApiController::class,'HomeScreen']);
Route::get('/categories',[ApiController::class,'CategoriesScreen']);
Route::get('/listing/{categoryId?}', [ApiController::class, 'ListingScreen']);

Route::get('/listing/details/{restaurant_id}',[ApiController::class,'ListingScreenDetails']);
Route::get('/offers',[ApiController::class,'OfferScreen']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/order/create', [ApiController::class, 'OrderCreation']);
    Route::get('/checkout', [ApiController::class, 'CheckoutScreen']);
    Route::post('/addtocart', [ApiController::class, 'AddToCartApi']);
    Route::get('/showorder',[ApiController::class,'showorder']);
    Route::get('/cartcount',[ApiController::class,'cartcount']);
    Route::get('/addtowishlist/{menuItemId}', [ApiController::class, 'addtowishlist']);
});