<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('manage-category',[App\Http\Controllers\CategoryController::class,'index']);
Route::get('manage-product', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('category/manage',[App\Http\Controllers\CategoryController::class,'ManageCategory']);
Route::get('edit-category/{id}',[App\Http\Controllers\CategoryController::class,'EditCategoryData']);
Route::get('delete/category/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory']);
Route::post('store/product', [App\Http\Controllers\ProductController::class, 'StoreOrUpdate']);
Route::get('get/product-details/{id}', [App\Http\Controllers\ProductController::class, 'GetDetails']);
Route::get('delete/product/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct']);
