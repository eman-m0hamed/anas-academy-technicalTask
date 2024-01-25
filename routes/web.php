<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// product routes

// get all products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');

// get all products which their price more than 3000$
Route::get('/products/great', [ProductController::class, 'greatPrice'])->name('product.greatPrice')->middleware('logs.request'); // add logs.request middleware;

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
