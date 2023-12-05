<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\CategoryRestaurantController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'admin','prefix'=>'admin'],function () {
    Route::get('/dashboard', [DashboardController::class, 'admindashboard'])->name('admin.dashboard');
    Route::get('/status/users', [StatusController::class, 'index'])->name('admin.status.users');
    Route::get('/status/users/edit/{id}', [StatusController::class, 'edit'])->name('admin.status.users.edit');
    Route::put('/status/users/update/{id}', [StatusController::class, 'update'])->name('admin.status.users.update');
    Route::get('/status/users/delete/{id}', [StatusController::class, 'delete'])->name('admin.status.users.delete');


    Route::get('/category/restaurant/list', [CategoryRestaurantController::class, 'index'])->name('admin.category.index');
    Route::get('/category/restaurant/edit/{id}', [CategoryRestaurantController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/restaurant/update/{id}', [CategoryRestaurantController::class, 'update'])->name('admin.category.update');

    Route::get('/list/restaurant', [RestaurantController::class, 'index'])->name('admin.restaurant.index');
    Route::get('/list/restaurant/edit/{id}', [RestaurantController::class, 'edit'])->name('admin.restaurant.edit');
    Route::put('/list/restaurant/update/{id}', [RestaurantController::class, 'update'])->name('admin.restaurant.update');




    Route::get('/list/orders', [OrderController::class, 'index'])->name('admin.orders.index');
});

Route::group(['middleware' => 'manager','prefix'=>'manager'],function () {
    Route::get('/dashboard', [DashboardController::class, 'managerdashboard'])->name('manager.dashboard');
});

Route::group(['middleware' => 'user','prefix'=>'user'],function () {
    Route::get('/dashboard', [DashboardController::class, 'userdashboard'])->name('user.dashboard');
});

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware(['auth'])->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Http\Request $request) {
//     $request->user()->markEmailAsVerified();
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('verification_notice', true);
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
