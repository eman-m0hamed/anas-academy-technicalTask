<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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
// product routes

// get all products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::get('/products/great', [ProductController::class, 'greatPrice'])->name('product.greatPrice');

// add new product
Route::post('/products', [ProductController::class, 'store'])->name('product.store');

// add new product form
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');

// get product
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// delete product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

// update product form
Route::get('/products/{id}/update', [ProductController::class, 'update'])->name('product.update');

// update product
Route::put('/products/{id}', [ProductController::class, 'edit'])->name('product.edit');

