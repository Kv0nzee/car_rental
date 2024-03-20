<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RentCarController;
use App\Http\Controllers\UserController;
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
Route::put('/cars/{car:name}/edit', [CarController::class, "edit"]);//updateCar
Route::delete('/cars/{id}', [CarController::class, 'delete']);//deletecar

Route::get('/categories', [CategoryController::class, "index"]);//getAllCategories


Route::get('/brands', [BrandController::class, "index"]);//getAllBrands

Route::get('/rent', [RentCarController::class, "index"]);//getAllRentedCars
Route::get('/rent/{rentCar:id}', [RentCarController::class, "show"]);//getSingleRentedCar
Route::post('/rent', [RentCarController::class, "store"]);//insertRentedCar
Route::put('/rent/{id}', [RentCarController::class, 'update']);//update
Route::delete('/rent/{id}', [RentCarController::class, 'delete']);//delete

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUserData']);
Route::post('/logout', [UserController::class, 'logout']);