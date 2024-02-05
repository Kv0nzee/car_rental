<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/cars', [CarController::class, "index"]);//getAllCars
Route::get('/cars/{car:name}', [CarController::class, "show"]);//getSingleCar

Route::get('/categories', [CategoryController::class, "index"]);//getAllCategories


Route::get('/brands', [BrandController::class, "index"]);//getAllBrands
