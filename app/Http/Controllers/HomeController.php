<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use Session;
use App\Http\Requests;
use App\Models\Donhang;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request){
        // $sanpham = DB::table('sanpham')
        // ->join('danhmuc','danhmuc.id_danhmuc','=','sanpham.id_danhmuc')
        // ->orderBy('sanpham.id_sp','desc')->get();
        //Seo
        $meta_mota = "Trang chủ";
        $meta_keywords = "Trang chủ";
        $meta_title = "Trang chủ";
        $url_canonical = $request->url();
        //EndSeo

        $all_sp = DB::table('sanpham')->orderBy('id_sp', 'desc')->limit(4)->get();
        return view('page.trangchu')
        ->with('all_sp', $all_sp)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);

        // return view('page.trangchu')->with(compact('all_sp' , ''));

    }
    public function cafe_sp(){

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        $all_sp = DB::table('sanpham')->orderBy('id_sp', 'desc')->limit(4)->get();

        return view('page.sanpham')->with('danhmuc',$danhmuc_sp)->with('all_sp', $all_sp);
    }

    public function timkiem(Request $request){
        //Seo
        $meta_mota = "Tìm kiếm";
        $meta_keywords = "Tìm kiếm";
        $meta_title = "Tìm kiếm";
        $url_canonical = $request->url();
        //EndSeo

        $key = $request->key;
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        $timsanpham = DB::table('sanpham')->where('ten_sp', 'like', '%' .$key. '%')->limit(4)->get();

        return view('page.sanpham.timkiem')
        ->with('danhmuc',$danhmuc_sp)
        ->with('timsanpham',$timsanpham)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
        
    }

    public function timkiemdonhang(Request $request){
        $key = $request->key;

        $timdonhang = Donhang::join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
        ->select('donhang.*', 'khachhang.ten_kh')
        ->where('ten_kh', 'like', '%' .$key. '%')->limit(4)->get();

        return view('admin.donhang.timdonhang')
        ->with('timdonhang',$timdonhang);
        
    }

    public function gui_mail(){
        
        $to_name = "Nhat Duy Coffee";
        $to_email = "nhatduy1471ag@gmail.com";

        $data = array("name"=>"Mail từ khách hàng", "body"=>"Mail gửi về vấn đề hàng hóa");

        Mail::send('page.mail', $data, function($message) use($to_name, $to_email){
            $message->to($to_email)->subject('Test thử gửi mail cho google');
            $message->from($to_email, $to_name);
        });

        // return redirect('/')->with('messege','');
    }
}
