<?php

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

Route::middleware(['guestOrVerified'])->group(function (){
    Route::get('/', [\App\Http\Controllers\ProductController::class,'index'])->name('home');
    Route::get('/product/{product:slug}', [\App\Http\Controllers\ProductController::class,'view'])->name('product.view');

    Route::prefix('/cart')->name('cart.')->group(function (){
        Route::get('/',[\App\Http\Controllers\CartController::class,'view'])->name('index');
        Route::get('/add/{product:slug}',[\App\Http\Controllers\CartController::class,'add'])->name('add');
        Route::get('/remove/{product:slug}',[\App\Http\Controllers\CartController::class,'remove'])->name('remove');
        Route::get('/update-quantity/{product:slug}',[\App\Http\Controllers\CartController::class,'updateQuantity'])->name('updateQuantity');

    }) ;
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
