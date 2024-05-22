<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Salon\ClientController;
use App\Http\Controllers\Salon\BookingController as SalonBookingController;
use App\Http\Controllers\Salon\ServiceController;
use App\Http\Controllers\Salon\StaffController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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
    return view('auth.login');
});

Auth::routes(['register'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.view');
    Route::get('/get-categories', [CategoryController::class, 'getCategories'])->name('category.get-categories');
    
    Route::get('/salons', [SalonController::class, 'index'])->name('salons');
    Route::get('/search-salons', [SalonController::class, 'getSalons'])->name('salon.get-salons');
    Route::get('/salon/{salon}/category/{category}', [SalonController::class, 'show'])->name('salon.view');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/date-selector', [BookingController::class, 'dateSelector'])->name('bookings.date-selector');
    Route::post('/bookings/give-review', [BookingController::class, 'giveReview'])->name('bookings.give-reveiw');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/booking-confirm', [BookingController::class, 'confirmBooking'])->name('bookings.confirm');

    Route::post('/service-view', [SalonController::class, 'serviceView'])->name('service.view');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [AdminController::class,'registerShow'])->name('register-view');
    Route::post('register', [AdminController::class,'register'])->name('register');
});

Route::prefix('salon')->middleware(['admin.session'])->name('salon.')->group(function () {
    Route::get('/', [AdminController::class,'salonHome'])->name('index');
    Route::get('register', [AdminController::class,'salonCreate'])->name('create');
    Route::post('store', [AdminController::class,'salonStore'])->name('store');
    Route::get('information', [AdminController::class,'salonShow'])->name('information');
    Route::post('update', [AdminController::class,'salonUpdate'])->name('update');
    Route::get('logout', [AdminController::class,'logout'])->name('logout');
    
    Route::get('manage/opening-time', [AdminController::class,'manageOpeningTime'])->name('manage.opening-time');
    Route::post('manage/opening-time', [AdminController::class,'updateOpeningTime'])->name('manage.opening-time.update');
    
    
    Route::get('clients', [ClientController::class, 'index'])->name('clients');

    Route::get('bookings', [SalonBookingController::class, 'index'])->name('bookings');
    Route::post('bookings/manage', [SalonBookingController::class, 'manage'])->name('bookings.manage');
    
    Route::get('staffs', [StaffController::class, 'index'])->name('staffs');
    Route::post('/staffs/update', [StaffController::class, 'update'])->name('staffs.update');
    Route::get('/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
    Route::post('/staffs/store', [StaffController::class, 'store'])->name('staffs.store');


    Route::get('services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::post('/services/update', [ServiceController::class, 'update'])->name('services.update');
    Route::get('/services/cancel-image', [ServiceController::class, 'cancelImage'])->name('services.cancel-image');
    
});
