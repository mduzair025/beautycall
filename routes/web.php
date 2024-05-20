<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');
});

Auth::routes(['register'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/salon/view/{salon}/{category}', [SalonController::class, 'viewSalon'])->name('salon.view');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/categories', [UserController::class, 'categories'])->name('categories');
    Route::get('/category-salons/{category}', [UserController::class, 'category'])->name('category.salons');
    Route::get('/ricerca-categories', [UserController::class, 'ricercaCategory'])->name('get.ricerca.categories');

    Route::get('/salons', [UserController::class, 'salons'])->name('salons');
    Route::get('/bookings', [UserController::class, 'bookings'])->name('bookings');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [AdminController::class,'registerShow'])->name('register-view');
    Route::post('register', [AdminController::class,'register'])->name('register');
});
