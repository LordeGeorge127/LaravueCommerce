<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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


//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware(['guestOrVerified'])->group(function (){
//    Route::get('/',[ProductController::class,'index'])->name('home');
//    Route::get('/product/{product:slug}', [ProductController::class,'view'])->name('product.view');
//
//    Route::prefix('/cart')->name('cart.')->group(function (){
//        Route::get('/',[\App\Http\Controllers\CartController::class,'view'])->name('index');
//        Route::post('/cart/add/{product:slug}',[CartController::class,'add'])->name('cart.add');
//        Route::post('/cart/remove/{product:slug}',[CartController::class,'remove'])->name('remove');
//        Route::post('/cart/update-quantity/{product:slug}',[CartController::class,'updateQuantity'])->name('updateQuantity');
//
//    }) ;
//});
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product:slug}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/get-total-count', [CartController::class, 'getTotalCount'])->name('cart.total-count');
Route::post('/cart/remove/{product:slug}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth','verified'])->group(function (){
    Route::get('/profile',[ProfileController::class,'view'])->name('profile');
    Route::post('/profile',[ProfileController::class,'store'])->name('profile.update');
    Route::post('/profile/password-update',[ProfileController::class,'updatePassword'])->name('profile_password.update');
});
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
