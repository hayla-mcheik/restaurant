<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StatusController;
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
