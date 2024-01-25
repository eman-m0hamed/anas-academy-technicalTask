<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// get all products
// Route::get('products', [ProductController::class, 'index'])->middleware('auth:sanctum');

// or put the products route in middleware group to apply this middleware for all routes inside it.
Route::middleware('auth:sanctum')->group( function(){

    Route::get('products', [ProductController::class, 'index']);
    // other routes there that want to apply this middleware to them.
});

// store product route
Route::post('products', [ProductController::class, 'store']);

// login route
Route::post('login', [AuthController::class, 'login']);

// register route
Route::post('register', [AuthController::class, 'register']);


