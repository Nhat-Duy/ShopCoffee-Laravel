<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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
Route::get('/cafe_sp', [HomeController::class,'cafe_sp']);
Route::get('/chitietsanpham/{id_sp}', [ProductController::class,'chitietsanpham']);

Route::post('/timkiem', [HomeController::class,'timkiem']);


//Danh mục sản phẩm trang sản phẩm
Route::get('/danhmuc_sanpham/{id_danhmuc}', [CategoryProduct::class,'show_danhmuc']);


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

//Giỏ hàng
Route::post('/capnhat_giohang', [CartController::class, 'capnhat_giohang']);
Route::post('/luugiohang', [CartController::class, 'luugiohang']);
Route::post('/themgiohangajax', [CartController::class, 'themgiohangajax']);

Route::get('/giohang', [CartController::class, 'show_cart']);
Route::get('/xoagiohang/{rowId}', [CartController::class, 'xoagiohang']);
Route::get('/giohangajax', [CartController::class, 'giohangajax']);


//Checkout
Route::get('/login_checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/sign_up', [CheckoutController::class, 'sign_up']);
Route::get('/thanhtoan', [CheckoutController::class, 'thanhtoan']);
Route::get('/dangxuat', [CheckoutController::class, 'dangxuat']);
Route::get('/payment', [CheckoutController::class, 'payment']);

Route::post('/themkhachhang', [CheckoutController::class, 'themkhachhang']);
Route::post('/luuthanhtoan', [CheckoutController::class, 'luuthanhtoan']);
Route::post('/dangnhap', [CheckoutController::class, 'dangnhap']);
Route::post('/dathang', [CheckoutController::class, 'dat_hang']);

//Quản lý đơn hàng
Route::get('/quanlydonhang', [CheckoutController::class, 'quanlydonhang']);
Route::get('/xemdonhang/{id_dh}', [CheckoutController::class, 'xemdonhang']);


// Gửi mail
Route::get('/gui_mail', [HomeController::class, 'gui_mail']);

//Đăng nhập bằng google
Route::get('/login_google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);




