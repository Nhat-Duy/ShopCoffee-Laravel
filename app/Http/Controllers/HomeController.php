<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
        // $sanpham = DB::table('sanpham')
        // ->join('danhmuc','danhmuc.id_danhmuc','=','sanpham.id_danhmuc')
        // ->orderBy('sanpham.id_sp','desc')->get();
        $all_sp = DB::table('sanpham')->orderBy('id_sp', 'desc')->limit(4)->get();
        return view('page.trangchu')->with('all_sp', $all_sp);
    }
    public function cafe_sp(){

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        $all_sp = DB::table('sanpham')->orderBy('id_sp', 'desc')->limit(4)->get();


        return view('page.sanpham')->with('danhmuc',$danhmuc_sp)->with('all_sp', $all_sp);
    }

    public function timkiem(Request $request){
        $key = $request->key;
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        $timsanpham = DB::table('sanpham')->where('ten_sp', 'like', '%' .$key. '%')->limit(4)->get();

        return view('page.sanpham.timkiem')->with('danhmuc',$danhmuc_sp)->with('timsanpham',$timsanpham);
        
    }
}
