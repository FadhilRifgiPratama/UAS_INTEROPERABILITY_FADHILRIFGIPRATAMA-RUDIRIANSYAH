<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [FrontendProductController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class);

Route::resource('products', ProductController::class);
Route::delete('/products/remove-image/{imageId}', [ProductController::class, 'removeImage'])->name('products.removeImage');
Route::get('/homepage', [FrontendProductController::class, 'index'])->name('homepage');
Route::get('/homepage/detail/{id}', [FrontendProductController::class, 'show'])->name('homepage.detail');
Route::get('/homepage/checkout/{id}', [FrontendProductController::class, 'checkout'])->name('homepage.checkout');
Route::post('/homepage/checkout', [FrontendProductController::class, 'order'])->name('homepage.order');
Route::post('/checkout', [FrontendProductController::class, 'processOrder'])->name('checkout.process');
Route::get('/homepage/checkout/success/{id}', [FrontendProductController::class, 'success'])->name('checkout.success');

Route::resource('categories', CategoryController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search', [FrontendProductController::class, 'search'])->name('search');

