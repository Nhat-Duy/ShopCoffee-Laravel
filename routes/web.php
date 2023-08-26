<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
//Frontend
Route::get('/', [HomeController::class,'index']);


//Backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::get('/logout',[AdminController::class, 'log_out']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);

//Danh mục
Route::get('/danhmuc', [CategoryProduct::class, 'danhmuc']);
Route::get('/themdanhmuc', [CategoryProduct::class, 'themdanhmuc']);
Route::get('/suadanhmuc/{id_danhmuc}', [CategoryProduct::class, 'suadanhmuc']);
Route::get('/xoadanhmuc/{id_danhmuc}', [CategoryProduct::class, 'xoadanhmuc']);


Route::post('/luudanhmuc', [CategoryProduct::class, 'luudanhmuc']);
Route::post('/update_danhmuc/{id_danhmuc}', [CategoryProduct::class, 'update_danhmuc']);

//Sản phẩm
Route::get('/sanpham', [ProductController::class, 'sanpham']);
Route::get('/themsanpham', [ProductController::class, 'themsanpham']);
Route::get('/suasanpham/{id_sp}', [ProductController::class, 'suasanpham']);
Route::get('/xoasanpham/{id_sp}', [ProductController::class, 'xoasanpham']);


Route::post('/luusanpham', [ProductController::class, 'luusanpham']);
Route::post('/update_sanpham/{id_sp}', [ProductController::class, 'update_sanpham']);






