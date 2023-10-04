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
        $chitietdonhang = Chitietdonhang::where('ma_dh', $checkout_code)->get();

        $donhang = Donhang::where('ma_dh', $checkout_code)->get();
        foreach($donhang as $key => $ord){
            $id_kh = $ord->id_kh;
            $id_tt = $ord->id_tt;
        }
        $khachhang = Khachhang::where('id_kh', $id_kh)->first();
        $thanhtoan = Thanhtoan::where('id_tt', $id_tt)->first();

        $chitietdonhang_sp = Chitietdonhang::with('sanpham')->where('ma_dh', $checkout_code)->get();

        foreach($chitietdonhang_sp as $key => $chitiet_sp){
            $coupon_sp = $chitiet_sp->coupon_sp;
        }

        if($coupon_sp != 'không có mã giảm giá'){
            $coupon = Coupon::where('ma_coupon', $coupon_sp)->first();
            $dieukien_coupon = $coupon->dieukien_coupon;
            $number_coupon = $coupon->number_coupon;
        }else{
            $dieukien_coupon = 2;
            $number_coupon = 0;
        }

        $output = '';

        $output .=' 
        <style>
        body{
            font-family:DejaVu Sans;
        }
        .table-styling{
            border:1px solid #000;
        }
        .table-styling tbody tr td{
            border:1px solid #000;
        }
        </style>
        <h1><center>Công ty TNHH một thành viên NDCoffee</center></h1>
        <h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
        <p>Người đặt hàng</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>                 
                </tr>
            </thead>
            <tbody>';
        $output .= '
                <tr>
                    <td>'. $khachhang->ten_kh .'</td>
                    <td>'. $khachhang->email_kh .'</td>
                    <td>'. $khachhang->sdt_kh .'</td>
                </tr>';
        $output .='
            </tbody>
        </table>

        <p>Ship hàng tới</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>                 
                    <th>Email</th>                 
                    <th>Ghi chú</th>                 
                </tr>
            </thead>
            <tbody>';
        $output .= '
                <tr>
                    <td>'. $thanhtoan->ten_tt .'</td>
                    <td>'. $thanhtoan->diachi_tt .'</td>
                    <td>'. $thanhtoan->sdt_tt .'</td>
                    <td>'. $thanhtoan->email_tt .'</td>
                    <td>'. $thanhtoan->notes_tt .'</td>
                </tr>';
        $output .='
            </tbody>
        </table>

        <p>Đơn hàng đặt</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã giảm giá</th>
                    <th>Phí ship</th>                 
                    <th>Số lượng</th>                 
                    <th>Giá sản phẩm</th>                 
                    <th>Thành tiền</th>                 
                </tr>
            </thead>
            <tbody>';
            
            $tongall = 0;
            foreach($chitietdonhang_sp as $key => $chitietsp){
                $tong = $chitietsp->gia_sp * $chitietsp->soluong_sp;
                $tongall += $tong;
                if($chitiet_sp->coupon_sp != 'không có mã giảm giá'){
                    $coupon_sp = $chitiet_sp->coupon_sp;
                }else{
                    $coupon_sp = 'không có mã';
                }
        $output .= '
                <tr>
                    <td>'. $chitietsp->ten_sp .'</td>
                    <td>'. $coupon_sp .'</td>
                    <td>'. number_format($chitietsp->feeship_sp). ' '. 'Đ' .'</td>
                    <td><center>'. $chitietsp->soluong_sp .'</center></td>
                    <td><center>'. number_format($chitietsp->gia_sp). ' '. 'Đ' .'</center></td>
                    <td>'. number_format($tong). ' '. 'Đ' .'</td>

                </tr>';
            }
            if($dieukien_coupon == 1){
                $tong_giamcoupon = ($tongall * $number_coupon)/100;
                $tong_coupon = $tongall - $tong_giamcoupon;
            }else{
                $tong_giamcoupon = $number_coupon;
                $tong_coupon = $tongall - $number_coupon;
            }
        $output .= '
        <tr>
            <td>
                <p>Tổng giảm: '. number_format($tong_giamcoupon). ' '. 'Đ' .'</p>
                <p>Phí ship: '. number_format($chitietsp->feeship_sp). ' '. 'Đ' .'</p>
                <p>Thanh toán: '. number_format($tong_coupon + $chitietsp->feeship_sp). ' '. 'Đ' .'</p>
            </td>
        </tr>';
        $output .='
            </tbody>
        </table>
        
        <p>Ký tên</p>
        <table>
            <thead>
                <tr>
                    <th width="200px">Người lập phiếu</th>
                    <th width="800px">Người nhận</th>                 
                </tr>
            </thead>
            <tbody>';
        $output .='
            </tbody>
        </table>
                
        ';
        
        return $output;        
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

        $chitietdonhang_sp = Chitietdonhang::with('sanpham')->where('ma_dh', $ma_dh)->get();

        foreach($chitietdonhang_sp as $key => $chitiet){
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
        return view('admin.xemdonhang')->with(compact('chitietdonhang', 'khachhang', 'thanhtoan', 'chitietdonhang_sp', 'dieukien_coupon', 'number_coupon', 'donhang'));
    }

    public function quanlydonhang(){
        $donhang = Donhang::orderBy('created_at', 'DESC')->get();

        return view('admin.quanlydonhang')->with(compact('donhang'));
    }

    
}   
