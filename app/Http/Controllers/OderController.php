<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeship;
use App\Models\Thanhtoan;
use App\Models\Donhang;
use App\Models\Chitietdonhang;
use App\Models\Khachhang;
use App\Models\Coupon;
use Barryvdh\DomPDF\PDF;

class OderController extends Controller
{   

    public function indonhang($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        return $checkout_code;
    }

    public function xemdonhang($ma_dh){
        $chitietdonhang = Chitietdonhang::where('ma_dh', $ma_dh)->get();

        $donhang = Donhang::where('ma_dh', $ma_dh)->get();
        foreach($donhang as $key => $ord){
            $id_kh = $ord->id_kh;
            $id_tt = $ord->id_tt;
        }
        $khachhang = Khachhang::where('id_kh', $id_kh)->first();
        $thanhtoan = Thanhtoan::where('id_tt', $id_tt)->first();

        $chitietdonhang = Chitietdonhang::with('sanpham')->where('ma_dh', $ma_dh)->get();

        foreach($chitietdonhang as $key => $chitiet){
            $coupon_sp = $chitiet->coupon_sp;
        }

        if($coupon_sp != 'không có mã giảm giá'){
            $coupon = Coupon::where('ma_coupon', $coupon_sp)->first();
            $dieukien_coupon = $coupon->dieukien_coupon;
            $number_coupon = $coupon->number_coupon;
        }else{
            $dieukien_coupon = 2;
            $number_coupon = 0;
        }
        return view('admin.xemdonhang')->with(compact('chitietdonhang', 'khachhang', 'thanhtoan', 'chitietdonhang', 'dieukien_coupon', 'number_coupon'));
    }

    public function quanlydonhang(){
        $donhang = Donhang::orderBy('created_at', 'DESC')->get();

        return view('admin.quanlydonhang')->with(compact('donhang'));
    }

    
}   
