<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImagesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/category", [CategoryController::class, 'index']);
Route::post("/category", [CategoryController::class, 'create']);
Route::get("/category/{id}",[CategoryController::class,'getById']);
Route::post("/category/edit/{id}",[CategoryController::class,'edit']);
Route::delete("/category/{id}",[CategoryController::class,'delete']);
Route::get("/product",[ProductController::class,'index']);
Route::delete("/product/{id}",[ProductController::class,'delete']);
Route::get("/product/{id}",[ProductController::class,'getById']);
Route::post("/product",[ProductController::class,'create']);
Route::post("/product/edit/{id}",[ProductController::class,'edit']);
Route::get("/product_images",[ProductImagesController::class,'index']);
Route::post("/product_images",[ProductImagesController::class,'create']);
Route::get("/product_images/{id}",[ProductImagesController::class,'getById']);
Route::delete("/product_images/{id}",[ProductImagesController::class,'delete']);

