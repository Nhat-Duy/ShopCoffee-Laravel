<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Session;
use App\Models\Coupon;
use App\Http\Requests;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{   
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('ma_coupon',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable == 0){
                        $cou[] = array(
                            'ma_coupon' => $coupon->ma_coupon,
                            'number_coupon' => $coupon->number_coupon,
                            'dieukien_coupon' => $coupon->dieukien_coupon,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'ma_coupon' => $coupon->ma_coupon,
                        'number_coupon' => $coupon->number_coupon,
                        'dieukien_coupon' => $coupon->dieukien_coupon,

                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Thêm mã giảm giá thàng công!');
            }
        }else{
            return redirect()->back()->with('message', 'Mã giảm giá không đúng!');

        }
        
    }

    public function giohangajax(Request $request){
        //Seo
        $meta_mota = "Giỏ hàng";
        $meta_keywords = "Giỏ hàng Ajax";
        $meta_title = "Giỏ hàng Ajax";
        $url_canonical = $request->url();
        //EndSeo

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();
        return view('page.giohang.giohangajax')
        ->with('danhmuc',$danhmuc_sp)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }
    public function themgiohangajax(Request $request){
        $data = $request->all();
        // print_r($data);
        $id_session = substr(md5(microtime()), rand(0,26), 5);
        $cart = Session::get('cart');

        // Session::forget('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['id_sp'] == $data['id_sp_giohang']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                    'id_session' => $id_session,
                    'ten_sp' => $data['ten_sp_giohang'],
                    'id_sp' => $data['id_sp_giohang'],
                    'hinhanh_sp' => $data['hinhanh_sp_giohang'],
                    'qty_sp' => $data['qty_sp_giohang'],
                    'gia_sp' => $data['gia_sp_giohang'],
                );
                Session::put('cart', $cart);
                
            }
        }else{
            $cart[] = array(
                'id_session' => $id_session,
                'ten_sp' => $data['ten_sp_giohang'],
                'id_sp' => $data['id_sp_giohang'],
                'hinhanh_sp' => $data['hinhanh_sp_giohang'],
                'qty_sp' => $data['qty_sp_giohang'],
                'gia_sp' => $data['gia_sp_giohang'],
            );
            Session::put('cart', $cart);

        }

        Session::save();

    }

    public function delete_sp($id_session){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['id_session'] == $id_session){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        }else{
            return Redirect()->back()->with('message', 'Xóa sản phẩm thật bại');
        }
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['id_session'] == $key){
                        $cart[$session]['qty_sp'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Cập nhật sản phẩm thành công!');
        }else{
            return Redirect()->back()->with('message', 'Cập nhật sản phẩm thật bại');

        }
    }

    public function xoatatca(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Xóa hết giỏ thành công!');

        }
    }

    public function luugiohang(Request $request){

        $id_sp = $request->idsp_hidden;
        $quantity = $request->qty;
        $info_sp = DB::table('sanpham')->where('id_sp', $id_sp)->first();

        $data['id'] = $info_sp->id_sp;
        $data['qty'] = $quantity;
        $data['name'] = $info_sp->ten_sp;
        $data['price'] = $info_sp->gia_sp;
        $data['weigh'] = '123';
        $data['options']['hinhanh'] = $info_sp->hinhanh_sp;

        Cart::add($data);
        
        return Redirect::to('/giohang');

        // Cart::destroy();
    }

    public function show_cart(Request $request){
        //Seo
        $meta_mota = "Giỏ hàng";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //EndSeo

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();
        return view('page.giohang.giohang')
        ->with('danhmuc',$danhmuc_sp)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }

    public function xoagiohang($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/giohang');
    }

    public function capnhat_giohang(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->qty;

        Cart::update($rowId,$qty);
        return Redirect::to('/giohang');

    }
}
