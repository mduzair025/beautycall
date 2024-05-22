<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
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
