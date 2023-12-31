<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Http\Requests;
use App\Models\Khachhang;
use App\Models\Sanpham;
use App\Models\Donhang;
use App\Models\Admin;
use App\Models\Chitietdonhang;
use App\Models\Chitietnhaphang;
use Illuminate\Support\Facades\Redirect;

use Laravel\Socialite\Facades\Socialite;
use App\Models\MXH;
use App\Models\MXH_Khachhang;
use App\Models\Login;
use App\Models\Nhaphang;
use App\Models\Thongke;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class AdminController extends Controller
{   
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('admin.dashboard');
        }else{
           return Redirect::to('admin')->send();
        }
    }

    public function loginkhachhang_google(){
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }

    public function callback_khachhang_google(){
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        $users = Socialite::driver('google')->stateless()->user();

        $authUser = $this->findOrCreateKhachhang($users, 'google');

        if($authUser){
            $account_name = Khachhang::where('id_kh', $authUser->user)->first();
            Session::put('id_kh', $account_name->id_kh);
            Session::put('ten_kh', $account_name->ten_kh);
        }elseif($khachhang_new){
            $account_name = Khachhang::where('id_kh', $authUser->user)->first();
            Session::put('id_kh', $account_name->id_kh);
            Session::put('ten_kh', $account_name->ten_kh);
        }
        
        return redirect('thanhtoan')->with('message', 'Đăng nhập tài khoản thành công');
    }

    public function findOrCreateKhachhang($users, $provider) {
        $authUser = MXH_Khachhang::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        }
        
        $khachhang = Khachhang::where('email_kh', $users->email)->first();
    
        if (!$khachhang) {
            $khachhang = Khachhang::create([
                'ten_kh' => $users->name,
                'email_kh' => $users->email,
                'matkhau_kh' => '',
                'sdt_kh' => ''
            ]);
        }
        $khachhang_new = new MXH_Khachhang([
            'provider_user_id' => $users->id,
            'provider_user_email' => $users->email,
            'provider' => strtoupper($provider)
        ]);

        $khachhang_new->khachhang()->associate($khachhang);

        $khachhang_new->save();
    
        return $khachhang_new;
    }

    public function index(){
        return view('admin.auth.dangnhapauth');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        //Thongke
        $thongke = Thongke::all();
        $doanhso = 0;
        $loinhuan = 0;
        $soluong = 0;
        foreach($thongke as $key => $thong){
            $doanhso = $doanhso + $thong->doanhso_tk;
            $loinhuan = $loinhuan + $thong->loinhuan_tk;
            $soluong = $soluong + $thong->soluong_tk;
        }
        //Nhap hàng
        $nhaphang = Chitietnhaphang::all();
        $doanhsonhaphang = 0;
        foreach($nhaphang as $key => $nhap){
            $doanhsonhaphang += ($nhap->gia_nl * $nhap->soluong_nl);
        }

        $chitietdonhang = Chitietdonhang::all();
        $soluong_sanpham = [];

        foreach($chitietdonhang as $key => $chitiet){
            $id_sp = $chitiet->id_sp;
            $soluong_sp = $chitiet->soluong_sp;

            if (isset($soluong_sanpham[$id_sp])) {
                // Sản phẩm đã tồn tại trong mảng, cộng thêm số lượng
                $soluong_sanpham[$id_sp] += $soluong_sp;
            } else {
                // Sản phẩm chưa tồn tại trong mảng, thêm vào và gán số lượng
                $soluong_sanpham[$id_sp] = $soluong_sp;
            }
        }
        arsort($soluong_sanpham);
        //Hiển thị donut 
        $sanpham12 = Sanpham::all()->count();
        $donhang12 = Donhang::all()->count();
        $khachhang12 = Khachhang::all()->count();
        $admin12 = Admin::all()->count();
        return view('admin.dashboard')
        ->with(compact('sanpham12', 'donhang12', 'khachhang12', 'admin12', 'doanhso', 'loinhuan', 'soluong', 'soluong_sanpham', 'doanhsonhaphang'));
    }
    public function dashboard(Request $request){

        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($login){
            $login_count = $login->count();

            if($login_count > 0){
                Session::put('admin_name', $login->admin_name);
                Session::put('admin_id', $login->admin_id);
                return Redirect::to('/dashboard');
            }
        }else{
            Session::put('message', 'Mật khẩu hoặc tài khoản sai vui lòng nhập lại!');
            return Redirect::to('/admin');
        }
    }
    public function log_out(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');

    }

    public function login_google(){
        return Socialite::driver('google')->redirect();
    }

    public function callback_google() {
        $users = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateUser($users, 'google');
        $account_name = Login::where('admin_id', $authUser->login->admin_id)->first();
        Session::put('admin_name', $account_name->admin_name);
        Session::put('admin_id', $account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }
    
    public function findOrCreateUser($users, $provider) {
        $authUser = MXH::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        }
    
        $orang = Login::where('admin_email', $users->email)->first();
    
        if (!$orang) {
            $orang = Login::create([
                'admin_name' => $users->name,
                'admin_email' => $users->email,
                'admin_password' => '',
                'admin_phone' => '',
                'admin_status' => 1
            ]);
        }
    
        $duy = new MXH([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);
    
        $duy->login()->associate($orang);
        $duy->save();
    
        $account_name = Login::where('admin_id', $duy->login->admin_id)->first();
        Session::put('admin_name', $account_name->admin_name);
        Session::put('admin_id', $account_name->admin_id);
        return $duy;
    }

    public function locngay(Request $request) {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
    
        $get = Thongke::whereBetween('order_date', [$from_date, $to_date])
            ->orderBy('order_date', 'ASC')
            ->get();
    
        // $chart_data = [];
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->doanhso_tk, 
                'profit' => $val->loinhuan_tk, 
                'quantity' => $val->soluong_tk, 
            );
        }
    
        $data = json_encode($chart_data);
        echo $data;
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = Thongke::whereBetween('order_date', [$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Thongke::whereBetween('order_date', [$dauthangtruoc,$cuoithangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value'] == 'thangnay'){
            $get = Thongke::whereBetween('order_date', [$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Thongke::whereBetween('order_date', [$sub365days,$now])->orderBy('order_date','ASC')->get();
        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->doanhso_tk, 
                'profit' => $val->loinhuan_tk, 
                'quantity' => $val->soluong_tk, 
            );
        }
    
        $data = json_encode($chart_data);
        echo $data;
    }

    public function ngay_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Thongke::whereBetween('order_date', [$sub30days,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->doanhso_tk, 
                'profit' => $val->loinhuan_tk, 
                'quantity' => $val->soluong_tk, 
            );
        }

        $data = json_encode($chart_data);
        echo $data;
    }
    
}
