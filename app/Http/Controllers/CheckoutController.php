<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function login_checkout(){

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('page.checkout.login_checkout')->with('danhmuc',$danhmuc_sp);
    }

    public function sign_up(){
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('page.checkout.sign_up')->with('danhmuc',$danhmuc_sp);
    }

    public function themkhachhang(Request $request){
        // $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();


        $data = array();
        $data['ten_kh'] = $request->ten_kh;
        $data['sdt_kh'] = $request->sdt_kh;
        $data['email_kh'] = $request->email_kh;
        $data['matkhau_kh'] = md5($request->matkhau_kh);

        $id_kh = DB::table('khachhang')->insertGetId($data);

        Session::put('id_kh', $id_kh);
        Session::put('ten_kh', $request->ten_kh);


        return Redirect('/thanhtoan');
    }

    public function thanhtoan(){
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('page.checkout.thanhtoan')->with('danhmuc',$danhmuc_sp);
    }

    public function luuthanhtoan(Request $request){
        $data = array();
        $data['ten_tt'] = $request->ten_tt;
        $data['sdt_tt'] = $request->sdt_tt;
        $data['email_tt'] = $request->email_tt;
        $data['diachi_tt'] = $request->diachi_tt;
        $data['notes_tt'] = $request->notes_tt;

        $id_tt = DB::table('thanhtoan')->insertGetId($data);

        Session::put('id_tt', $id_tt);
    
        return Redirect('/payment');
    }

    public function payment(){
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('page.checkout.payment')->with('danhmuc',$danhmuc_sp);
    }
    public function dat_hang(Request $request){
        // Lay hinh thuc thanh toan
        $data = array();
        $data['hinhthuc_payment'] = $request->option_payment;
        $data['tinhtrang_payment'] = 'Đang chờ xử lý';
        
        $id_payment = DB::table('payment')->insertGetId($data);

        // Chèn vào đơn hàng
        $donhang_data = array();
        $donhang_data['id_kh'] = Session::get('id_kh');
        $donhang_data['id_tt'] = Session::get('id_tt');
        $donhang_data['id_payment'] = $id_payment;
        $donhang_data['tong_dh'] = Cart::subtotal();
        $donhang_data['tinhtrang_dh'] = 'Đang chờ xử lý';

        $id_dh = DB::table('donhang')->insertGetId($donhang_data);

        // Chèn vào chi tiết đơn hàng
        $content = Cart::content();
        foreach($content as $v_content){
            $ctdh_data = array();
            $ctdh_data['id_dh'] = $id_dh;
            $ctdh_data['id_sp'] = $v_content->id;
            $ctdh_data['ten_sp'] = $v_content->name;
            $ctdh_data['gia_sp'] = $v_content->price;
            $ctdh_data['soluong_sp'] = $v_content->qty;

            DB::table('chitietdonhang')->insertGetId($ctdh_data);
        }
        if($data['hinhthuc_payment'] == 1){
            echo 'Thanh toán bằng thẻ ATM';
        }else{
            Cart::destroy();
            $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

            return view('page.checkout.tienmat')->with('danhmuc',$danhmuc_sp);
        }
            
    
        //return Redirect('/payment');
    }

    public function dangxuat(){
        Session::flush();
        return Redirect('/login_checkout');
    }

    public function dangnhap(Request $request){
        $email = $request->email;
        $matkhau = md5($request->matkhau);
        $result = DB::table('khachhang')->where('email_kh',$email)->where('matkhau_kh',$matkhau)->first();


        if($result){
            Session::put('id_kh', $result->id_kh);
            return Redirect('/thanhtoan');
        }else{
            return Redirect('/login_checkout');
            
        }
    }

    public function quanlydonhang(){
        $this->AuthLogin();
        $donhang = DB::table('donhang')
        ->join('khachhang','donhang.id_kh','=','khachhang.id_kh')
        ->select('donhang.*','khachhang.ten_kh')
        ->orderBy('donhang.id_dh','desc')->get();
        $quanlydonhang = view('admin.quanlydonhang')->with('donhang', $donhang);
        return view('admin_layout')->with('admin.quanlydonhang', $quanlydonhang);
    }

    public function xemdonhang($id_dh){
        $this->AuthLogin();
        $donhang_id = DB::table('donhang')
        ->join('khachhang','donhang.id_kh','=','khachhang.id_kh')
        ->join('thanhtoan','donhang.id_tt','=','thanhtoan.id_tt')
        ->join('chitietdonhang','donhang.id_dh','=','chitietdonhang.id_dh')
        ->select('donhang.*','khachhang.*', 'thanhtoan.*', 'chitietdonhang.*',)
        ->where('donhang.id_dh',$id_dh)->get();
        // echo '<pre>';
        // print_r($donhang_id);
        // echo '</pre>';

        $quanlychitietdonhang = view('admin.xemdonhang')->with('donhang_id', $donhang_id);
        return view('admin_layout')->with('admin.xemdonhang', $quanlychitietdonhang);
    }
}
