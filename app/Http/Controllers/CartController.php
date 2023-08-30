<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function luugiohang(Request $request){

        $id_sp = $request->idsp_hidden;
        $quantity = $request->qty;
        $info_sp = DB::table('sanpham')->where('id_sp', $id_sp)->first();

        //Cart::add('293ad', 'Product 1', 1, 9.99);
        // Cart::destroy();
        $data['id'] = $info_sp->id_sp;
        $data['qty'] = $quantity;
        $data['name'] = $info_sp->ten_sp;
        $data['price'] = $info_sp->gia_sp;
        $data['weigh'] = '123';
        $data['options']['hinhanh'] = $info_sp->hinhanh_sp;

        Cart::add($data);
        return Redirect::to('/giohang');
    }

    public function show_cart(){

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();
        return view('page.giohang.giohang')->with('danhmuc',$danhmuc_sp);
    }
}
