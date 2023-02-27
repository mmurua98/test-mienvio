<?php

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
Route::post('/product/update/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
Route::delete('/product/{product}', [App\Http\Controllers\ProductController::class, 'destroy']);

