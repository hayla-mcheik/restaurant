<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\CategoryRestaurantController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Manager\RestaurantprofileController;
use App\Http\Controllers\Manager\MenuCategoriesController;
use App\Http\Controllers\Manager\MenuItemsController;
use App\Http\Controllers\Manager\ProfileController;
use App\Http\Controllers\Manager\OrderManagementController;
use App\Http\Controllers\Manager\GalleryController;
use App\Http\Controllers\Manager\OfferController;
use App\Http\Controllers\user\OrderUserController;
use App\Http\Controllers\user\ProfileUserController;
use App\Http\Controllers\user\AddressesController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriptionController;

use App\Livewire\Frontend\Order\Index;


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

// routes/web.php

Route::get('/', [IndexController::class, 'index'])->name('home.index');
Route::controller(App\Http\Controllers\Frontend\ListingRestaurantController::class)->group(function () {
    Route::get('/listing','index');
    Route::get('/listing/restaurant/details/{restaurant_id}','restaurantdetails')->name('listing.restaurant.details.view');
});

Route::controller(App\Http\Controllers\Frontend\CheckoutController::class)->group(function () {
    Route::get('/checkout','index');
});

Route::controller(App\Http\Controllers\Frontend\OffersController::class)->group(function () {
    Route::get('/offers','index');
});


Route::get('email/verify', [VerificationController::class,'show'])->name('verification.notice');
Route::get('email/verify/{id}', [VerificationController::class,'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class,'resend'])->name('verification.resend');

    Auth::routes();


Route::group(['middleware' => ['admin','auth'],'prefix'=>'admin'],function () {
    Route::get('/dashboard', [DashboardController::class, 'admindashboard'])->name('admin.dashboard');
    Route::get('/status/users', [StatusController::class, 'index'])->name('admin.status.users');
    Route::get('/status/users/edit/{id}', [StatusController::class, 'edit'])->name('admin.status.users.edit');
    Route::put('/status/users/update/{id}', [StatusController::class, 'update'])->name('admin.status.users.update');
    Route::get('/status/users/delete/{id}', [StatusController::class, 'delete'])->name('admin.status.users.delete');

    Route::get('/category/restaurant/list', [CategoryRestaurantController::class, 'index'])->name('admin.category.index');
    Route::get('/category/restaurant/create', [CategoryRestaurantController::class, 'create'])->name('admin.category.create');
    Route::post('/category/restaurant/list', [CategoryRestaurantController::class, 'store'])->name('admin.category.store');
    Route::get('/category/restaurant/edit/{id}', [CategoryRestaurantController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/restaurant/update/{id}', [CategoryRestaurantController::class, 'update'])->name('admin.category.update');
    Route::get('/category/restaurant/{id}', [CategoryRestaurantController::class, 'delete'])->name('admin.category.delete');

    Route::get('/list/restaurant', [RestaurantController::class, 'index'])->name('admin.restaurant.index');
    Route::get('/list/restaurant/edit/{id}', [RestaurantController::class, 'edit'])->name('admin.restaurant.edit');
    Route::PUT('/list/restaurant/update/{id}', [RestaurantController::class, 'update'])->name('admin.restaurant.update');

    Route::get('/list/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/list/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.view');

    Route::get('/list/menu', [MenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/list/menu/{id}', [MenuController::class, 'show'])->name('admin.menu.view');

    Route::get('/profile', [ProfileAdminController::class, 'adminprofile'])->name('admin.profile');
    Route::put('/profile', [ProfileAdminController::class, 'adminprofileupdate'])->name('admin.profile.update');
});

Route::group(['middleware' => ['manager','auth'],'prefix'=>'manager'],function () {
    Route::get('/dashboard', [DashboardController::class, 'managerdashboard'])->name('manager.dashboard');
    Route::get('/restaurant', [RestaurantprofileController::class, 'index'])->name('manager.restaurant');
    Route::put('/restaurant/update', [RestaurantprofileController::class, 'update'])->name('manager.restaurant.update');

    Route::get('/orders', [OrderManagementController::class, 'index'])->name('manager.order.list');
    Route::get('/orders/{id}', [OrderManagementController::class, 'edit'])->name('manager.orders.status.edit');
    Route::put('/orders/{id}', [OrderManagementController::class, 'updateOrderStatus'])->name('manager.orders.status.update');

    Route::get('/menu/categories', [MenuCategoriesController::class, 'index'])->name('manager.menu.categories');
    Route::get('/menu/categories/create', [MenuCategoriesController::class, 'create'])->name('manager.menu.categories.create');
    Route::post('/menu/categories', [MenuCategoriesController::class, 'store'])->name('manager.menu.categories.store');
    Route::get('/menu/categories/edit/{id}', [MenuCategoriesController::class, 'edit'])->name('manager.menu.categories.edit');
    Route::put('/menu/categories/{id}', [MenuCategoriesController::class, 'update'])->name('manager.menu.categories.update');
    Route::get('/menu/categories/{id}', [MenuCategoriesController::class, 'destroy'])->name('manager.menu.categories.delete');

    Route::get('/menu/items', [MenuItemsController::class, 'index'])->name('manager.menu.items');
    Route::get('/menu/items/create', [MenuItemsController::class, 'create'])->name('manager.menu.create');
    Route::post('/menu/items', [MenuItemsController::class, 'store'])->name('manager.menu.store');
    Route::get('/menu/items/edit/{id}', [MenuItemsController::class, 'edit'])->name('manager.menu.edit');
    Route::put('/menu/items/{id}', [MenuItemsController::class, 'update'])->name('manager.menu.update');
    Route::get('/menu/items/{id}', [MenuItemsController::class, 'destroy'])->name('manager.menu.delete');
   
    Route::get('/profile', [ProfileController::class, 'profile'])->name('manager.profile');
    Route::put('/profile', [ProfileController::class, 'updateprofile'])->name('manager.profile.update');

    Route::get('gallery', [GalleryController::class,'index'])->name('manager.gallery');
    Route::get('gallery/create', [GalleryController::class,'create'])->name('manager.gallery.create');
    Route::post('gallery/store', [GalleryController::class,'store'])->name('manager.gallery.store');
    Route::get('gallery/edit/{id}', [GalleryController::class,'edit'])->name('manager.gallery.edit');
    Route::put('gallery/update/{id}', [GalleryController::class,'update'])->name('manager.gallery.update');
    Route::get('gallery/delete/{id}', [GalleryController::class,'delete'])->name('manager.gallery.delete');


    Route::get('offers', [OfferController::class,'index'])->name('manager.offers.index');
    Route::get('offers/create', [OfferController::class,'create'])->name('manager.offers.create');
    Route::post('offers/store', [OfferController::class,'store'])->name('manager.offers.store');
    Route::get('offers/edit/{offer}', [OfferController::class,'edit'])->name('manager.offers.edit');
    Route::put('offers/{offer}', [OfferController::class,'update'])->name('manager.offers.update');
    Route::get('offers/{offer}', [OfferController::class,'destroy'])->name('manager.offers.destroy');
    Route::post('offers/get-menu-items/{categoryId}', [OfferController::class, 'getMenuItems'])->name('manager.offers.getMenuItems');


});

Route::group(['middleware' => ['user', 'auth'],'prefix'=>'user','auth'],function () {
    Route::get('/dashboard', [DashboardController::class, 'userdashboard'])->name('user.dashboard');

    Route::get('/orders', [OrderUserController::class, 'list'])->name('user.orders.list');
    Route::get('/orders/view/{id}', [OrderUserController::class, 'view'])->name('user.orders.view');
    Route::get('/profile', [ProfileUserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [ProfileUserController::class, 'updateprofile'])->name('user.profile.update');

    Route::get('/addresses', [AddressesController::class, 'list'])->name('user.addresses.list');
    Route::post('addresses/save', [AddressesController::class, 'saveAddress'])->name('user.address.save');
    Route::get('addresses/edit/{id}', [AddressesController::class, 'edit'])->name('user.address.edit');
    Route::put('addresses/update/{id}', [AddressesController::class, 'update'])->name('user.address.update');
    Route::get('addresses/delete/{id}', [AddressesController::class, 'delete'])->name('user.address.delete');
    Route::post('/address/{addressId}', 'App\Livewire\Frontend\Order\Index@setAddress');

    Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist.index');
    Route::get('/wishlist/{id}',[WishlistController::class,'remove'])->name('frontend.wishlist.remove');
});

Route::get('thanks', [IndexController::class, 'thanks'])->name('thanks');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

//stripe payment
Route::post('/stripe', [Index::class, 'stripePayment'])->name('stripe.post');

//subscribe
Route::post('/subscribe',[SubscriptionController::class,'subscribe'])->name('subscribe');