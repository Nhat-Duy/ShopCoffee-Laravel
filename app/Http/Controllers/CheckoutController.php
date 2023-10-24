<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;
use Session;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use App\Models\Thanhtoan;
use App\Models\Donhang;
use App\Models\Chitietdonhang;
use App\Models\Khachhang;
use App\Models\Coupon;
use App\Models\Diachi;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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

    public function xacnhandonhang(Request $request){
        $data = $request->all();

        // Lấy coupon 
        if($data['oder_coupon'] != 'không có mã giảm giá'){
            $coupon = Coupon::where('ma_coupon', $data['oder_coupon'])->first();
            // $coupon->coupon_used = $coupon->coupon_used.','.Session::get('id_kh');
            // $coupon->coupon_time = $coupon->coupon_time - 1;
            $coupon_mail = $coupon->ma_coupon;
            // $coupon->save();
        }else{
            $coupon_mail = 'không có';
        }

        $thanhtoan = new Thanhtoan();
        $thanhtoan->ten_tt = $data['ten_tt'];
        $thanhtoan->email_tt = $data['email_tt'];
        $thanhtoan->sdt_tt = $data['sdt_tt'];
        $thanhtoan->diachi_tt = $data['diachi_tt'];
        $thanhtoan->notes_tt = $data['notes_tt'];
        $thanhtoan->method_tt = $data['method_tt'];
        $thanhtoan->save();
        $id_tt = $thanhtoan->id_tt; 

        $oder_code = substr(md5(microtime()),rand(0,26),5);

        $donhang = new Donhang();
        $donhang->id_kh = Session::get('id_kh');
        $donhang->id_tt = $id_tt;
        $donhang->tinhtrang_dh = 1;
        $donhang->ma_dh = $oder_code;

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $donhang->created_at = now();
        $donhang->save();

        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $chitietdonhang = new Chitietdonhang();

                $chitietdonhang->ma_dh = $oder_code;
                $chitietdonhang->id_sp = $cart['id_sp'];
                $chitietdonhang->ten_sp = $cart['ten_sp'];
                $chitietdonhang->hinhanh_sp = $cart['hinhanh_sp'];
                $chitietdonhang->gia_sp = $cart['gia_sp'];
                $chitietdonhang->soluong_sp = $cart['qty_sp'];
                $chitietdonhang->coupon_sp = $data['oder_coupon'];
                $chitietdonhang->feeship_sp = $data['oder_fee'];
                $chitietdonhang->save();
            }
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn hàng xác nhận ngày".' '.$now;

        $khachhang = Khachhang::find(Session::get('id_kh'));

        $data['email'] = $khachhang->email_kh;

        // Lấy giỏ hàng
        if(Session::get('cart') == true){
            foreach(Session::get('cart') as $key => $cart_email){
                $cart_array[] = array(
                    'ten_sp' => $cart_email['ten_sp'],
                    'gia_sp' => $cart_email['gia_sp'],
                    'qty_sp' => $cart_email['qty_sp'],
                );
            }
        }
        // Lấy địa chỉ vận chuyển
        $thanhtoan_array = array(
            'ten_kh' => $khachhang->ten_kh,  
            'ten_tt' => $data['ten_tt'],  
            'email_tt' => $data['email_tt'],  
            'sdt_tt' => $data['sdt_tt'],  
            'diachi_tt' => $data['diachi_tt'],  
            'notes_tt' => $data['notes_tt'],  
            'method_tt' => $data['method_tt']
        );
        //Lấy mã coupon 
        $ordercode_mail = array(
            'ma_coupon' => $coupon_mail,
            'order_code' => $oder_code
        );

        Mail::send('page.mail.mail_order', ['cart_array'=>$cart_array, 'thanhtoan_array'=>$thanhtoan_array, 'code'=>$ordercode_mail],
            function($message) use ($title_mail, $data){
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'], $title_mail);
        });
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }

    public function caculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('matp_fee', $data['matp'])->where('maqh_fee', $data['maqh'])->where('xaid_fee', $data['xaid'])->get();

            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){
                    foreach($feeship as $key => $fee){
                        Session::put('fee', $fee->feeship_fee);
                        Session::save();
                    }
                }else{
                    Session::put('fee', 5000);
                    Session::save();
                }
            }
        }
    }

    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'city'){
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                    $output.='<option>-- Chọn quận huyện --</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
                
            }else{
                
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output.='<option>-- Chọn xã phường --</option>';

                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
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

    public function thanhtoan(Request $request){
        //Seo
        $meta_mota = "Thanh Toán";
        $meta_keywords = "Thanh Toán";
        $meta_title = "Thanh Toán";
        $url_canonical = $request->url();
        //EndSeo

        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();
        $diachi = Diachi::where('id_kh', Session::get('id_kh'))->orderBy('id_dc', 'DESC')->limit(1)->get();
        $city = City::orderby('matp', 'ASC')->get();
        $diachi1 = Diachi::where('id_kh', Session::get('id_kh'))->get();
        foreach($diachi1 as $key => $dia1){
            $id_kh = $dia1->id_kh;
        }
        $khachhang = Khachhang::where('id_kh', $id_kh)->first();
        return view('page.checkout.thanhtoan')
        ->with('danhmuc',$danhmuc_sp)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)
        ->with('city', $city)
        ->with('khachhang', $khachhang)
        ->with('diachi', $diachi);
        
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

    public function payment(Request $request){
        //Seo
        $meta_mota = "Xem lại giỏ hàng";
        $meta_keywords = "Xem lại giỏ hàng";
        $meta_title = "Xem lại giỏ hàng";
        $url_canonical = $request->url();
        //EndSeo
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

        return view('page.checkout.payment')
        ->with('danhmuc',$danhmuc_sp)
        ->with('meta_mota', $meta_mota)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical);
    }
    public function dat_hang(Request $request){
        //Seo
        $meta_mota = "Cảm ơn";
        $meta_keywords = "Cảm ơn";
        $meta_title = "Cảm ơn";
        $url_canonical = $request->url();
        //EndSeo

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

            return view('page.checkout.tienmat')
            ->with('danhmuc',$danhmuc_sp)
            ->with('meta_mota', $meta_mota)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
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
// Địa chỉ 
    public function themdiachi(Request $request){
        //Seo
        $meta_mota = "Cảm ơn";
        $meta_keywords = "Cảm ơn";
        $meta_title = "Cảm ơn";
        $url_canonical = $request->url();
        //EndSeo
        $danhmuc_sp = DB::table('danhmuc')->orderBy('id_danhmuc', 'desc')->get();

            return view('page.diachi.themdiachi')
            ->with('danhmuc',$danhmuc_sp)
            ->with('meta_mota', $meta_mota)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }

    public function luudiachi(Request $request){
        $data = $request->all();

        $diachi = new Diachi();
        $diachi->id_kh = Session::get('id_kh');
        $diachi->diachi_dc = $data['diachi_dc'];
        $diachi->save();

        Session::put('message', 'Thêm địa chỉ thành công');
        return Redirect::to('thanhtoan');
        
    }
}
