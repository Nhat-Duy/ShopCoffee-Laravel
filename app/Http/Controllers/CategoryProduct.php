<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class CategoryProduct extends Controller
{
    public function danhmuc(){

        $danhmuc = DB::table('danhmuc')->get();
        $quanly = view('admin.danhmuc')->with('danhmuc', $danhmuc);
        return view('admin_layout')->with('admin.danhmuc', $quanly);
    }

    public function themdanhmuc(){
        return view('admin.themdanhmuc');
    }
    // Thêm danh mục
    public function luudanhmuc(Request $request){
        $data = array();
        $data['ten_danhmuc'] = $request->tendanhmuc;
        $data['mota_danhmuc'] = $request->motadanhmuc;

        DB::table('danhmuc')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('themdanhmuc');
        
    }

    //Sửa danh mục
    public function suadanhmuc($id_danhmuc){
        $suadanhmuc = DB::table('danhmuc')->where('id_danhmuc', $id_danhmuc)->get();
        $quanly = view('admin.suadanhmuc')->with('suadanhmuc', $suadanhmuc);
        return view('admin_layout')->with('admin.suadanhmuc', $quanly);
    }

    public function update_danhmuc(Request $request,$id_danhmuc){
        $data = array();
        $data['ten_danhmuc'] = $request->tendanhmuc;
        $data['mota_danhmuc'] = $request->motadanhmuc;

        DB::table('danhmuc')->where('id_danhmuc', $id_danhmuc)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('danhmuc');
    }

    //Xoa danh muc
    public function xoadanhmuc($id_danhmuc){
        DB::table('danhmuc')->where('id_danhmuc', $id_danhmuc)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('danhmuc');
    }

}
