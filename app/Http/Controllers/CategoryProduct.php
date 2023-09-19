<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Category;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
           return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function danhmuc(){
        $this->AuthLogin();
        $danhmuc = DB::table('danhmuc')->get();
        $quanly = view('admin.danhmuc')->with('danhmuc', $danhmuc);
        return view('admin_layout')->with('admin.danhmuc', $quanly);
    }

    public function themdanhmuc(){
        $this->AuthLogin();
        return view('admin.themdanhmuc');
    }
    // Thêm danh mục
    public function luudanhmuc(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['ten_danhmuc'] = $request->tendanhmuc;
        $data['mota_danhmuc'] = $request->motadanhmuc;
        $data['meta_keywords'] = $request->tukhoadanhmuc;


        DB::table('danhmuc')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('themdanhmuc');
        
    }

    //Sửa danh mục
    public function suadanhmuc($id_danhmuc){
        $this->AuthLogin();
        $suadanhmuc = DB::table('danhmuc')->where('id_danhmuc', $id_danhmuc)->get();
        $quanly = view('admin.suadanhmuc')->with('suadanhmuc', $suadanhmuc);
        return view('admin_layout')->with('admin.suadanhmuc', $quanly);
    }

    public function update_danhmuc(Request $request,$id_danhmuc){
        $this->AuthLogin();
        $data = array();
        $data['ten_danhmuc'] = $request->tendanhmuc;
        $data['mota_danhmuc'] = $request->motadanhmuc;
        $data['meta_keywords'] = $request->tukhoadanhmuc;

        DB::table('danhmuc')->where('id_danhmuc', $id_danhmuc)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('danhmuc');
    }

    //Xoa danh muc
    public function xoadanhmuc($id_danhmuc){
        $this->AuthLogin();
        DB::table('danhmuc')->where('id_danhmuc', $id_danhmuc)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('danhmuc');
    }


    //Kết thúc admin 

    public function show_danhmuc(Request $request, $id_danhmuc){

        

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        $all_sp = DB::table('sanpham')->orderBy('id_sp', 'desc')->get();

        $danhmuc_by_id = DB::table('sanpham')
        ->join('danhmuc', 'sanpham.id_danhmuc', '=', 'danhmuc.id_danhmuc')
        ->where('sanpham.id_danhmuc', $id_danhmuc)->get();

        foreach($danhmuc_by_id as $key => $val){
            //Seo
                $meta_mota = $val->mota_danhmuc;
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->ten_danhmuc;
                $url_canonical = $request->url();
            //EndSeo
        }

        $danhmuc_ten = DB::table('danhmuc')->where('danhmuc.id_danhmuc',$id_danhmuc)->limit(1)->get();
        
        return view('page.sanpham')
        ->with('danhmuc',$danhmuc_sp)
        ->with('danhmuc_by_id',$danhmuc_by_id)
        ->with('danhmuc_ten',$danhmuc_ten)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
        
    }

}
