<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;

class CouponController extends Controller
{   
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công!');

        }
    }

    public function show_coupon(){
        $coupon = Coupon::orderby('id_coupon', 'DESC')->get();
        return view('admin.coupon.coupon')->with(compact('coupon'));
    }

    public function themcoupon(){
        return view('admin.coupon.themcoupon');
    }

    public function xoa_coupon($id_coupon){
        $coupon = Coupon::find($id_coupon);
        $coupon->delete();

        Session::put('message', 'Xóa mã giảm giá thành công');
        return Redirect::to('coupon');
    }

    public function luucoupon(Request $request){
        $data = $request->all();
        $coupon = new Coupon();

        $coupon->ten_coupon = $data['ten_coupon'];
        $coupon->ma_coupon = $data['ma_coupon'];
        $coupon->time_coupon = $data['time_coupon'];
        $coupon->number_coupon = $data['number_coupon'];
        $coupon->dieukien_coupon = $data['dieukien_coupon'];
        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('coupon');

    }
}
