<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function sanpham(){
        $this->AuthLogin();
        $sanpham = DB::table('sanpham')
        ->join('danhmuc','danhmuc.id_danhmuc','=','sanpham.id_danhmuc')
        ->orderBy('sanpham.id_sp','desc')->get();
        $quanly = view('admin.sanpham')->with('sanpham', $sanpham);
        return view('admin_layout')->with('admin.sanpham', $quanly);
    }

    public function themsanpham(){
        $this->AuthLogin();
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('admin.themsanpham')->with('danhmuc_sp', $danhmuc_sp);

    }
    // Thêm sản phẩm
    public function luusanpham(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['ten_sp'] = $request->tensanpham;
        $data['mota_sp'] = $request->motasanpham;
        $data['noidung_sp'] = $request->noidungsanpham;
        $data['gia_sp'] = $request->giasanpham;
        $data['id_danhmuc'] = $request->danhmuc;
        // $data['trangthai_sp'] = $request->trangthaisanpham;
        
        $get_hinhanh = $request->file('hinhanh_sp');

        if($get_hinhanh){
            $get_ten_hinhanh = $get_hinhanh->getClientOriginalName();
            $name_hinhanh = current(explode('.',$get_ten_hinhanh));
            $new_hinhanh = $name_hinhanh.rand(0,99). '.' .$get_hinhanh->getClientOriginalExtension();
            $get_hinhanh->move('public/upload/sanpham',$new_hinhanh);
            $data['hinhanh_sp'] = $new_hinhanh;

            DB::table('sanpham')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('sanpham');
        }

        $data['hinhanh_sp'] = '';
        DB::table('sanpham')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('themsanpham');
        
    }

    //Sửa sản phẩm
    public function suasanpham($id_sp){
        $this->AuthLogin();
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();  

        $suasanpham = DB::table('sanpham')->where('id_sp', $id_sp)->get();
        $quanly = view('admin.suasanpham')->with('suasanpham', $suasanpham)->with('danhmuc_sp', $danhmuc_sp);
        return view('admin_layout')->with('admin.suasanpham', $quanly);
    }

    public function update_sanpham(Request $request,$id_sp){
        $this->AuthLogin();
        $data = array();
        $data['ten_sp'] = $request->tensanpham;
        $data['mota_sp'] = $request->motasanpham;
        $data['noidung_sp'] = $request->noidungsanpham;
        $data['gia_sp'] = $request->giasanpham;
        $data['id_danhmuc'] = $request->danhmuc;

        $get_hinhanh = $request->file('hinhanh_sp');

        if($get_hinhanh){
            $get_ten_hinhanh = $get_hinhanh->getClientOriginalName();
            $name_hinhanh = current(explode('.',$get_ten_hinhanh));
            $new_hinhanh = $name_hinhanh.rand(0,99). '.' .$get_hinhanh->getClientOriginalExtension();
            $get_hinhanh->move('public/upload/sanpham',$new_hinhanh);
            $data['hinhanh_sp'] = $new_hinhanh;

            DB::table('sanpham')->where('id_sp', $id_sp)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công!');
            return Redirect::to('sanpham');
        }

        DB::table('sanpham')->where('id_sp', $id_sp)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('sanpham');
    }

    //Xóa sản phẩm
    public function xoasanpham($id_sp){
        $this->AuthLogin();
        DB::table('sanpham')->where('id_sp', $id_sp)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('sanpham');
    }
}
