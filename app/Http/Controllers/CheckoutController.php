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
}
