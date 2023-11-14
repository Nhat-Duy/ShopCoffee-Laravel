<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OderController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
//Bình luận
Route::post('/load_comment', [ProductController::class,'load_comment']);
Route::post('/send_comment', [ProductController::class,'send_comment']);
//Quản lý bình luận
Route::get('/quanlybinhluan', [ProductController::class,'quanlybinhluan']);
Route::post('/duyet_binhluan', [ProductController::class,'duyet_binhluan']);
Route::post('/traloi_binhluan', [ProductController::class,'traloi_binhluan']);
Route::post('/danhgiasao', [ProductController::class,'danhgiasao']);


Route::post('/timkiem', [HomeController::class,'timkiem']);
Route::post('/timkiemdonhang', [HomeController::class,'timkiemdonhang']);


//Danh mục sản phẩm trang sản phẩm
Route::get('/danhmuc_sanpham/{id_danhmuc}', [CategoryProduct::class,'show_danhmuc']);


//Backend
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'show_dashboard']);
Route::get('/logout',[AdminController::class, 'log_out']);
Route::post('/admin-dashboard',[AdminController::class, 'dashboard']);

//Danh mục
Route::group(['middleware' => 'admin.author'], function(){
    Route::get('/danhmuc', [CategoryProduct::class, 'danhmuc']);
    Route::get('/themdanhmuc', [CategoryProduct::class, 'themdanhmuc']);
    Route::get('/suadanhmuc/{id_danhmuc}', [CategoryProduct::class, 'suadanhmuc']);
    Route::get('/xoadanhmuc/{id_danhmuc}', [CategoryProduct::class, 'xoadanhmuc']);


    Route::post('/luudanhmuc', [CategoryProduct::class, 'luudanhmuc']);
    Route::post('/update_danhmuc/{id_danhmuc}', [CategoryProduct::class, 'update_danhmuc']);
});

//Sản phẩm
Route::group(['middleware' => 'admin.author'], function(){
    Route::get('/sanpham', [ProductController::class, 'sanpham']);
    Route::get('/themsanpham', [ProductController::class, 'themsanpham']);
    Route::get('/suasanpham/{id_sp}', [ProductController::class, 'suasanpham']);
    Route::get('/xoasanpham/{id_sp}', [ProductController::class, 'xoasanpham']);

    Route::post('/luusanpham', [ProductController::class, 'luusanpham']);
    Route::post('/update_sanpham/{id_sp}', [ProductController::class, 'update_sanpham']);
});

//Giỏ hàng
// Route::post('/capnhat_giohang', [CartController::class, 'capnhat_giohang']);
// Route::post('/luugiohang', [CartController::class, 'luugiohang']);
// Route::get('/giohang', [CartController::class, 'show_cart']);
// Route::get('/xoagiohang/{rowId}', [CartController::class, 'xoagiohang']);
Route::post('/update_cart', [CartController::class, 'update_cart']);
Route::post('/themgiohangajax', [CartController::class, 'themgiohangajax']);

Route::get('/giohangajax', [CartController::class, 'giohangajax']);

Route::get('/delete_sp/{id_session}', [CartController::class, 'delete_sp']);
Route::get('/xoatatca', [CartController::class, 'xoatatca']);


//Coupon
Route::post('/check_coupon', [CartController::class, 'check_coupon']);
Route::get('/unset_coupon', [CouponController::class, 'unset_coupon']);

//Quản lý Coupon
Route::get('/coupon', [CouponController::class, 'show_coupon']);
Route::get('/themcoupon', [CouponController::class, 'themcoupon']);
Route::get('/xoa_coupon/{id_coupon}', [CouponController::class, 'xoa_coupon']);

Route::post('/luucoupon', [CouponController::class, 'luucoupon']);


//Checkout
Route::get('/login_checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/sign_up', [CheckoutController::class, 'sign_up']);
Route::get('/thanhtoan', [CheckoutController::class, 'thanhtoan']);
Route::get('/dangxuat', [CheckoutController::class, 'dangxuat']);
// Route::get('/payment', [CheckoutController::class, 'payment']);

Route::post('/themkhachhang', [CheckoutController::class, 'themkhachhang']);
Route::post('/luuthanhtoan', [CheckoutController::class, 'luuthanhtoan']);
Route::post('/dangnhap', [CheckoutController::class, 'dangnhap']);
// Route::post('/dathang', [CheckoutController::class, 'dat_hang']);

Route::post('/select_delivery_home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/caculate_fee', [CheckoutController::class, 'caculate_fee']);
Route::post('/xacnhandonhang', [CheckoutController::class, 'xacnhandonhang']);

Route::get('/themdiachi', [CheckoutController::class, 'themdiachi']);
Route::get('/suadiachi/{id_dc}', [CheckoutController::class, 'suadiachi']);

Route::post('/thaydoidiachi/{id_dc}', [CheckoutController::class, 'thaydoidiachi']);
Route::post('/luudiachi', [CheckoutController::class, 'luudiachi']);


//Quản lý đơn hàng
//Frontend
Route::get('/lichsudonhang', [OderController::class, 'lichsudonhang']);
Route::get('/chothanhtoan', [OderController::class, 'chothanhtoan']);
Route::get('/dathanhtoan', [OderController::class, 'dathanhtoan']);
Route::get('/danggiao', [OderController::class, 'danggiao']);
Route::get('/hoanthanh', [OderController::class, 'hoanthanh']);
Route::get('/huydon', [OderController::class, 'huydon']);
Route::get('/xemchitietdonhang/{ma_dh}', [OderController::class, 'xemchitietdonhang']);
//Backend
Route::group(['middleware' => 'admin.author'], function(){
    Route::get('/indonhang/{checkout_code}', [OderController::class, 'indonhang']);
    Route::get('/quanlydonhang', [OderController::class, 'quanlydonhang']);
    Route::get('/xemdonhang/{ma_dh}', [OderController::class, 'xemdonhang']);
    Route::post('/update_tinhtrang', [OderController::class, 'update_tinhtrang']);
});

// Gửi mail
Route::get('/gui_mail', [HomeController::class, 'gui_mail']);

//Đăng nhập bằng google
Route::get('/login_google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);

//Đăng nhập bằng google frontend
Route::get('/loginkhachhang_google', [AdminController::class, 'loginkhachhang_google']);
Route::get('/khachhang/google/callback', [AdminController::class, 'callback_khachhang_google']);

// Quản lý vận chuyển
Route::get('/quanlyvanchuyen', [DeliveryController::class, 'quanlyvanchuyen']);
Route::post('/select_delivery', [DeliveryController::class, 'select_delivery']);

Route::post('/insert-delivary', [DeliveryController::class, 'insert_delivary']);
Route::post('/select_feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update_delivery', [DeliveryController::class, 'update_delivery']);

// Quản lý nguyên liệu
Route::group(['middleware' => 'admin.author'], function(){
    Route::get('/nguyenlieu', [WarehouseController::class, 'nguyenlieu']);
    Route::get('/themnguyenlieu', [WarehouseController::class, 'themnguyenlieu']);
    Route::get('/nhapkho', [WarehouseController::class, 'nhapkho']);

    Route::post('/luunguyenlieu', [WarehouseController::class, 'luunguyenlieu']);
    Route::get('/xoa_nguyenlieu/{id_nl}', [WarehouseController::class, 'xoa_nguyenlieu']);

    Route::post('/themvaokho', [WarehouseController::class, 'themvaokho']);
    Route::post('/update_kho', [WarehouseController::class, 'update_kho']);
    Route::get('/xoa_kho/{id_session}', [WarehouseController::class, 'xoa_kho']);
    Route::get('/xoatatca_kho', [WarehouseController::class, 'xoatatca_kho']);
    Route::get('/quanlynhaphang', [WarehouseController::class, 'quanlynhaphang']);
    Route::get('/xemchitietnhaphang/{ma_nh}', [WarehouseController::class, 'xemchitietnhaphang']);
    Route::get('/xoadonnhaphang/{id_nh}', [WarehouseController::class, 'xoadonnhaphang']);

    Route::post('/xacnhannhapkho', [WarehouseController::class, 'xacnhannhapkho']);
});
// Phân quyền
Route::get('/show_dangky_admin', [AuthController::class, 'show_dangky_admin']);
Route::post('/dangky_admin', [AuthController::class, 'dangky_admin']);
Route::get('/show_dangnhap_auth', [AuthController::class, 'show_dangnhap_auth']);
Route::post('/dangnhap_auth', [AuthController::class, 'dangnhap_auth']);
Route::get('/logout_auth', [AuthController::class, 'logout_auth']);

//Quan ly User
Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/xoa_user/{admin_id}', [UserController::class, 'xoa_user']);
    Route::post('/capquyen', [UserController::class, 'capquyen']);
});

//Quản lý doanh thu
Route::post('/locngay', [AdminController::class, 'locngay']);
Route::post('/dashboard_filter', [AdminController::class, 'dashboard_filter']);
Route::post('/ngay_order', [AdminController::class, 'ngay_order']);

//Thanh toán VNPAY
Route::post('/vnpay', [CheckoutController::class, 'vnpay']);
